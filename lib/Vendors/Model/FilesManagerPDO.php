<?php
namespace Model;

use \Entity\File;
use \Model\FilesManager;
use Entity\UserEntity;

class FilesManagerPDO extends FilesManager
{
  public function add(File $file)
  {
    $q = $this->dao->prepare('INSERT INTO files SET name = :name, 
    												size = :size, 
    												auteur = :auteur,
    												idAuteur = :idAuteur,
    												type = :type, 
    												dateAjout = NOW(), 
    												sujet = :sujet, 
    												descriptif = :descriptif,
    												locationDir = :locationDir,
    												idDirectory = :idDirectory');

    $q->bindValue(':name', $file->name());
    $q->bindValue(':size', $file->size(), \PDO::PARAM_INT);    
    $q->bindValue(':auteur', $file->auteur());
    $q->bindValue(':idAuteur', $file->idAuteur(), \PDO::PARAM_INT);
    $q->bindValue(':type', $file->type());
    $q->bindValue(':sujet', $file->sujet());
    $q->bindValue(':descriptif', $file->descriptif());
    $q->bindValue(':locationDir', $file->locationDir());
    $q->bindValue(':idDirectory', $file->idDirectory(), \PDO::PARAM_INT);
    
    $q->execute();
    
    //$comment->setId($this->dao->lastInsertId());
  }
  
  public function getList($locationDir)
  {
  	$q = $this->dao->prepare('SELECT * FROM files WHERE locationDir = :locationDir ORDER BY dateAjout DESC');
  	$q->bindValue(':locationDir', $locationDir);
  	$q->execute(); 	
  	
  	$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\File');
  	
  	$files = $q->fetchAll();
  	
  	foreach ($files as $file)
  	{
  		$file->setDateAjout(new \DateTime($file->dateAjout()));
  	}
  	
  	return $files;
  }
  
  public function count(UserEntity $user)
  {
  		$q =  $this->dao->prepare('SELECT COUNT(*) FROM files WHERE idAuteur = :idAuteur');
  		$q->bindValue(':idAuteur', $user->id(), \PDO::PARAM_INT);
  		$q->execute();
  		$result = $q->fetchColumn();
  		return $result;
  }
  
  public function getFile($id)
  {
  	$q = $this->dao->prepare('SELECT * FROM files WHERE id = :id');
  	$q->bindValue(':id', $id, \PDO::PARAM_INT);
  	$q->execute();
  	 
  	$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\File');
  	 
  	$file = $q->fetch();

	//$file->setDateAjout(new \DateTime($file->dateAjout()));
  	 
  	return $file;
  }
  
  public function deleteFile($id)
  {
  	$q = $this->dao->prepare('DELETE FROM files WHERE id = :id');
  	$q->bindValue(':id', $id, \PDO::PARAM_INT);
  	$q->execute();
  }
  
}