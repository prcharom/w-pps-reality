<?php

namespace App\Model;

use Nette;


class Database extends Nette\Object
{
	/** @var Nette\Database\Context */
	private $database;
  
        
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

        
    /** @return Nette\Database\Table\Selection */
    public function findAll($what)
    {
        return $this->database->table($what);
    }
  
    /** @return Nette\Database\Table\Selection */
    public function findByUser($what, $user)
    {
  	 return $this->database->table($what)->where('id_user', $user);
    }

    /** @return Nette\Database\Table\ActiveRow */
    public function findById($what, $id)
    {
	   return $this->findAll($what)->get($id);
    } 

    /** @return Nette\Database\Table\ActiveRow */
    public function insert($what, $values)
    {
	   return $this->findAll($what)->insert($values);
    }

    /** @return array */
    public function arrayIdToColumn($what, $column)
    {
        foreach ($this->findAll($what)->order('id DESC') as $value) 
        {
            $values[$value->id] = $value->$column;
        }
        
        if(isset($values))
            return $values;
        else
          return NULL;
    }

}
