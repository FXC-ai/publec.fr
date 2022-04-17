<?php
namespace Entity;

use \OCFram\Entity;

class File extends Entity
{
	protected $auteur,
	$idAuteur,
	$name,
	$type,
	$size,
	$sujet,
	$descriptif,
	$dateAjout,
	$locationDir,
	$idDirectory;
	
	const AUTEUR_INVALID = 1;
	const NAME_INVALID = 2;
	const TYPE_IVALID = 3;
	const SIZE_INVALID = 4;
	const SUJET_INVALID = 5;
	const DESCRIPTIF_INVALID = 6;
	const IDAUTEUR_INVALID = 7;
	const LOCATIONDIR_INVALID = 8;
	const IDDIRECTORY_INVALID = 9;
	
	public function isValid()
	{
		return !(empty($this->auteur) || empty($this->name) || empty($this->type) || empty($this->size)  || empty($this->sujet)  || empty($this->descriptif));
	}
	
	
	// SETTERS //
	
	public function setAuteur($auteur)
	{
		if (!is_string($auteur) || empty($auteur))
		{
			$this->erreurs[] = self::AUTEUR_INVALID;
		}
	
		$this->auteur = $auteur;
	}
	
	public function setIdAuteur($idAuteur)
	{
		if (!is_int($idAuteur) || empty($idAuteur))
		{
			$this->erreurs[] = self::IDAUTEUR_INVALID;
		}
	
		$this->idAuteur = $idAuteur;
	}
	
	public function setName($name)
	{
		if (!is_string($name) || empty($name))
		{
			$this->erreurs[] = self::NAME_INVALIDE;
		}
	
		$this->name = $name;
	}
	
	public function setType($type)
	{
		if (!is_string($type) || empty($type))
		{
			$this->erreurs[] = self::TYPE_IVALID;
		}
	
		$this->type = $type;
	}

	public function setSize($size)
	{
		if (!is_int($size) || empty($size))
		{
			$this->erreurs[] = self::SIZE_INVALID;
		}
	
		$this->size = $size;
	}
	
	public function setSujet($sujet)
	{
		if (!is_string($sujet) || empty($sujet))
		{
			$this->erreurs[] = self::SUJET_INVALID;
		}
	
		$this->sujet = $sujet;
	}
	
	public function setDescriptif($descriptif)
	{
		if (!is_string($descriptif) || empty($descriptif))
		{
			$this->erreurs[] = self::DESCRIPTIF_INVALID;
		}
		
		$this->descriptif = $descriptif;	
	}
	
	
	public function setDateAjout(\DateTime $dateAjout)
	{
		$this->dateAjout = $dateAjout;
	}
	
	public function setLocationDir($locationDir)
	{
		if (!is_string($locationDir) || empty($locationDir))
		{
			$this->erreurs[] = self::LOCATIONDIR_INVALID;
		}
	
		$this->locationDir = $locationDir;
	}
	
	public function setIdDirectory($idDirectory)
	{
		if (!is_int($idDirectory) || empty($idDirectory))
		{
			$this->erreurs[] = self::IDDIRECTORY_INVALID;
		}
	
		$this->idDirectory = $idDirectory;
	}
	
	// GETTERS //
	
	public function auteur()
	{
		return $this->auteur;
	}
	
	public function idAuteur()
	{
		return $this->idAuteur;
	}
	
	public function name()
	{
		return $this->name;
	}
	
	
	public function type()
	{
		return $this->type;
	}
	
	public function size()
	{
		return $this->size;
	}
	
	public function sujet()
	{
		return $this->sujet;
	}
	
	public function descriptif()
	{
		return $this->descriptif;
	}
	
	public function dateAjout()
	{
		return $this->dateAjout;
	}
	
	public function locationDir()
	{
		return $this->locationDir;
	}
	
	public function idDirectory()
	{
		return $this->idDirectory;
	}
}