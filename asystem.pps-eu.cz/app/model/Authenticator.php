<?php

namespace App\Model;

use Nette,
	Nette\Security,
	Nette\Utils\Strings;


/**
 * Autentikator uživatelů
 */
class Authenticator extends Nette\Object implements Security\IAuthenticator
{
	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * Provadi autentizaci
	 * @param  array
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($nick, $heslo) = $credentials;
		$row = $this->database->table('uzivatel')->where('nick', $nick)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('Zadejte prosím správný nick.', self::IDENTITY_NOT_FOUND);
		}

		if ($row->heslo !== $this->generateHash($heslo, $row->heslo)) {
			throw new Security\AuthenticationException('Zadejte prosím správné heslo.', self::INVALID_CREDENTIAL);
		}

		$arr = $row->toArray();
		unset($arr['heslo']);
        unset($arr['id_typ_uzivatele']);
		return new Security\Identity($row->id, $row->typ_uzivatele->pojmenovani, $arr);
	}


	/**
	 * Generuje hash hesla i se solicim retezcem
	 * @return string
	 */
	public function generateHash($heslo, $salt = NULL)
	{
		if ($heslo === Strings::upper($heslo)) { // v pripade zapleho capslocku
			$heslo = Strings::lower($heslo);
		}
		return crypt($heslo, $salt ?: '$2a$07$' . Strings::random(23));
	}

}
