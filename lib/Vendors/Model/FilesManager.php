<?php
namespace Model;

use \OCFram\Manager;
use \Entity\File;
use Entity\UserEntity;


abstract class FilesManager extends Manager
{
	
	abstract public function add(File $file);
	
	abstract public function getList($locationDir);
	
	abstract public function count(UserEntity $user);
	
	abstract public function deleteFile($id);

}