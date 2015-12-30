<?php

namespace App\Presenters;

use Nette,
    App\Model;


/**
 * Aukce presenter.
 */
class AukcePresenter extends BasePresenter
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
    

    /* Vypis z historie aukce */
    
    // akce pred pouzitim renderVypisHistorieAukce
    public function actionVypisHistorieAukce($id = null) 
    {
        if (!$this->user->isAllowed('drazba','vypisHistorie'))
            throw new Nette\Application\ForbiddenRequestException();       
    }
    
    // detailni vypis z historie aukce
    public function renderVypisHistorieAukce($id = null)
    {
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost)
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default');
        }
        $this->template->prihozy = $this->database->findAll('drazba')->where('id_nemovitost', $id);
        $this->template->drazba = $this->drazba->vyhodnotDrazbu($id, $this->template->prihozy);
        $this->template->status = $this->drazba->vratStatus();
        $this->template->now = $this->drazba->vratCas();
    }
    
    
    /* Prihodit */
    
    // akce pred pouzitim renderPrihodit
    public function actionPrihodit($id = null) 
    {
    	// vyhod nepovoleny pristup, pokud uzivatel nema prava zajemce a pokud jemu pridelene id_nemovitosti se neshoduje s id nemovitosti
        if (!$this->user->isAllowed('drazba','prihodit') || ($id != $this->user->identity->id_nemovitost))
            throw new Nette\Application\ForbiddenRequestException();       
    }
    
    // pro prihazovani penez pri aukci
    public function renderPrihodit($id = null)
    {
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        } else {
            $prihozy = $this->database->findAll('drazba')->where('id_nemovitost', $id);
            $this->template->drazba = $this->drazba->vyhodnotDrazbu($id, $prihozy);
            $this->template->status = $this->drazba->vratStatus();
            $this->template->pocet_prihozu = $prihozy->count('*'); 
            	if($this->template->pocet_prihozu > 0) // v template osetruji prvni prihoz
           		{        
           			$form = $this['prihozForm'];
        			$form['send']->caption = 'Podat nabídku';
            		$form['pocet']->value = $this->template->pocet_prihozu; // do formulare, protoze pri odesilani kontroluji zda nekdo mezitim neprihodil
            	} else { // prvni nulovy, pouze potvrdi zadanou castku
            		$form = $this['prvniPrihozForm'];
        			$form['send']->caption = 'Podat nabídku';
        			$form['pocet']->value = $this->template->pocet_prihozu; // do formulare, protoze pri odesilani kontroluji zda nekdo mezitim neprihodil	
            	}
            if ($this->template->status == 1)      
            {
                $this->flashMessage('K této nemovitosti nelze přihodit, dražba ještě nezačala.');
                $this->redirect('Nemovitosti:detailNemovitosti', $id); 
            } elseif ($this->template->status == 2) {
                $this->flashMessage('K této nemovitosti nelze přihodit, dražba již skončila.');
                $this->redirect('Nemovitosti:detailNemovitosti', $id); 
            }
        }

    }
    
    
    /* Smazat prihoz */
    
    // akce pred pouzitim renderSmazatPrihoz
    public function actionSmazatPrihoz($id = null) 
    {
        if (!$this->user->isAllowed('drazba','smazatPrihoz'))
            throw new Nette\Application\ForbiddenRequestException();       
    }
    
    // mazani prihozu
    public function renderSmazatPrihoz($id = null)
    {
        $form = $this['deletePrihozForm'];
        $form['send']->caption = 'Smazat příhoz';
        if (!$form->isSubmitted()) 
        {
            $this->template->prihoz = $this->database->findById('drazba', $id);
            if (!$this->template->prihoz) 
            {
                $this->flashMessage('Tento příhoz neexistuje. Je možné, že ho někdo smazal.');
                $this->redirect('Homepage:default'); 
            }
            $form['id_nemovitost']->value = $this->template->prihoz->id_nemovitost;
            $this->drazba->zahrnPocatecniNastaveni($this->template->prihoz->id_nemovitost);
            $this->template->status = $this->drazba->vratStatus();
        }
    }


    /* Tovarnicky pro formy */

    /**
      * Tovarnicka na formular pro mazani prihozu.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentDeletePrihozForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $form->addText('id_nemovitost')
        ->setAttribute('style', 'display:none');
        
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->deletePrihozFormSucceeded;
        return $form;
    }
    
    // metoda pro mazani prihozu
    public function deletePrihozFormSucceeded($button)
    {
        $id = (int) $this->getParameter('id');
        $values = $button->getForm()->getValues(true);
        $this->database->findById('drazba', $id)->delete();
        $this->flashMessage('Příhoz byl smazán.');
        $this->redirect('Aukce:vypisHistorieAukce', $values['id_nemovitost']);
    }
    

    /**
      * Tovarnicka na formular pro prihoz.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentPrihozForm()
    {
        $id = (int) $this->getParameter('id');
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id_uzivatel')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue($this->user->id);

        $form->addText('id_nemovitost')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue($id);
        
        $form->addText('pocet')
        ->setAttribute('style', 'display:none');
        
        $form->addText('vkladana_castka', 'Přihazovaná částka:')
        ->setType('number')
        ->setRequired('Prosím vložte částku, kterou chcete přihodit.')
        ->addRule(Nette\Application\UI\Form::MIN, 'Prosím vložte vyšší částku. Minimální příhoz je 5,000 Kč.', 5000)
        ->setAttribute('placeholder', 'Sem vložte částku v Kč.')
        ->setAttribute('class', 'castka')
        ->setAttribute('step', '1');

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->prihozFormSucceeded;
        return $form;
    }

    // zpracovani prihozu v aukci
    public function prihozFormSucceeded($button) 
    {
        $id = (int) $this->getParameter('id'); 
        $values = $button->getForm()->getValues(true);
        $values['datum_vkladu'] = date('Y-m-d H:i:s');
        if ($values['pocet'] == $this->database->findAll('drazba')->where('id_nemovitost', $values['id_nemovitost'])->count('*'))
        { // pokud se shoduji pocty prihozu pri nacteni a tesne pred prihozenim, pak vse ok    
            unset($values['pocet']);

            // priprava promennych pro poslani emailu o prehozeni
            $nemovitost = $this->database->findById('nemovitost', $id);
            $prihozy = $this->database->findAll('drazba')->where('id_nemovitost', $id);
            $drazba = $this->drazba->vyhodnotDrazbu($id, $prihozy);
            
            if($drazba["email"] != null || $drazba["email"] != "") 
            {

                // nastaveni parametru pro latte emailu
                $latte = new Nette\Latte\Engine;
                $params = array(
                    'nemovitost' => $nemovitost,
                    'uzivatel' => $drazba["jmeno"],
                    'cena' => $drazba["cena"] + $values["vkladana_castka"],
                );

                // nastaveni mailu
                $mail = new Nette\Mail\Message;
                $mail->setFrom('aukce.pps-reality@post.cz')
                    ->addTo($drazba["email"])
                    ->setHtmlBody($latte->renderToString(__DIR__ . '/../templates/Aukce/email.latte', $params));

                // poslani mailu
                $mailer = new Nette\Mail\SmtpMailer(array(
                        'host' => 'smtp.seznam.cz',
                        'username' => 'aukce.pps-reality@post.cz',
                        'password' => 'pps2015',
                        'secure' => 'ssl',
                ));
                $mailer->send($mail);
            }

            // prihozeni
            $this->database->insert('drazba', $values);
            $this->flashMessage('Přihodil(a) jste '. number_format($values['vkladana_castka']) .' Kč.');
            $this->redirect('Nemovitosti:detailNemovitosti', $values['id_nemovitost']);

        } else {
            
            $this->flashMessage('Znovu zvažte přihození, někdo před Vámi ještě navýšil cenu.');
            $this->redirect('Aukce:prihodit', $values['id_nemovitost']);
        }
    }


	/**
      * Tovarnicka na formular pro prvni prihoz.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentPrvniPrihozForm()
    {
        $id = (int) $this->getParameter('id');
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id_uzivatel')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue($this->user->id);

        $form->addText('id_nemovitost')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue($id);
        
        $form->addText('pocet')
        ->setAttribute('style', 'display:none');

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->prvniPrihozFormSucceeded;
        return $form;
    }

    // zpracovani prvniho prihozu v aukci
    public function prvniPrihozFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $values['datum_vkladu'] = date('Y-m-d H:i:s');
        $values['vkladana_castka'] = 0; // prvni prihoz je nulovy, pouze se potvrdi zadana castka
        if ($values['pocet'] == $this->database->findAll('drazba')->where('id_nemovitost', $values['id_nemovitost'])->count('*'))
        { // pokud se shoduji pocty prihozu pri nacteni a tesne pred prihozenim, pak vse ok    
            unset($values['pocet']);
            $this->database->insert('drazba', $values);
            $this->flashMessage('Podal(a) jste první nabídku.');
            $this->redirect('Nemovitosti:detailNemovitosti', $values['id_nemovitost']);
        } else {
            $this->flashMessage('Znovu zvažte přihození, někdo před Vámi ještě navýšil cenu.');
            $this->redirect('Aukce:prihodit', $values['id_nemovitost']);
        }
    }

}    
    