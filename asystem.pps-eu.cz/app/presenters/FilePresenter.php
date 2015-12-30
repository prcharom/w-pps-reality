<?php

namespace App\Presenters;

use Nette,
    App\Model,
    Nette\Utils\Strings;


/**
 * File presenter.
 */
class FilePresenter extends BasePresenter
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


    /* Nahravani novych PDF k nemovitosti */

    // akce pred pouzitim renderUpload
    public function actionUpload($id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','pridatFile'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // nahrat pdf
    public function renderUpload($id = null)
    {
        $form = $this['uploadFileForm'];
        $form['send']->caption = 'Nahrát PDF';
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        } 
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus();
    }


     /* Nahravani novych PDF k nemovitosti */

    // akce pred pouzitim renderVypis
    public function actionVypis($id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','vypisFile'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // vypis pdf
    public function renderVypis($id = null)
    {   
        // nejdriv si overim ze nemovitost opravdu existuje
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        } 
        // pokud existuje vyhleam prilozene soubory a zjistim nastaveni
        $this->template->files = $this->database->findAll('file')->where('id_property', $id);
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus();
    }


    /* Edit pdf */

    // akce pred pouzitim renderEdit
    public function actionEdit($id = null, $file_id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','upravitFile'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // edit souboru
    public function renderEdit($id = null, $file_id = null)
    {
        // definice formu a uprava popisku
        $form = $this['uploadFileForm'];
        $form['send']->caption = 'Upravit název PDF';

        // overim ze nemovitost opravdu existuje
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        } 

        // pokus o nacteni file z db
        $file = $this->database->findById('file', (int)$file_id);
        // pokud se mi nepodari najit soubor a nebo soubor nepatri nemovitosti, ze ktere se na ni snazi uzivatel dostat
        if(!$file || (isset($file) && $file->id_property != $id)) 
        {
            $this->flashMessage('Požadovaný soubor není dostupný.');
            $this->redirect('File:vypis', $id);
        }
        $form->setDefaults($file);
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus(); 
    }


    /* Delete pdf */

    // akce pred pouzitim renderDelete
    public function actionDelete($id = null, $file_id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','upravitFile'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // edit souboru
    public function renderDelete($id = null, $file_id = null)
    {
        // definice formu a uprava popisku buttonu
        $form = $this['deleteFileForm'];
        $form['del']->caption = 'Smazat PDF';

        // overim ze nemovitost opravdu existuje
        $this->template->nemovitost = $this->database->findById('nemovitost', $id);
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
            $this->redirect('Homepage:default'); 
        } 

        // pokus o nacteni file z db
        $file = $this->database->findById('file', (int)$file_id);
        // pokud se mi nepodari najit soubor a nebo soubor nepatri nemovitosti, ze ktere se na ni snazi uzivatel dostat
        if(!$file || (isset($file) && $file->id_property != $id)) 
        {
            $this->flashMessage('Požadovaný soubor není dostupný.');
            $this->redirect('File:vypis', $id);
        }
        $this->template->file = $file; // predam si file i do sablony pro vypis
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus(); 
    }


    /* Tovarnicky pro formy */
    
    /**
      * Tovarnicka na formular pro upload pdf.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentUploadFileForm()
    {
        $file_id = (int) $this->getParameter('file_id'); 
        $form = new Nette\Application\UI\Form;

        $form->addText('name', 'Název PDF:')
        ->setRequired('Prosím vyplňte název PDF.')
        ->setAttribute('placeholder', 'Sem vložte název PDF')
        ->addRule(Nette\Application\UI\Form::MAX_LENGTH, 'Maximální délka názvu PDF je %d znaků.', 50);
        
        // moznost uploadu pouze jednali se o pridavani 
        if (!isset($file_id) || (isset($file_id) && $file_id == 0)) {
            $form->addUpload('file', 'PDF:')
            ->setRequired('Vyberte prosím PDF soubory, které chcete nahrát.');
        }

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary')
        ->onClick[] = $this->uploadFileFormSucceeded;

        $form->addProtection();
        return $form;
    }

    // fce provede akci po kliknuti na tlacitko pro pridani / upravu
    public function uploadFileFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);

        // nacteni potrebnych id
        $id = (int) $this->getParameter('id'); 
        $file_id = (int) $this->getParameter('file_id');

        // ulozeni id nemovitosti k souboru
        $values['id_property'] = $id;

        // smazu diakritiku a mezery nahradim pomlckou
        $values['hid_name'] = Strings::webalize($values['name'], NULL, FALSE);


        // pokud vytvrarim nove a mam povoleny upload, tak uploadovany soubor zpracuji
        if (!isset($file_id) || (isset($file_id) && $file_id == 0)) {
            // vytvorim si prom pro praci s uploadovanym souborem
            $file = $values['file']; 
            unset($values['file']); // do db tuto promenou neukladam tak ji unsetnu
        } else { 
            // pokud jsem v editovacim rezimu 
            $file = $this->database->findById('file', $file_id);
            // pokud se mi nepodari najit soubor a nebo soubor nepatri nemovitosti, ze ktere se na ni snazi uzivatel dostat
            if(!$file || (isset($file) && $file->id_property != $id)) 
            {
                $this->flashMessage('Požadovaný soubor není dostupný.');
                $this->redirect('File:vypis', $id);
            } 
            // prejmenuji soubor ve slozce
            $oldname = WWW_DIR . "/files/auction/" . $file->id_property . "/" . $file->hid_name . "-" . $file->timestamp . "." . $file->type;
            $newname = WWW_DIR . "/files/auction/" . $file->id_property . "/" . $values['hid_name'] . "-" . $file->timestamp . "." . $file->type;
            $rename = rename($oldname, $newname);
            if ($rename == true) { // pokud se zmena povedla, zmenim i nazev v db

                $file->update($values);
                $this->flashMessage('Soubor byl úspěšně přejmenován na "' . $file->name . '".');
                $this->redirect('File:vypis', $id);

            } else { // pokud ne pouze uzivatele informuji

                $this->flashMessage('Soubor se nepodařilo přejmenovat.');
                $this->redirect('File:vypis', $id);
            }
        }
 

        if ($file->isOK()) {

            /* Zjisteni a ulozeni typu */
            // nactu si jmeno uploadovaneho souboru
            $tmp_file_name = $file->getName();
            // rozdelim si nazev souboru dle tecek
            $tmp_file_name_separated = explode(".", $tmp_file_name);
            $c = count($tmp_file_name_separated)-1; // zjistim velikost pole (odecitam jednicku, protoze php pocita pole od 0)
            // typ je schovan na konci
            $values['type'] = $tmp_file_name_separated[$c];
            // presmerovani pokud se jedna o jiny soubor nez pdf
            if ($values['type'] != "pdf") {
                $this->flashMessage('Soubor "' . $values['name'] . '" se nepodařilo přidat. Přidávat lze pouze PDF soubory.');
                $this->redirect('Nemovitosti:detailNemovitosti', $id);       
            }

            // zjistim velikost souboru
            $values['size'] = round( $file->getSize()/(1024*1024) , 2); // prepocet na MB

            /* Priprava pro upload */
            // ulozim si timestamp abych zarucil unikatnost odkazu
            $values['timestamp'] = date('YmdHis', time());
            // koncova destinace
            $destination = $values['hid_name'] . "-" . $values['timestamp'] . "." . $values['type']; 

            /* Upload */
            $file->move(WWW_DIR . "/files/auction/". $id . "/" . $destination); // presun na server
	        $this->database->insert('file', $values); // ulozeni do db

            // nastaveni flash zpravy a presmerovani po uspesnem vykonani
            $this->flashMessage('Soubor "' . $values['name'] . '" byl úspěšně nahrán.');
            $this->redirect('Nemovitosti:detailNemovitosti', $id);
	    } else {
            // nastaveni flash zpravy a presmerovani po neuspesnem vykonani
	       $this->flashMessage('Soubor se nepodařilo nahrát. Zkontrolujte prosím své připojení k internetu a opakujte akci.');
	       $this->redirect('Nemovitosti:detailNemovitosti', $id);
        }
    }


    /**
      * Tovarnicka na formular pro upload pdf.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentDeleteFileForm()
    {
    	$form = new Nette\Application\UI\Form;

        $form->addSubmit('del', 'Smazat soubor')
        	->setAttribute('class', 'btn btn-primary')
            ->onClick[] = $this->deleteFileFormSucceeded;

        $form->addProtection();
        return $form;
    }

    // akce ktera se provede po kliknuti na tlacitko smazat
    public function deleteFileFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);

        // nactu id z url
        $id = (int) $this->getParameter('id');
        $file_id = (int) $this->getParameter('file_id'); 

        // pripravim si promennou pro jmena mazaneho souboru pro vypsani
        $tmp_name = null;     
           
        // vyberu soubor z db
        $file = $this->database->findById('file', $file_id);
        if($file) {
            $tmp_name = $file->name;
            unlink(WWW_DIR . "/files/auction/". $file->id_property . "/" . $file->hid_name . "-" . $file->timestamp . "." . $file->type); // smazu ve slozce
            $file->delete(); // smazu v db  
        }
        $this->flashMessage('Soubor "' . $tmp_name . '" byl smazán.');
        $this->redirect('File:vypis', $id);
    }


}
