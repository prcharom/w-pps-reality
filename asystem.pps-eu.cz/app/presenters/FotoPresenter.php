<?php

namespace App\Presenters;

use Nette,
    App\Model;


/**
 * Foto presenter.
 */
class FotoPresenter extends BasePresenter
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


    /* Nahravani novych fotografii k nemovitosti */

    // akce pred pouzitim renderUpload
    public function actionUpload($id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','pridatFoto'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // nahrat fotografii
    public function renderUpload($id = null)
    {
        $form = $this['uploadPhotoForm'];
        $form['send']->caption = 'Nahrát fotografie';
        if (!$form->isSubmitted()) 
        {
            $this->template->nemovitost = $this->database->findById('nemovitost', $id);
            if (!$this->template->nemovitost) 
            {
                $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
                $this->redirect('Homepage:default'); 
            } 
            $this->drazba->zahrnPocatecniNastaveni($id);
            $this->template->status = $this->drazba->vratStatus();
        }
    }


    /* Mazani fotografii k nemovitosti */

    // akce pred pouzitim renderSmazat
    public function actionSmazat($id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','smazatFoto'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // smazat fotografie
    public function renderSmazat($id = null)
    {
        $form = $this['deletePhotoForm'];
        $form['send']->caption = 'Smazat fotografie';
        if (!$form->isSubmitted()) 
        {
            $this->template->nemovitost = $this->database->findById('nemovitost', $id);
            if (!$this->template->nemovitost) 
            {
                $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
                $this->redirect('Homepage:default'); 
            }
            $this->drazba->zahrnPocatecniNastaveni($id);
            $this->template->status = $this->drazba->vratStatus(); 
        }
    }


    /* Vyber hlavni fotografie k nemovitosti */

    // akce pred pouzitim renderNastavHlavniFoto
    public function actionNastavHlavniFoto($id = null) 
    {
        if (!$this->user->isAllowed('nemovitost','nastavHlavniFoto'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // vybrat hlavni fotografii
    public function renderNastavHlavniFoto($id = null)
    {
        $form = $this['setMainPhotoForm'];
        $form['send']->caption = 'Nastavit hlavní foto'; 
		$this->template->nemovitost = $this->database->findById('nemovitost', $id);
		// osetreni nemovitosti a nastaveni statusu
        if (!$this->template->nemovitost) 
        {
            $this->flashMessage('Tato nemovitost neexistuje. Je možné, že ji někdo smazal.');
                $this->redirect('Homepage:default'); 
        }
        $this->drazba->zahrnPocatecniNastaveni($id);
        $this->template->status = $this->drazba->vratStatus(); 

        $main_photo = false;
        // pokusim se nactist hlavni foto k dane nemovitosti
        $main_photo = $this->database->findAll("photo")->where("id_property", $id)->where("order", 1)->fetch(); 
        if ($main_photo != false) { // nasel jsem ho 
        	$this->template->main_photo_id = $main_photo->id; // vratim id nemovitosti
        } else { // nenasel jsem ho
        	$this->template->main_photo_id = 0;
        }
    }


    /* Tovarnicky pro formy */
    
    /**
      * Tovarnicka na formular pro upload fotografii.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentUploadPhotoForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $form->addUpload('img', 'Fotografie:', TRUE)
        ->setRequired('Vyberte prosím fotografie, které chcete nahrát.')
        ->addRule(Nette\Application\UI\Form::IMAGE, 'Fotografie musí být JPEG, PNG nebo GIF.')
        ->addRule(Nette\Application\UI\Form::MAX_FILE_SIZE, 'Maximální velikost fotografie je 2 MB.', 2 * 1024 * 1024 /* v bytech */);

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary')
        ->onClick[] = $this->uploadPhotoFormSucceeded;

        $form->addProtection();
        return $form;
    }

    public function uploadPhotoFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $id = (int) $this->getParameter('id'); 
        $values['id_property'] = $id;

        $images = $values['img']; // ulozim si pole s obrazky do pomocne promene
        unset($values['img']); // unsetnu formularove pole s obrazky, abych mohl beztrestne vkladat data do db
        
        $citac = 0;
        foreach($images as $img)
        {
	        // operace pro nahrani fota k nemovitosti
	        if ($img->isOk() && $img->isImage())
	        {
	        	// citac pouzivam k modifikaci nazvu, abych nenahral dve fotografie se stejnym timestampem
	        	// je jasne ze 100. uploadovana fotka nebude mit stejny timestamp jako prvni
	        	$citac++; 
	        	if($citac > 99)
	        		$citac = 0;

	            $timestamp = date('YmdHis', time());
	            $typ = substr($img->getName(), -4);
	            // umisteni fotografie ../id_nemovitosti/citac&timestamp.typ
	            $values['name'] = $citac . $timestamp . $typ;
	            // pomoci nette si obrazek zmensim a ulozim na server jiz zmenseny, z duvodu setreni mista, neni duvod ukladat vetsi rozliseni nez vyuziji 
	            // kdybych se rozhodl, ze chci obr v plne velikosti, smazu radky az po $img->move a odkomentuji $img->move
	            $img_tmp = Nette\Utils\Image::fromFile($img);
                // pokud nahravany obrazek presahuje velikosti 800px, tak ho upravim
                if ($img_tmp->width > 800)
	               $img_tmp->resize(800, null); // w = 342px, h = auto
	            $img_tmp->sharpen(); // doostreni obrazku
	            if(!is_dir(WWW_DIR . "/images/auction/". $id . "/")) // pokud neni vytvorena slozka, tak ji vytvorim
	            {
	            	mkdir(WWW_DIR . "/images/auction/". $id . "/", 0700 ); // vytvorení složky 
					chmod(WWW_DIR . "/images/auction/". $id . "/", 0777 );  // nastaveni atributu
	            }
	            $img_tmp->save(WWW_DIR . "/images/auction/". $id . "/" . $values['name']);
	            //$img->move(WWW_DIR . "/images/auction/". $id . "/" . $values['name']);
	            $this->database->insert('photo', $values);
	        }
	    }
	    $this->flashMessage('Fotografie byly nahrány.');
	    $this->redirect('Nemovitosti:detailNemovitosti', $id);
    }


    /**
      * Tovarnicka na formular pro mazani fotografii.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentDeletePhotoForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $id = (int) $this->getParameter('id'); 
        $this->template->photos = $this->database->findAll('photo')->where('id_property', $id);

        foreach($this->template->photos as $photo)
        {
            $form->addCheckbox($photo->id); 
        }

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary')
        ->onClick[] = $this->deletePhotoFormSucceeded;

        $form->addProtection();
        return $form;
    }

    public function deletePhotoFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);
        $id = (int) $this->getParameter('id'); 
        // projdu vsechny fotky k dane udalosti a smazu ty ktere byly zaskrtle
        $photos = $this->database->findAll('photo')->where('id_property', $id);
        foreach($photos as $photo)
        {
            if($values["$photo->id"] == true)
            {
                unlink(WWW_DIR . "/images/auction/". $photo->id_property . "/" . $photo->name); // smazu ve slozce
                $photo->delete(); // smazu v db
            }
        }
        $this->flashMessage('Vámi vybrané fotografie byly smazány.');
        $this->redirect('Foto:smazat', $id);
    }


    /**
      * Tovarnicka na formular pro vyber hlavni fotografie.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentSetMainPhotoForm()
    {
        $form = new Nette\Application\UI\Form;
        
        $id = (int) $this->getParameter('id'); 
        $this->template->photos = $this->database->findAll('photo')->where('id_property', $id);

        $i = 0;
        $first_checkbox = null;
        $is_set_any_main_photo = false;
        // pridam tolik checkboxu kolik je fotek
        foreach($this->template->photos as $photo)
        {	
        	if ($i == 0) // ulozim si id prvniho checkboxu
        		$first_checkbox = $photo->id;
        	++$i;

        	if ($photo->order == 1) { // pokud mam v db nastavenou hlavni fotku
            	$form->addCheckbox($photo->id)->setValue(true); // nastavim checkbox zaskrtnuty
            	$is_set_any_main_photo = true; // a dam si vedet ze nastaveno jiz mam
        	} else { 
        		$form->addCheckbox($photo->id); 
        	}
        }

        // pokud uzivatel nenastavil doposud hlavni fotku
        if ($first_checkbox != null && $is_set_any_main_photo == false)
        	$form["$first_checkbox"]->setValue(true); // defaultne je brana prvni jako hlavni

        $form->addSubmit('send', 'Odeslat formulář')
        ->setAttribute('class', 'btn btn-primary')
        ->onClick[] = $this->setMainPhotoFormSucceeded;

        $form->addProtection();
        return $form;
    }

    public function setMainPhotoFormSucceeded($button) 
    {
        $values = $button->getForm()->getValues(true);

        // priprava pomocnyh prom
        $id = (int) $this->getParameter('id'); 
        $photos = $this->database->findAll('photo')->where('id_property', $id);
        $selected_main_photo = null;
        $prev_main_photo = null;

        // projdu vsechny fotky k dane udalosti
        foreach($photos as $photo)
        {
        	// najdu predchozi hlavni a nastavim ji na 0 
        	if($photo->order == 1)
            {
            	$prev_main_photo = $photo->id;
            }

          	// vyberu kterou vybral uzivatel a nastavim ji jako hlavni (1)
            if($values["$photo->id"] == true)
            {
            	$selected_main_photo = $photo->id;
            }
        }

        // uprava stare hlavni fotky
        if ($prev_main_photo != null) { // pokud vubec mame nejakou vybranou starou fotku
        	$photo = $this->database->findById('photo', $prev_main_photo);
        	if ($photo && $photo->id_property == $id) { // pokud ji tedy mam v db
        		// tak ji odoznacime jako hlavni fotku
        		$upArr["order"] = 0;
        		$photo->update($upArr);
        	}
        }

        // uprava nove hlavni fotky
        if ($selected_main_photo != null) { // pokud vubec mame nejakou vybranou novou fotku
        	$photo = $this->database->findById('photo', $selected_main_photo);
        	if ($photo && $photo->id_property == $id) { // pokud ji tedy mam v db
        		// tak ji oznacime jako hlavni fotku
        		$upArr["order"] = 1;
        		$photo->update($upArr);
        	}
        }

        // informace pro uzivatele + presmerovani
        $this->flashMessage('Hlavni fotografie byla upravena.');
        $this->redirect('Nemovitosti:detailNemovitosti', $id);
    }

}
