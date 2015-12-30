<?php

namespace App\Presenters;

use Nette,
    App\Model;


/**
 * Nemovitosti presenter.
 */
class NemovitostiPresenter extends BasePresenter
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
       
    
    /* ***************** Vypis publikovanych nemovitosti ***************** */

    // vypis vsech nemovitosti
    public function renderVypis($id = null)
    {
        $this->template->id = $id;
        switch ($id) {
            case 1: // nemovitosti cekajici na spusteni aukce
                $this->template->nemovitosti = $this->database->findAll('nemovitost')
                ->where('NOW() < datum_zacatek')->where('mod = 1')->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                break;
            case 2: // nemovitosti u kterych aukce jiz probehla
                $this->template->nemovitosti = $this->database->findAll('nemovitost')
                ->where('NOW() > datum_konec')->where('mod = 1')->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                break;
            case 4: // nemovitosti urcene k prodeji (bez aukce)
                $this->template->nemovitosti = $this->database->findAll('nemovitost')
                ->where('mod = 2')->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                break;
            case 5: // nemovitosti u ktere se prodali (bez aukce)
                $this->template->nemovitosti = $this->database->findAll('nemovitost')
                ->where('mod = 3')->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                break;
            default: // nemovitosti u kterych probiha aukce (jedna se o case 3, ale zobecnil jsem to)
                $this->template->nemovitosti = $this->database->findAll('nemovitost')
                ->where('NOW() BETWEEN datum_zacatek AND datum_konec')->where('mod = 1')->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                break;
        }
    }


    /* ***************** Vypis nepublikovanych nemovitosti ***************** */

    // akce volajici se pred renderVypisNepublikovanych 
    public function actionVypisNepublikovanych()
    {
        if (!$this->user->isAllowed('nemovitost','pridat'))
            throw new Nette\Application\ForbiddenRequestException();     
    }

    // vypis vsech nepublikovaných nemovitosti
    public function renderVypisNepublikovanych()
    {
        $this->template->nemovitosti = $this->database->findAll('nemovitost')->where('is_public', 0);
        $this['pubForm']['send']->caption = 'Publikovat';
    }
    

    /* ***************** Detail nemovitosti ***************** */

    // detail nemovitosti
    public function renderDetailNemovitosti($id = null)
    {
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost)
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default');
        }

        // vyberu fotky k dane nemovitosti
        $this->template->fotky = $this->database->findall('photo')->where('id_property', $id)->order("order DESC");
        // jako hlavni fotku vemu prvni z vyberu
        $this->template->hlavni_fotka = $this->template->fotky->fetch();

        // vyberu soubory k dane nemovitosti
        $this->template->files = $this->database->findall('file')->where('id_property', $id);

        // resim aukci
        $prihozy = $this->database->findAll('drazba')->where('id_nemovitost', $id);
        $this->template->drazba = $this->drazba->vyhodnotDrazbu($id, $prihozy);
        $this->template->status = $this->drazba->vratStatus();
    }


    /* Pridat nemovitost */
    
    // akce volajici se pred renderPridatNemovitost 
    public function actionPridatNemovitost()
    {
        if (!$this->user->isAllowed('nemovitost','pridat'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // pridani nove nemovitosti
    public function renderPridatNemovitost()
    {
        $this['nemovitostForm']['send']->caption = 'Přidat nemovitost';
    }
    
    
    /* ***************** Upravit nemovitost ***************** */
    
    // akce volajici se pred renderUpravitNemovitost 
    public function actionUpravitNemovitost($id = null)
    {
        if (!$this->user->isAllowed('nemovitost','upravit'))
            throw new Nette\Application\ForbiddenRequestException();     
    }
    
    // uprava nemovitosti
    public function renderUpravitNemovitost($id = null)
    {
        // propojim se s komponentou formu
        $form = $this['nemovitostForm'];
        $form['send']->caption = 'Upravit nemovitost';
        // pokusim nacist nemovitost
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        }
        // pokud nemovitost nactena provadim operace potrebne pro vykresleni template
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus();
        $form->setDefaults($this->template->nemovitost);
        $form['was_public']->value = $this->template->nemovitost->is_public;
        $form['datum_zacatek']->value = substr($this->template->nemovitost->datum_zacatek, 0, -3);
        $form['datum_konec']->value = substr($this->template->nemovitost->datum_konec, 0, -3);
    }
    

    /* ***************** Smazat nemovitost ***************** */

    // akce volajici se pred renderSmazatNemovitost 
    public function actionSmazatNemovitost($id = null)
    {
        if (!$this->user->isAllowed('nemovitost','smazat'))
            throw new Nette\Application\ForbiddenRequestException();     
    }

    public function renderSmazatNemovitost($id = null) {
        // propojim s formem
        $form = $this['deleteNemovitostForm'];
        $form['send']->caption = 'Smazat nemovitost';
        // pokusim nacist nemovitost
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        }
        // pokud nemovitost nactena provadim operace potrebne pro vykresleni template
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus();
        $form->setDefaults($this->template->nemovitost);
    }


    /* ***************** Tovarnicky pro formy ***************** */


    /**
      * Tovarnicka na formular pro publikovani nezverejnenych nemovitosti.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentPubForm()
    {
         $form = new Nette\Application\UI\Form;

         $form->addText('id');

         $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary')
        ->onClick[] = $this->pubFormSucceeded;

        $form->addProtection();
        return $form;
    }

    // metoda pro zpracovani formu pro publikovani novinek
    public function pubFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $nemovitost = $this->database->findById('nemovitost', $values['id']);
        if(!$nemovitost) {
        	$this->flashMessage('Nemovitost, kterou chcete publikovat není dostupná. Pravděpodobně ji někdo smazal.');
        	$this->redirect('vypisNepublikovanych');
        } else {
        	// pripravim pole cochci upravit
        	$upArr['public_date'] = date('Y-m-d H:i:s');
        	$upArr['is_public'] = 1;
        	// upravim
        	$nemovitost->update($upArr);
        	// presmerovani a informovani uzivatele
        	$this->flashMessage('Nemovitost byla úspěšně publikována.');
        	$this->redirect('detailNemovitosti', $nemovitost->id);
        }
    }


    /**
      * Tovarnicka na formular pro pridani a upravovani nemovitosti.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentNemovitostForm()
    {
        $id = (int) $this->getParameter('id');
        $form = new Nette\Application\UI\Form;
    
        $form->addText('id_uzivatel')
        ->setAttribute('style', 'display:none')
        ->setDefaultValue($this->user->id);

        $form->addText('nazev', 'Název nemovitosti:')
        ->setRequired('Prosím vložte název nemovitosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Název je příliš dlouhý.', 120)
        ->setAttribute('placeholder', 'Sem vložte název.');

        $form->addText('idn', 'ID nemovitosti:')
        ->setAttribute('placeholder', 'Sem vložte ID nemovitosti.');

        $mode = array( 1 => 'Byt', 2 => 'Dům', 3 => 'Pozemek', 4 => 'Ostatní');
        $form->addSelect('id_typ', 'Typ nemovitosti:', $mode);

        $mode = array( 1 => 'Nemovitost určená k aukci', 2 => 'Nemovitost určená k prodeji', 3 => 'Prodaná nemovitost');
        $form->addSelect('mod', 'Mód:', $mode);

        $mode = array( 'Aktivní' => 'Aktivní', 'Rezervováno' => 'Rezervováno', 'Po slevě' => 'Po slevě', 'Připravujeme k prodeji' => 'Připravujeme k prodeji');
        $form->addSelect('status', 'Stav nemovitosti:', $mode);
        
        $form->addText('adresa', 'Adresa nemovitosti:')
        ->setRequired('Prosím vložte adresu nemovitosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Adresa je příliš dlouhá.', 120)
        ->setAttribute('placeholder', 'Sem vložte adresu.');
        
        $form->addTextArea('popis', 'Popis nemovitosti:')
        ->setRequired('Prosím vložte popis nemovitosti.')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Popis je příliš dlouhý', 10000)
        ->setAttribute('placeholder', 'Sem vložte popis.');

        $form->addText('datum_zacatek', 'Začátek aukce:')
        ->setRequired('Prosím vložte datum a čas začátku dražby.')
        ->setAttribute('class', 'datetimepicker')
        ->setAttribute('placeholder', 'rrrr-mm-dd hh:mm');
        
        $form->addText('datum_konec', 'Konec aukce:')
        ->setRequired('Prosím vložte datum a čas konce dražby.')
        ->setAttribute('class', 'datetimepicker')
        ->setAttribute('placeholder', 'rrrr-mm-dd hh:mm');
        
        $form->addText('pocatecni_cena', 'Počáteční cena nemovitosti:')
        ->setType('number')
        ->setRequired('Prosím vložte počáteční cenu.')
        ->setAttribute('placeholder', 'Sem vložte počáteční cenu.');

        $mode = array( 'Včetně provize' => 'Včetně provize', '+ provize RK' => '+ provize RK');
        $form->addSelect('price_description', 'Poznámka k ceně:', $mode);

        $form->addCheckbox('is_public', 'Chcete nemovitost publikovat?')
        ->setDefaultValue(1); 

        $form->addCheckbox('was_public');

        $form->addTextArea('admin_description', 'Poznámka administrátora:')
        ->setAttribute('placeholder', 'Sem lze vložit poznámku administrátora, která bude běžným uživatelům skryta.');

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary')
        ->onClick[] = $this->nemovitostFormSucceeded;

        $form->addProtection();
        return $form;
    }
    
    // metoda pro zpracovani odeslaneho formulare nemovitosti
    public function nemovitostFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $id = (int) $this->getParameter('id'); 

        // aktualni datum a cas, potrebuji pro presmerovani a vkladani public_timu pri insertu
        $now = date('Y-m-d H:i:s');

        // pokud nemovitost prechazi ze stavu ne-public do public
        if (($values['was_public'] == false) && ($values['is_public'] == true)) {
            $values['public_date'] = $now; // zmenim datum publikovani (razena bude tedy jako nove pridana)
            unset($values['was_public']);
        } else {
            unset($values['was_public']);
        }

        if($id)
        {
            $this->database->findById('nemovitost', $id)->update($values);
            $this->flashMessage('Nemovitost byla upravena.');
            // pri uprave presmeruji na detail nemovitosti
            $this->redirect('DetailNemovitosti', $id);
        } else {
            $values['public_date'] =  $now; // pri vkladani datumu k nove nemovitosti na stavu public nezalezi
            $this->database->insert('nemovitost', $values);
            $this->flashMessage('Nemovitost byla vložena.');

            // pri vkladani ne-public premeruji na ne-public vypis
            if ($values['is_public'] == 0) {
                $this->redirect('vypisNepublikovanych');
            } else {
                // pri vkladani public nemovitost presmeruji na vypis
                switch ($values['mod']) {
                    case 1: // aukce
                    	if ($values['datum_zacatek'] > $now) // vyhodnoti status drazby
        		        {
        		            $this->redirect('vypis', 1); // drazba nemovitosti nezacala
        		        }
        		        elseif ($values['datum_konec'] < $now)
        		        {
        		            $this->redirect('vypis', 2); // drazba nemovitosti skoncila        
        		        }
        		        else
        		        {
        		            $this->redirect('vypis', 3); // drazba nemovitosti probiha          
        		        }
                        break;
                    case 2: // prodej
                        $this->redirect('vypis', 4);
                        break;
                    case 3: // prodane
                        $this->redirect('vypis', 5);
                        break;
                }
            }
        }
    }
    
    /**
      * Tovarnicka na formular pro smazani nemovitosti.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentDeleteNemovitostForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = $this->deleteNemovitostFormSucceeded;
        return $form;
    }

    // metoda pro mazani nemovitosti
    public function deleteNemovitostFormSucceeded()
    {
        $id = (int) $this->getParameter('id'); 
        
        // smazu vsechny fotky z adresare
        if (is_dir(WWW_DIR . "/images/auction/".$id."/"))
            $this->deleteDir(WWW_DIR . "/images/auction/".$id."/"); 
        
        // smazu vsechny soubory z adresare
        if (is_dir(WWW_DIR . "/files/auction/".$id."/"))
            $this->deleteDir(WWW_DIR . "/files/auction/".$id."/");           
        
        $this->database->findById('nemovitost', $id)->delete();
        $this->flashMessage('Nemovitost byla smazána.');
        $this->redirect('Homepage:default');
    }
    
    // fce pro mazani cele slozky
    public function deleteDir($directory)
    {
        $dirContent = Nette\Utils\Finder::find('*')->from($directory)->childFirst();
        foreach ($dirContent as $file) {
            if ($file->isDir())
                @rmdir($file->getPathname());
            else
                @unlink($file->getPathname());
        }
        @unlink($directory);
    }


}    
    