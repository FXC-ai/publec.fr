<?php
namespace Entity;

use \OCFram\Entity;

class Directory extends Entity
{
	protected $id, $name, $idAuteur, $auteur, $dirAuteur, $nbFiles, $dateCreation;
	
	const ID_INVALID = 1;
	const NAME_INVALID = 2;
	const IDAUTEUR_INVALID = 3;
	const AUTEUR_INVALID = 4;
	const DIRAUTEUR_INVALID = 5;
	const NBFILES_INVALID = 6;
	const DATECREATION_INVALID = 7;
	
	//SETTERS
	
	public function setName($name)
	{
		if (!is_string($name) || empty($name))
		{
			$this->erreurs[] = self::NAME_INVALID;
		}
		
		$this->name = $name;
	}
	
	public function setIdAuteur($idAuteur) {
		
		if (!is_int($idAuteur) || empty($idAuteur))
		{
			$this->erreurs[] = self::IDAUTEUR_INVALID;
		}
		
		$this->idAuteur = $idAuteur;
	}

	public function setAuteur($auteur)
	{
		if (!is_string($auteur) || empty($auteur))
		{
			$this->erreurs[] = self::AUTEUR_INVALID;
		}
	
		$this->auteur = $auteur;
	}
	
	public function setDirAuteur($dirAuteur)
	{
		if (!is_string($dirAuteur) || empty($dirAuteur))
		{
			$this->erreurs[] = self::DIRAUTEUR_INVALID;
		}
	
		$this->dirAuteur = $dirAuteur;
	}
	
	public function setNbFiles($nbFiles)
	{
		if (!is_int($nbFiles) || empty($nbFiles))
		{
			$this->erreurs[] = self::NBFILES_INVALID;
		}
		
		$this->nbFiles = $nbFiles;	
	}

	public function setDateCreation(\DateTime $dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}
	
	//GETTERS
	
	public function id() {
		return $this->id;
	}
	
	public function name()
	{
		return $this->name;
	}
	
	public function idAuteur() {
		return $this->idAuteur;
	}
	
	public function auteur(){
		return $this->auteur;
	}
	
	public function dirAuteur() {
		return $this->dirAuteur;
	}
	
	public function nbFiles() {
		return $this->nbFiles;
	}
	
	public function dateCreation(){
		return $this->dateCreation;
	}
}