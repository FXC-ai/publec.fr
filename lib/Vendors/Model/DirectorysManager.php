<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Directory;
use Entity\UserEntity;



abstract class DirectorysManager extends Manager
{
	
	abstract public function add(Directory $directory);
	
	abstract public function getList(UserEntity $user);
	
	abstract public function directoryExists(Directory $directory);
	
	abstract public function directoryDelete($directoryID);
	
	abstract public function getDirectory($id);
	
	abstract public function updateDirectory(Directory $directory);

}