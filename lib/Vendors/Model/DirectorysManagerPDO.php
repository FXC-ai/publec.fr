<?php
namespace Model;

use Entity\Directory;
use Entity\UserEntity;

class DirectorysManagerPDO extends DirectorysManager
{
	public function add(Directory $directory) {

		$q = $this->dao->prepare('INSERT INTO directorys SET name = :name,
															auteur = :auteur,
    														idAuteur = :idAuteur,
															dirAuteur = :dirAuteur,
															dateCreation = NOW()');
		
		$q->bindValue(':name', $directory->name());
		$q->bindValue(':auteur', $directory->auteur());
		$q->bindValue(':idAuteur', (int)$directory->idAuteur(), \PDO::PARAM_INT);
		$q->bindValue(':dirAuteur', $directory->dirAuteur());
		
		$q->execute();
	}
	
	public function getList(UserEntity $user) {

		$q = $this->dao->prepare('SELECT * FROM directorys WHERE idAuteur = :idAuteur ORDER BY dateCreation');
		$q->bindValue(':idAuteur', $user->id(), \PDO::PARAM_INT);
		$q->execute();
		
		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Directory');
		
		$directorys = $q->fetchAll();
		
		foreach ($directorys as $directory)
		{
			$directory->setDateCreation(new \DateTime($directory->dateCreation()));
		}
		
		return $directorys;
	}
	
	public function directoryExists(Directory $directory)
	{
		$q = $this->dao->prepare('SELECT COUNT(*) as directoryExist FROM directorys WHERE name = :name AND idAuteur = :idAuteur');
		
		$q->bindValue(':name', $directory->name());
		$q->bindValue(':idAuteur', $directory->idAuteur());
		
		$q->execute();
		
		$resultat = $q->fetch();
		
		if ($resultat['directoryExist'] > 0) {return TRUE;}else{return FALSE;}
	}
	
	public function getDirectory($id)
	{
		$q = $this->dao->prepare('SELECT * FROM directorys WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();
		
		$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Directory');
		
		$directory = $q->fetch();
		
		//$directory[0]->setDateCreation(new \DateTime($directory->dateCreation()));
		
		
		return $directory;
	}
	
	public function directoryDelete($directoryID)
	{
		$q = $this->dao->prepare('DELETE FROM directorys WHERE id = :id');
		$q->bindValue(':id', $directoryID, \PDO::PARAM_INT);
		$q->execute();		
	}
	
	public function updateDirectory(Directory $directory)
	{
		$q = $this->dao->prepare('UPDATE directorys SET name = :name, auteur = :auteur, idAuteur = :idAuteur, dirAuteur = :dirAuteur, nbFiles = :nbFiles WHERE id = :id');
		
		$q->bindValue(':name', $directory->name());
		$q->bindValue(':auteur', $directory->auteur());
		$q->bindValue(':idAuteur', $directory->idAuteur(), \PDO::PARAM_INT);		
		$q->bindValue(':dirAuteur', $directory->dirAuteur());
		$q->bindValue(':nbFiles', $directory->nbFiles(), \PDO::PARAM_INT);
		$q->bindValue(':id', $directory->id(), \PDO::PARAM_INT);
		
		$q->execute();
	}
}

