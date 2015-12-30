<?php

namespace App\Presenters;

use Nette,
    App\Model;


/**
 * Vyhledavaci presenter.
 */
class SearchPresenter extends BasePresenter
{       
        /** @var Model\Database */
        private $database; 
        
	public function __construct(Model\Database $database)
	{
        $this->database = $database;
	}
    

    /* Vypis vyhledanych polozek */
    
    // akce pred pouzitim renderVysledkyHledani
    public function actionZakladniVyhledavani($q = null) 
    {
        if (!$this->user->isAllowed('zakladni','domovska_stranka'))
            throw new Nette\Application\ForbiddenRequestException();       
    }
    
    // vypis vyhledanych polozek
    public function renderZakladniVyhledavani($q = null)
    {
        
        $this->template->n_nemovitosti = $this->template->p_nemovitosti = $this->template->i_nemovitosti = $this->template->a_nemovitosti = array();

        // aby nemizel vyhledavany text ze search baru
        $form = $this['basicSearchForm'];
        $form['search']->defaultValue = $q;

        $this->template->q = $q;

        if(isset($q) && $q != "") {
            // obsazeno v nazvech
            $this->template->n_nemovitosti = $this->database->findAll('nemovitost')->where('nazev LIKE ?', '%'. $q .'%')
            ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
            // obsazeno v popisu
            $this->template->p_nemovitosti = $this->database->findAll('nemovitost')->where('popis LIKE ?', '%'. $q .'%')
            ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
            // obsazeno v adrese
            $this->template->a_nemovitosti = $this->database->findAll('nemovitost')->where('adresa LIKE ?', '%'. $q .'%')
            ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
            // obsazeno v popisu
            $this->template->i_nemovitosti = $this->database->findAll('nemovitost')->where('idn LIKE ?', '%'. $q .'%')
            ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
        }

    }

    // akce pred pouzitim renderRozsireneVyhledavani
    public function actionRozsireneVyhledavani($id = null, $q = null) 
    {
        if (!$this->user->isAllowed('zakladni','domovska_stranka'))
            throw new Nette\Application\ForbiddenRequestException();       
    }

    // vypis vyhledanych polozek
    public function renderRozsireneVyhledavani($id = null, $q = null)
    {
        
        $this->template->id = $id;
        $min = 0;
        $max = 0;
        $t1 = $t2 = $t3 = $t4 = 1;
        $this->template->n_nemovitosti = $this->template->p_nemovitosti = $this->template->i_nemovitosti = $this->template->a_nemovitosti = array();
        $this->template->is_q = false;

        // aby nemizel vyhledavany text ze search baru
        $form = $this['searchForm'];
        $form['search']->defaultValue = $q;

            // vycteni informaci z id
            $info = explode("-", $id);
            $id = intval($info[0]); // ziskam id
            if(isset($info[1]))
                $min = intval($info[1]); // ziskam min
            if(isset($info[2]))
                $max = intval($info[2]); // ziskam max
            if(isset($info[3]))
                $t1 = intval($info[3]); // vyhledavam v bytech
            if(isset($info[4]))
                $t2 = intval($info[4]); // vyhledavam v domech
            if(isset($info[5]))
                $t3 = intval($info[5]); // vyhledavam v pozemcich
            if(isset($info[6]))
                $t4 = intval($info[6]); // vyhledavam v ostatnich

            $form['t1']->defaultValue = $t1;
            $form['t2']->defaultValue = $t2;
            $form['t3']->defaultValue = $t3;
            $form['t4']->defaultValue = $t4;

            // pokud uzivatel zadal kladne cislo tak to opet nahraji do formu
            if($min > 0)
                $form['min']->defaultValue = $min;

            if($max > 0)
                $form['max']->defaultValue = $max;

        if($q != null || $q != "" || $min > 0 || $max > 0)
        {

            // obsazeno v nazvech
            $this->template->n_nemovitosti = $this->database->findAll('nemovitost')->where('nazev LIKE ?', '%'. $q .'%')
            ->where('is_public', 1)->order('public_date DESC')->order('id DESC');

            if($q != null || $q != "")
            {
                // hledany retezec je zadan
                $this->template->is_q = true;

                switch ($id) {
                    
                    case 1:
                        // vyhledavani v popisu
                        $this->template->p_nemovitosti = $this->database->findAll('nemovitost')->where('popis LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC'); 
                        $form['s1']->defaultValue = 1;
                        break;   
                    
                    case 2:
                        // hledano v adrese
                        $this->template->a_nemovitosti = $this->database->findAll('nemovitost')->where('adresa LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                        $form['s2']->defaultValue = 1;
                        break;
                
                    case 3:
                        // hledano v idn
                        $this->template->i_nemovitosti = $this->database->findAll('nemovitost')->where('idn LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                        $form['s3']->defaultValue = 1;
                        break;

                    case 12:
                        // hledano v popisu a adrese
                        $this->template->p_nemovitosti = $this->database->findAll('nemovitost')->where('popis LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');   
                        $this->template->a_nemovitosti = $this->database->findAll('nemovitost')->where('adresa LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                        $form['s1']->defaultValue = 1;
                        $form['s2']->defaultValue = 1;
                        break;

                    case 13:
                        // hledano v popisu a idn
                        $this->template->p_nemovitosti = $this->database->findAll('nemovitost')->where('popis LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');   
                        $this->template->i_nemovitosti = $this->database->findAll('nemovitost')->where('idn LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                        $form['s1']->defaultValue = 1;
                        $form['s3']->defaultValue = 1;
                        break;

                    case 23:
                        // hledano v adrese a idn
                        $this->template->a_nemovitosti = $this->database->findAll('nemovitost')->where('adresa LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');   
                        $this->template->i_nemovitosti = $this->database->findAll('nemovitost')->where('idn LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                        $form['s2']->defaultValue = 1;
                        $form['s3']->defaultValue = 1;
                        break;

                    case 123:
                        // hledano v popisu, adrese i idn
                        $this->template->p_nemovitosti = $this->database->findAll('nemovitost')->where('popis LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC'); 
                        $this->template->a_nemovitosti = $this->database->findAll('nemovitost')->where('adresa LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');  
                        $this->template->i_nemovitosti = $this->database->findAll('nemovitost')->where('idn LIKE ?', '%'. $q .'%')
                        ->where('is_public', 1)->order('public_date DESC')->order('id DESC');
                        $form['s1']->defaultValue = 1;
                        $form['s2']->defaultValue = 1;
                        $form['s3']->defaultValue = 1;
                        break;
                }
            }

            if($min > 0 && $max > 0) { // jestli uzivatel vyhledava i min a max

                $this->template->n_nemovitosti = $this->template->n_nemovitosti->where('pocatecni_cena >= ?', $min)->where('pocatecni_cena <= ?', $max);
                if(!is_array($this->template->p_nemovitosti))
                    $this->template->p_nemovitosti = $this->template->p_nemovitosti->where('pocatecni_cena >= ?', $min)->where('pocatecni_cena <= ?', $max);
                if(!is_array($this->template->a_nemovitosti))
                    $this->template->a_nemovitosti = $this->template->a_nemovitosti->where('pocatecni_cena >= ?', $min)->where('pocatecni_cena <= ?', $max);
                if(!is_array($this->template->i_nemovitosti))
                    $this->template->i_nemovitosti = $this->template->i_nemovitosti->where('pocatecni_cena >= ?', $min)->where('pocatecni_cena <= ?', $max);

            } elseif($min > 0) { // jestli uzivatel vyhledava jen dle min

                $this->template->n_nemovitosti = $this->template->n_nemovitosti->where('pocatecni_cena >= ?', $min);
                if(!is_array($this->template->p_nemovitosti))
                    $this->template->p_nemovitosti = $this->template->p_nemovitosti->where('pocatecni_cena >= ?', $min);
                if(!is_array($this->template->a_nemovitosti))
                    $this->template->a_nemovitosti = $this->template->a_nemovitosti->where('pocatecni_cena >= ?', $min);
                if(!is_array($this->template->i_nemovitosti))
                    $this->template->i_nemovitosti = $this->template->i_nemovitosti->where('pocatecni_cena >= ?', $min);

            } elseif($max > 0) { // jestli uzivatel vyhledava jen v max

                $this->template->n_nemovitosti = $this->template->n_nemovitosti->where('pocatecni_cena <= ?', $max);
                if(!is_array($this->template->p_nemovitosti))
                    $this->template->p_nemovitosti = $this->template->p_nemovitosti->where('pocatecni_cena <= ?', $max);
                if(!is_array($this->template->a_nemovitosti))
                    $this->template->a_nemovitosti = $this->template->a_nemovitosti->where('pocatecni_cena <= ?', $max);
                if(!is_array($this->template->i_nemovitosti))
                    $this->template->i_nemovitosti = $this->template->i_nemovitosti->where('pocatecni_cena <= ?', $max);

            }

            // nette sql where id_typ = $arr[0] OR id_typ = $arr[1] OR ...
            $where = ""; 
            $whereArr = array();

            if($t1 == 1) {
                $where = $where . "id_typ = ?";
                $whereArr[0] = 1;
            }

            if($t2 == 1) { 
                if($t1 == 1)
                    $where = $where . " OR ";
                $where = $where . "id_typ = ?";
                $i = count($whereArr);
                $whereArr[$i] = 2;
            }

            if($t3 == 1) { 
                if($t2 == 1)
                    $where = $where . " OR ";    
                elseif($t1 == 1)
                    $where = $where . " OR ";
                $where = $where . "id_typ = ?";
                $i = count($whereArr);
                $whereArr[$i] = 3;
            } 

            if($t4 == 1) {
                if($t3 == 1)
                    $where = $where . " OR ";    
                elseif($t2 == 1)
                    $where = $where . " OR ";
                elseif($t1 == 1)
                    $where = $where . " OR ";
                $where = $where . "id_typ = ?";
                $i = count($whereArr);
                $whereArr[$i] = 4;    
            } 

            if($where != "") { 

                if(count($whereArr) > 1) {

                    $this->template->n_nemovitosti = $this->template->n_nemovitosti->where($where, $whereArr);
                    if(!is_array($this->template->p_nemovitosti))
                        $this->template->p_nemovitosti = $this->template->p_nemovitosti->where($where, $whereArr);
                    if(!is_array($this->template->a_nemovitosti))
                        $this->template->a_nemovitosti = $this->template->a_nemovitosti->where($where, $whereArr);
                    if(!is_array($this->template->i_nemovitosti))
                        $this->template->i_nemovitosti = $this->template->i_nemovitosti->where($where, $whereArr);
                
                } else { // osetreni chyby aby to nepadalo kvuli 1 prvkovemu poli

                    $this->template->n_nemovitosti = $this->template->n_nemovitosti->where($where, $whereArr[0]);
                    if(!is_array($this->template->p_nemovitosti))
                        $this->template->p_nemovitosti = $this->template->p_nemovitosti->where($where, $whereArr[0]);
                    if(!is_array($this->template->a_nemovitosti))
                        $this->template->a_nemovitosti = $this->template->a_nemovitosti->where($where, $whereArr[0]);
                    if(!is_array($this->template->i_nemovitosti))
                        $this->template->i_nemovitosti = $this->template->i_nemovitosti->where($where, $whereArr[0]);
                
                }

            } else { // pokud jsou vsechny typy ve formu uzivatelem vykliknuty, tak nema cenu nic vracet
                $this->template->n_nemovitosti = $this->template->p_nemovitosti = $this->template->i_nemovitosti = $this->template->a_nemovitosti = array();    
            }
        }
    }

    /***** Tovarnicky *****/

    /**
      * Tovarnicka na formular pro vyhledávání.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentSearchForm()
    {
        $form = new Nette\Application\UI\Form;
    
        $form->addText('search');

        $form->addSubmit('send', 'Najít')
        ->setAttribute('class', 'btn btn-primary');

        $form->addCheckbox('t1', 'Byt')
        ->setDefaultValue(1);

        $form->addCheckbox('t2', 'Dům')
        ->setDefaultValue(1);

        $form->addCheckbox('t3', 'Pozemek')
        ->setDefaultValue(1);

        $form->addCheckbox('t4', 'Ostatní')
        ->setDefaultValue(1);

        $form->addCheckbox('s1', 'Vyhledat i v popisu nemovitosti.')
        ->setDefaultValue(0);

        $form->addCheckbox('s2', 'Vyhledat i v adrese nemovitosti.')
        ->setDefaultValue(0);

        $form->addCheckbox('s3', 'Vyhledat i v id nemovitosti.')
        ->setDefaultValue(0);

        $form->addText('min', 'Minimální cena:')
        ->setType('number');

        $form->addText('max', 'Maximální cena:')
        ->setType('number');


        $form->onSuccess[] = function(Nette\Application\UI\Form $form) {
            $obj = $form->getValues();
            
            $id = ""; // vyhledavam jen v nadpisech
            if($obj->s1 == 1)
                $id = $id . "1"; // vyhledavam i v popisu nemovitosti
            if($obj->s2 == 1)
                $id = $id . "2"; // vyhledavam i v adrese nemovitosti
            if($obj->s3 == 1)
                $id = $id . "3"; // vyhledavam i v id nemovitosti
            
            $min = intval($obj->min);
            $max = intval($obj->max);

            $id = intval($id);

            if($min > 0) 
                $id = $id . "-" . intval($obj->min);
            else
               $id = $id . "-" . 0; 

            if($max > 0)
                $id = $id . "-" . intval($obj->max);
            else
                $id = $id . "-" . 0;
            
            $id = $id . "-" . intval($obj->t1) . "-" . intval($obj->t2) . "-" . intval($obj->t3) . "-" . intval($obj->t4);

            $this->redirect('Search:rozsireneVyhledavani', $id, $obj->search);
        };
        return $form;
    }

    
}    
    