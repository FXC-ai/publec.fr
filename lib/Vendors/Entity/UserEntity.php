<?php
namespace Entity;

use OCFram\Entity;

class UserEntity extends Entity
{
	protected $nom, $prenom, $email, $dirAuteur, $password, $activation, $cle, $dateInscription;
	
	const NOM_INVALID = 1;
	const PRENOM_INVALID = 2;
	const EMAIL_INVALID = 3;
	const DIRAUTEUR_INVALID = 4;
	const PASSWORD_INVALID = 5;
	
	public function isValid()
	{
		return empty($this->erreurs);
	}

	public function setNom($nom)
	{
		if (!is_string($nom) || empty($nom))
		{
			$this->erreurs[] = self::NOM_INVALID;
		}
		
		$this->nom = $nom;
	}
	
	public function setPrenom($prenom)
	{
		if (!is_string($prenom) || empty($prenom))
		{
			$this->erreurs[] = self::PRENOM_INVALID;
		}
	
		$this->prenom = $prenom;
	}
	
	public function setEmail($email)
	{
		if (!is_string($email) || empty($email) || !preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
		{
			$this->erreurs[] = self::EMAIL_INVALID;
		}
	
		$this->email = $email;
	}
	
	public function setDirAuteur($dirAuteur)
	{
		if (!is_string($dirAuteur) || empty($dirAuteur))
		{
			$this->erreurs[] = self::DIRAUTEUR_IVALID;
		}
		
		$this->dirAuteur = $dirAuteur;
	}
	
	public function setPassword($password)
	{
		if (!is_string($password) || empty($password))
		{
			$this->erreurs[] = self::PASSWORD_INVALID;
		}
	
		$this->password = $password;
	}
	
	public function setActivation($activation)
	{
		$this->activation = $activation;
	}
	
	public function setCle($cle)
	{
		$this->cle = $cle;
	}
	
	public function setDateInscription(\DateTime $dateInscription)
	{
		$this->dateInscription = $dateInscription;
	}
	
	public function nom()
	{
		return $this->nom;
	}
	
	public function prenom()
	{
		return $this->prenom;
	}
	
	public function email()
	{
		return $this->email;
	}
	
	public function dirAuteur()
	{
		return $this->dirAuteur;
	}
	
	public function password()
	{
		return $this->password;
	}
	
	public function activation()
	{
		return $this->activation;
	}
	
	public function cle()
	{
		return $this->cle;
	}
	
	public function dateInscription()
	{
		return $this->dateInscription;
	}
}