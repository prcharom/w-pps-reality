<?php

namespace App\Model;

use Nette,
    Nette\Security;

/**
 * Nastaveni prav uživatelů
 */
class Authorizator extends Nette\Object implements Nette\Security\IAuthorizator
{

    function isAllowed($role, $resource, $privilege)
    {
        switch ($role) {
            case 'SuperAdmin': // omezeni pro superAdmina
                if ($resource == 'drazba' && $privilege == 'prihodit') 
                    return false; // nesmi prihazovat
                else 
                    return true;
                
            case 'Zájemce': // omezeni pro zajemce
                switch ($resource) {                    
                    case 'adminMenu':
                        return false; // nema pristup k adminMenu
                    
                    case 'zajemce':  // zakazana administrace uctu zajemcu
                        if ($privilege == 'pridat')
                            return false;
                        elseif ($privilege == 'upravit')
                            return false;
                        elseif ($privilege == 'smazat')
                            return false;
                        elseif ($privilege == 'zobrazit')
                            return false;
                        else
                            return true;
                        
                    case 'nemovitost': // zakazana administrace nemovitosti k drazbe
                        if ($privilege == 'pridat')
                            return false;
                        elseif ($privilege == 'upravit')
                            return false;
                        elseif ($privilege == 'smazat')
                            return false;
                        elseif ($privilege == 'pridatFoto')
                            return false;
                        elseif ($privilege == 'smazatFoto')
                            return false;
                        else
                            return true;

                    case 'drazba': // zakaz zobrazovat vypis a mazat prihozy ostatnich zajemcu
                        if ($privilege == 'vypisHistorie')
                            return false;
                        elseif ($privilege == 'smazatPrihoz')
                            return false;
                        else
                            return true;

                    case 'upravit': // zakaz uprav zakladnich informaci v systemu
                        if ($privilege == 'podminky')
                            return false;
                        elseif ($privilege == 'kontakt')
                            return false;
                        elseif ($privilege == 'domovska_stranka')
                            return false;
                        else
                            return true;

                    default:
                        return true;
                }
            
                default: // guest a nezname typy uzivatelu maji fce zakazany, krome zakladnich
                	if ($resource == 'zakladni')
                		return true;
                	else
                		return false;
        }
    }

}
