<?php

namespace App\Model;

use Nette;


class Drazba extends Nette\Object
{     
        /** @var Nette\Database\Context */
        private $database;
        
        private $table;
        private $cena;
        private $id;
        private $nick;
        private $jmeno;
        private $email;
        private $telefon;
        private $status;
        private $now;
            
        public function __construct(Nette\Database\Context $database)
	{
            $this->database = $database;
            $this->table = 'nemovitost';
            $this->cena = 0; 
            $this->id = null;
            $this->nick = null;
            $this->jmeno = null;
            $this->email = null;
            $this->telefon = null;
            $this->status = null;
            $this->now = date('Y-m-d H:i:s');
	}
    
    // vraci prislusnou nemovitost zadanou k drazbe 
    public function vyberNemovitost($id)
    {
        return $this->database->table($this->table)->get($id);
    }   
    
    // vraci aktualni cas
    public function vratCas()
    {
        return $this->now;
    }
    
    // vraci status drazby
    public function vratStatus() 
    {
        return $this->status;
    }

    // zahrne pocatecni nastaveni (pocatecni cena a status)
    public function zahrnPocatecniNastaveni($id)
    {
        $nemovitost = $this->vyberNemovitost($id);
        $this->cena += $nemovitost->pocatecni_cena; // zahrne startovni castku zadanou zadavatelem drazby
        if ($nemovitost->datum_zacatek > $this->now) // vyhodnoti status drazby
        {
            $this->status = 1; // drazba nemovitosti nezacala
        }
        elseif ($nemovitost->datum_konec < $this->now)
        {
            $this->status = 2;  // drazba nemovitosti skoncila        
        }
        else
        {
            $this->status = 3; // drazba nemovitosti probiha          
        }
    } 
   
    /**
     * Vyhodnocuje drazbu
     * @return array
     */
    public function vyhodnotDrazbu($id, $prihozy)
    {
        $this->zahrnPocatecniNastaveni($id);
        if($prihozy != null) // pokud jsou drazeny vyhodnoti celkovou cenu a zajemce s nejvyssi nabidkou
        {
            foreach ($prihozy as $prihoz) 
            {
                $this->cena += $prihoz->vkladana_castka;
                $this->id = $prihoz->uzivatel->id;
                $this->nick = $prihoz->uzivatel->nick;
                $this->jmeno = $prihoz->uzivatel->jmeno;
                $this->email = $prihoz->uzivatel->email;
                $this->telefon = $prihoz->uzivatel->telefon;
            }
        }
        return array(   
                        'cena' => $this->cena, 
                        'id' => $this->id, 
                        'nick' => $this->nick,
                        'jmeno' => $this->jmeno,
                        'email' => $this->email,
                        'telefon' => $this->telefon
                    );   
    }
    
} 