<?php

namespace App\Model;

use Nette,
	Nette\Security,
	Nette\Utils\Strings;
  

class Users extends \Nette\Object 
{  
  /** @var Nette\Database\Context */
  private $database;
  
  private $table = "uzivatel";
  private $user_salt = "$2a$07$";

  public function __construct(Nette\Database\Context $database) 
  {
    $this->database = $database;    
  }

  // metoda vraci tabulku uzivatelu
  public function findTable() 
  {
    return $this->database->table($this->table);
  }

  // metoda registruje uzivatele
  public function register($data) 
  {        
    $data["heslo"] = crypt($data["heslo"], $this->user_salt . Strings::random(23));
    return $this->findTable()->insert($data);
  }
  
   // metoda registruje uzivatele
  public function update($id, $data) 
  {        
    $data["heslo"] = crypt($data["heslo"], $this->user_salt . Strings::random(23));
    return $this->findTable()->get($id)->update($data);
  }
    
}