<?php

namespace App\Presenters;

use Nette,
    App\Model;


/**
 * Uzivatele presenter.
 */
class UzivatelePresenter extends BasePresenter
{
        /** @var Model\Database */
		private $database;
  
        /** @var Model\Users */
        private $users;
        
        /** @var Model\Drazba */
        private $drazba;

        /** @var Model\Authenticator */
        private $authenticator;
        
        
	public function __construct(Model\Database $database, Model\Users $users, Model\Drazba $drazba, Model\Authenticator $authenticator)
	{
		$this->database = $database;
        $this->users = $users;
        $this->drazba = $drazba;
        $this->authenticator = $authenticator;
	}
       
    
    /* Zajemci */
    
    // akce pred pouzitim renderZajemci
    public function actionZajemci() 
    {
        if (!$this->user->isAllowed('zajemce','zobrazit'))
            throw new Nette\Application\ForbiddenRequestException();       
    }
    
    // vypis zajemcu
    public function renderZajemci()
    {
		$this->template->zajemci = $this->database->findAll('uzivatel')
        ->where('id_typ_uzivatele', 3)->order('nick');
    }
    
    
    /* Vizitka */
    
    // akce pred pouzitim renderVizitka
    public function actionVizitka($id = null) 
    {
        if (!$this->user->isAllowed('zajemce','zobrazit'))
            throw new Nette\Application\ForbiddenRequestException();       
    }
    
    // vypis vizitky
    public function renderVizitka($id = null)
    {
		$this->template->uzivatel = $this->database->findById('uzivatel', $id);
        if (!$this->template->uzivatel) 
        {
            $this->flashMessage('Vizitku uživatele nelze zobrazit. Je možné, že uživatele někdo smazal.');
            $this->redirect('zajemci');
        }
    }


    /* Pridat zajemce */
    
    // akce volajici se pred renderPridatZajemce 
    public function actionPridatZajemce()
    {
        if (!$this->user->isAllowed('zajemce','pridat'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // pridani noveho zajemce
    public function renderPridatZajemce()
    {
        $this['zajemceForm']['send']->caption = 'Přidat účet zájemce';
    }
    
    
    /* Upravit zajemce */
    
    // akce volajici se pred renderUpravitZajemce 
    public function actionUpravitZajemce($id = null)
    {
        if (!$this->user->isAllowed('zajemce','upravit'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // uprava zajemce
    public function renderUpravitZajemce($id = null)
    {
        $form = $this['zajemceForm'];
        $form['send']->caption = 'Upravit účet zájemce';
        if (!$form->isSubmitted()) 
        {
            $this->template->zajemce = $this->database->findById('uzivatel', $id);
            if (!$this->template->zajemce || (isset($this->template->zajemce) && $this->template->zajemce->id_typ_uzivatele != 3)) 
            {
                $this->flashMessage('Tento zájemce neexistuje. Je možné, že ho někdo smazal.');
                $this->redirect('zajemci'); 
            }
            $form->setDefaults($this->template->zajemce);
            $form['heslo']->value = null;
        }
    }


    /* Upravit profil */
    
    // akce volajici se pred renderUpravitProfil
    public function actionUpravitProfil()
    {
        if (!$this->user->isAllowed('zakladni','domovska_stranka'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // uprava zajemce
    public function renderUpravitProfil()
    {
        $form = $this['userEditForm'];
        $form['send']->caption = 'Upravit profil';
            
        $uzivatel = $this->database->findById('uzivatel', $this->user->identity->id);
        if (!$uzivatel) 
        {
            $this->flashMessage('Tento uživatel neexistuje. Je možné, že ho někdo smazal.');
            $this->redirect('Homepage:default'); 
        }
        $form->setDefaults($uzivatel);
    }


    /* Zmena hesla */
    
    // akce volajici se pred renderZmenitHeslo
    public function actionZmenitHeslo()
    {
        if (!$this->user->isAllowed('zakladni','domovska_stranka'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // zmena hesla
    public function renderZmenitHeslo()
    {
        $form = $this['passEditForm'];
        $form['send']->caption = 'Změnit heslo';
    }
    
    
    /* Smazat zajemce */
    
    // akce volajici se pred renderSmazatZajemce 
    public function actionSmazatZajemce($id = null)
    {
        if (!$this->user->isAllowed('zajemce','smazat'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // uprava zajemce
    public function renderSmazatZajemce($id = null)
    {
        $form = $this['deleteUzivatelForm'];
        $form['send']->caption = 'Smazat účet zájemce';
        if (!$form->isSubmitted()) 
        {
            $this->template->zajemce = $this->database->findById('uzivatel', $id);
            if (!$this->template->zajemce || (isset($this->template->zajemce) && $this->template->zajemce->id_typ_uzivatele != 3)) 
            {
                $this->flashMessage('Tento zájemce neexistuje. Je možné, že ho někdo smazal.');
                $this->redirect('zajemci'); 
            }
        }
    }

    /* Tovarnicky pro formy */

    /**
      * Tovarnicka na formular pro pridani a upravovani zajemce.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentZajemceForm()
    {
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id_typ_uzivatele')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue(3);

        $form->addText('nick', 'Alias: *')
        ->setRequired('Prosím vložte alias zájemce.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Alias je příliš dlouhý.', 15)
        ->setAttribute('placeholder', 'Sem vložte alias zájemce.');

        $form->addSelect('id_nemovitost', 'Přístup k: *', $this->database->arrayIdToColumn('nemovitost','idn'))
        ->setRequired('Prosím vyberte nemovitost, ke které smí zájemce podávat nabídky.');

        $form->addText('heslo', 'Heslo: *')
        ->setRequired('Prosím vložte heslo zájemce.')
        ->setAttribute('placeholder', 'Sem vložte heslo zájemce.');
        
        $form->addText('jmeno', 'Jméno:')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Jméno je příliš dlouhé.', 100)
        ->setAttribute('placeholder', 'Sem vložte jméno zájemce.');

        $form->addText('email', 'Email:')
        ->setType('email')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Email je příliš dlouhý.', 60)
        ->setAttribute('placeholder', 'Sem vložte email zájemce.');
        
        $form->addText('telefon', 'Telefonní číslo:')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Telefonní číslo je příliš dlouhé.', 16)
        ->setAttribute('placeholder', 'Sem vložte telefonní číslo zájemce.');

        $form->addText('adresa', 'Adresa:')
        ->setAttribute('placeholder', 'Sem vložte adresu zájemce.');

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->zajemceFormSucceeded;
        return $form;
    }
    
    // metoda pro zpracovani odeslaneho formulare zajemce
    public function zajemceFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $id = (int) $this->getParameter('id');            
        if($id) // editace jiz existujiciho zajemce
        {
            try
            {
              $new_user = $this->users->update($id, $values);
              if($new_user)
              {
                $this->flashMessage('Účet zájemce byl upraven.');
              }
            }
            catch(\PDOException $e)
            {
                if($e->getCode()==23000)
                {
                  $this->flashMessage('Zájemce s tímto aliasem už je zaregistrován, zvolte prosím jiný.');
                } else {
                  throw $e;
                }
            }
        } else { // registrace noveho zajemce 
            try
            {
              $new_user = $this->users->register($values);
              if($new_user)
              {
                $this->flashMessage('Účet zájemce byl vytvořen. Nyní se může přihlásit.');
              }
            }
            catch(\PDOException $e)
            {
                if($e->getCode()==23000)
                {
                  $this->flashMessage('Zájemce s tímto aliasem už je zaregistrován, zvolte prosím jiný.');
                } else {
                  throw $e;
                }
            }
        }
        $this->redirect('zajemci');
    }

    /**
      * Tovarnicka na formular pro mazani uzivatelu.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentDeleteUzivatelForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->deleteUzivatelFormSucceeded;
        return $form;
    }
    
    // metoda pro mazani prihozu
    public function deleteUzivatelFormSucceeded($button)
    {
        $id = (int) $this->getParameter('id');
        $values = $button->getForm()->getValues(true);
        $this->database->findById('uzivatel', $id)->delete();
        $this->flashMessage('Zájemce byl smazán.');
        $this->redirect('Uzivatele:zajemci');
    }

    /**
      * Tovarnicka na formular pro editaci uctu.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentUserEditForm()
    {
        $form = new Nette\Application\UI\Form;

        $form->addText('nick', 'Alias:')
        ->setDisabled();
        
        $form->addText('jmeno', 'Jméno:')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Jméno je příliš dlouhé.', 100)
        ->setAttribute('placeholder', 'Sem vložte Vaše jméno.');

        $form->addText('email', 'Email:')
        ->setType('email')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Email je příliš dlouhý.', 60)
        ->setAttribute('placeholder', 'Sem vložte Váš email.');
        
        $form->addText('telefon', 'Telefonní číslo:')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Telefonní číslo je příliš dlouhé.', 16)
        ->setAttribute('placeholder', 'Sem vložte Vaše telefonní číslo.');

        $form->addText('adresa', 'Adresa:')
        ->setAttribute('placeholder', 'Sem vložte Vaši adresu.');
 
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->userEditFormSucceeded;
        return $form;
    }
    
    // metoda pro zpracovani odeslaneho formulare userEditForm
    public function userEditFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);

        $user = $this->database->findById('uzivatel', $this->user->identity->id);
        if($user)
        {
            $user->update($values);
            $this->flashMessage('Účet byl upraven.');
            $this->redirect('Uzivatele:upravitProfil');
        } else {
            $this->flashMessage('Účet se nepodařilo upravit.');
            $this->redirect('Uzivatele:upravitProfil');
        }
    }


    /**
      * Tovarnicka na formular pro zmenu hesla.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentPassEditForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $form->addPassword('oldpassword', 'Současné heslo: *')
            ->setRequired('Prosím zadejte vaše současné heslo.');

        $form->addPassword('newpassword', 'Nové heslo: *')
            ->setRequired('Prosím zadejte nové heslo.');

        $form->addPassword('newpassword2', 'Nové heslo znovu: *')
            ->setRequired('Zadejte prosím znovu heslo pro kontrolu.');
        
        $form->addSubmit('send', 'Odeslat formulář')
            ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->passEditFormSucceeded;
        return $form;
    }
    
    // metoda pro zpracovani odeslaneho formulare userEditForm
    public function passEditFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues();

        $user = $this->database->findById('uzivatel', $this->user->id);
        $old_pw = $this->authenticator->generateHash($values['oldpassword'], $user->heslo);

        if($user->heslo == $old_pw) { 
            if($values['newpassword'] == $values['newpassword2']) { 
                unset($values['oldpassword']);
                unset($values['newpassword2']);
                $values['heslo'] = $this->authenticator->generateHash($values['newpassword']);
                unset($values['newpassword']);
                $user->update($values);
                $this->flashMessage('Heslo bylo úspěšně změněno.'); 
                $this->redirect('Uzivatele:zmenitHeslo');
            } else {
                $this->flashMessage('Heslo nebylo změněno. Zopakujte prosím správně nové heslo.');  
                $this->redirect('Uzivatele:zmenitHeslo');
            }  
        } else {
            $this->flashMessage('Heslo nebylo změněno. Zadejte prosím správně staré heslo.'); 
            $this->redirect('Uzivatele:zmenitHeslo');
        }   
    }

}    
    