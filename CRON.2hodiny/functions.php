<?php

require 'asystem.pps-eu.cz/vendor/autoload.php';

use Nette\Database\Connection,
    Nette\Database\Context;

        function analyzuj_drazbu($prihozy, $nemovitost) {

            $cena = $nemovitost->pocatecni_cena; 
            $id = null;

            if($prihozy != null) // pokud jsou drazeny vyhodnoti celkovou cenu a zajemce s nejvyssi nabidkou
            {
                foreach ($prihozy as $prihoz) 
                {
                    $cena += $prihoz->vkladana_castka;
                    $id = $prihoz->id_uzivatel;
                }
            }
            return array(   
                            'cena' => $cena, 
                            'id' => $id, 
                        );   
        }