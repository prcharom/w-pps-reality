<?php

namespace App\Presenters;

use Nette,
    App\Model;



/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
        /** @var Model\Database */
	    private $database;
  
        /** @var Model\Users */
        private $users;
        
        /** @var Model\Drazba */
        private $drazba;
        
        
	public function __construct(Model\Database $database, Model\Users $users, Model\Drazba $drazba)
	{
		$this->database = $database;
        $this->users = $users;
        $this->drazba = $drazba;
	}
    
    
    /* Odhlaseni */
    
    // akce pro odhlaseni
    public function actionOut()
    {
		$this->getUser()->logout();
		$this->flashMessage('Byl(a) jste odhlášen(a).');
        $this->redirect('Homepage:default');
    }
    

    /* Domovska stranka */

    // akce pred pouzitim renderDefault
    public function actionDefault() 
    {
        if (!$this->user->isAllowed('zakladni','domovska_stranka'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // vypis homepage
    public function renderDefault()
    {
        // posledni 4 nemovitosti
        $this->template->nemovitosti = $this->database->findAll('nemovitost')->where('is_public', 1)->order('public_date DESC')->order('id DESC')->limit(4);
        $contact = $this->database->findById('contact', 1);
        if(!$contact) 
            $this->template->about_us = null;
        else
            $this->template->about_us = $contact->about_us;
    }


    /* Uprava domovske stranky */

    // akce pred pouzitim renderUpravitDomu
    public function actionUpravitDomu() 
    {
        if (!$this->user->isAllowed('upravit','domovska_stranka'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // upravit domovskou stranku
    public function renderUpravitDomu()
    {
        $form = $this['homeForm'];
        $form['send']->caption = 'Upravit domovskou stránku';
        $contact = $this->database->findById('contact', 1);
        if(!$contact) 
        {
            $this->flashMessage('Kontakt společnosti nelze upravit.');
            $this->redirect('Homepage:default');
        }
        $form->setDefaults($contact);   
    }
    

    /* Kontakt spolecnosti */

    // akce pred pouzitim renderKontakt
    public function actionKontakt() 
    {
        if (!$this->user->isAllowed('zakladni','kontakt'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // vypis kontaktu
    public function renderKontakt()
    {
        $this->template->contact = $this->database->findById('contact', 1);
    }


    /* Upravit kontakt spolecnosti */

    // akce pred pouzitim renderUpravitKontakt
    public function actionUpravitKontakt() 
    {
        if (!$this->user->isAllowed('upravit','kontakt'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // uprava kontaktu spolecnosti
    public function renderUpravitKontakt()
    {
    	$form = $this['contactForm'];
        $form['send']->caption = 'Upravit kontakt';
        $contact = $this->database->findById('contact', 1);
        if(!$contact) 
        {
        	$this->flashMessage('Kontakt společnosti nelze upravit.');
        	$this->redirect('Homepage:default');
        }
        $form->setDefaults($contact);
    }


    /* Podminky */

    // akce pred pouzitim renderPodminky
    public function actionPodminky() 
    {
        if (!$this->user->isAllowed('zakladni','podminky'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // vypis podminek a pravidel
    public function renderPodminky()
    {
        $this->template->terms = $this->database->findById('terms', 1);
        $cesky_mesice = array(1 => 'Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec');
        $cislo_mesice = date('n', strtotime($this->template->terms->last_modified));
        $this->template->month = $cesky_mesice[$cislo_mesice];
        $this->template->body =  Nette\Utils\Strings::replace($this->template->terms->body, array(
		    '~;~' => '<br>',		// je-li v textu strednik, pak odradkuj
		    '~\({2}~' => '<b>',	    // pokud jsou v textu hned dvě leve kulate zavorky za sebou zacni psat tucne
		    '~\){2}~' => '</b>',	// pokud jsou v textu hned dvě prave kulate zavorky za sebou prestan psat tucne
		));
    }


    /* Upravit podminky */

    // akce pred pouzitim renderUpravitPodminky
    public function actionUpravitPodminky() 
    {
        if (!$this->user->isAllowed('upravit','podminky'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // uprava vypisu podminek
    public function renderUpravitPodminky()
    {
        $form = $this['termsForm'];
        $form['send']->caption = 'Upravit podmínky';
        $terms = $this->database->findById('terms', 1);
        if(!$terms) 
        {
            $this->flashMessage('Podmínky nelze upravit.');
            $this->redirect('Homepage:default');
        }
        $form->setDefaults($terms);
    }


    /* Tovarnicky pro homepage presenter */
    
    /**
      * Tovarnicka pro prihlasovaci formular.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentLoginForm()
    {
        $form = new Nette\Application\UI\Form;
    	$form->addText('nick', 'Alias:')
    		->setRequired('Prosím vložte vaši přezdívku.');

    	$form->addPassword('heslo', 'Heslo:')
    		->setRequired('Prosím vložte heslo.');

    	$form->addSubmit('send', 'Přihlásit')
            ->setAttribute('class', 'btn btn-default');

    	$form->onSuccess[] = $this->loginFormSucceeded;
        return $form;
    }
    
    // metoda pro zpracovani odeslaneho prihlasovaciho formulare
    public function loginFormSucceeded($form, $values)
    {
	try {
            $this->getUser()->login($values->nick, $values->heslo);
            $uzivatel = $this->database->findById('uzivatel', $this->user->id);
            if($uzivatel->prvni_prihlaseni == null)
            {
                // uloz presny datum a cas prvniho prihlaseni uzivatele
                $data['prvni_prihlaseni'] = date('Y-m-d H:i:s');
                $uzivatel->update($data);
            }
            $this->flashMessage('Přihlášení proběhlo úspěšně.');
            $this->redirect('Homepage:default');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
	   	} 
    }


    /**
      * Tovarnicka na formular pro upravu sekce kontakt.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentContactForm()
    {
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue(1);

        $form->addTextArea('name', 'Název společnosti:')
        ->setRequired('Prosím vložte název společnosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Název je příliš dlouhý.', 80)
        ->setAttribute('placeholder', 'Sem vložte název.');
        
        $form->addTextArea('address', 'Adresa společnosti:')
        ->setRequired('Prosím vložte adresu společnosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Adresa je příliš dlouhá.', 80)
        ->setAttribute('placeholder', 'Sem vložte adresu.');
        
        $form->addTextArea('working_hours', 'Pracovní doba:')
        ->setRequired('Prosím vložte pracovní dobu.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Popis pracovní doby je příliš dlouhý', 80)
        ->setAttribute('placeholder', 'Sem vložte pracovní dobu.');

        $form->addText('email', 'Email:')
        ->setRequired('Prosím vložte email společnosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Email je příliš dlouhý', 30)
        ->setAttribute('placeholder', 'Sem vložte email.');

        $form->addText('phone', 'Telefoní číslo:')
        ->setRequired('Prosím vložte telefoní číslo společnosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Telefoní číslo je příliš dlouhé', 16)
        ->setAttribute('placeholder', 'Sem vložte email.');

        $form->addText('ico', 'IČO:')
        ->setRequired('Prosím vložte IČO.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'IČO je příliš dlouhé', 10)
        ->setAttribute('placeholder', 'Sem vložte IČO.');
        
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->contactFormSucceeded;
        return $form;
    }

    // metoda pro zpracovani odeslaneho formulare contact
    public function contactFormSucceeded($button) 
    {
    	$values = $button->getForm()->getValues(true);
    	$this->database->findById('contact', 1)->update($values);
        $this->flashMessage('Kontaktní informace o společnosti byly upraveny.');
        $this->redirect('Homepage:kontakt');
    }


    /**
      * Tovarnicka na formular pro upravu sekce podminky.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentTermsForm()
    {
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue(1);

        $form->addText('title', 'Nadpis podmínek:')
        ->setRequired('Prosím vložte nadpis pro podmínky.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Nadpis je příliš dlouhý.', 100)
        ->setAttribute('placeholder', 'Sem vložte nadpis.');
        
        $form->addTextArea('body', 'Podmínky:')
        ->setRequired('Prosím vložte adresu společnosti.')
        ->setAttribute('placeholder', 'Sem vložte adresu.');
        
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->termsFormSucceeded;
        return $form;
    }

    // metoda pro zpracovani odeslaneho formulare podminky
    public function termsFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $values['last_modified'] = date('Y-m-d H:i:s');
        $this->database->findById('terms', 1)->update($values);
        $this->flashMessage('Podmínky byly upraveny.');
        $this->redirect('Homepage:podminky');
    }


    /**
      * Tovarnicka na formular pro upravu domovske stranky.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentHomeForm()
    {
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue(1);

        $form->addTextArea('about_us', 'O nás:')
        ->setRequired('Prosím vložte text o nás.')
        ->setAttribute('placeholder', 'Sem vložte text o nás.');
        
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->homeFormSucceeded;
        return $form;
    }

    // metoda pro zpracovani odeslaneho formulare home
    public function homeFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $this->database->findById('contact', 1)->update($values);
        $this->flashMessage('Informace na domovské stránce byly upraveny.');
        $this->redirect('Homepage:default');
    }

}
