<?php
namespace Model;

use Entity\UserEntity;

class UsersManagerPDO extends UsersManager
{
		
	public function addUser(UserEntity $user) /*Protected !*/
	{
		$lastId = $this->dao->lastInsertId();
		$q = $this->dao->prepare('INSERT INTO users SET nom = :nom, 
														prenom = :prenom, 
														password = :password, 
														email = :email, 
														dirAuteur = :dirAuteur, 
														dateInscription = NOW(), 
														cle = :cle');
	
		$q->bindValue(':nom', $user->nom());
		$q->bindValue(':prenom', $user->prenom());
		$q->bindValue(':password', sha1($user->password()));
		$q->bindValue(':email', $user->email());
		$q->bindValue(':dirAuteur', $user->dirAuteur());		
		$q->bindValue(':cle', $user->cle());
	
		$q->execute();
	
		$user->setId($this->dao->lastInsertId());
	}
	
	public function userExists($email)
	{
		$q = $this->dao->prepare('SELECT COUNT(*) as userExist FROM users WHERE email = :email');
		
		$q->bindValue(':email', $email);
		
		$q->execute();
		
		$resultat = $q->fetch();
		
		if ($resultat['userExist'] > 0) {
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	
	public function confirmRegistration($cle)
	{
		$q = $this->dao->prepare("UPDATE users SET activation = :activation WHERE cle = :cle");
		
		$q->bindValue(':activation', 1);
		$q->bindValue(':cle', $cle);
				
		$q->execute();
	}
	
	public function getUser($email)
	{
		$requete = $this->dao->prepare('SELECT * FROM users WHERE email = :email');
		$requete->bindValue(':email', $email);
		$requete->execute();
		
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\UserEntity');
		
		$user = $requete->fetch();
		$user->setDateInscription(new \DateTime($user->dateInscription()));
		
		return $user;
	}
	
	public function getUniq($key, $value)
	{

		$requete = $this->dao->prepare('SELECT * FROM users WHERE '.$key.' = :'.$key);
		$requete->bindValue(':'.$key, $value);
		$requete->execute();
		
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\UserEntity');
		
		$user = $requete->fetch();
		
		
		//$user->setDateInscription(new \DateTime($user->dateInscription()));
		
		return $user;
	}
	
	public function updateUser(UserEntity $user) {
		$q = $this->dao->prepare('UPDATE users SET nom = :nom, prenom = :prenom, password = :password, dirAuteur = :dirAuteur, email = :email WHERE id = :id');
		
		$q->bindValue(':nom', $user->nom());
		$q->bindValue(':prenom', $user->prenom());
		$q->bindValue(':password', sha1($user->password()));
		$q->bindValue(':email', $user->email());		
		$q->bindValue(':dirAuteur', $user->dirAuteur());
		$q->bindValue(':cle', $user->cle());
	
		$q->execute();
	}
}