<?php

namespace App\Entity;

class Compte
{

	private $_id;

	private $_adresseMail;

	private	$_pseudo;

	private	$_password;


	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

// Getter

	public function id()
	{
		return $this->_id;
	}

	public function adresseMail()
	{
		return $this->_adresseMail;
	}

	public function pseudo()
	{
		return $this->_pseudo;
	}

	public function password()
	{
		return $this->_password;
	}



// Setter

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function setAdresseMail($adresseMail)
	{
		$this->_adresseMail = $adresseMail;
	}

	public function setPseudo($pseudo)
	{
		$this->_pseudo = $pseudo;
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}


	public function verifyPassword($password)
	{
		$this->password == password_verify($password);
	}


}
