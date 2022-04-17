<?php
namespace Model;

use \OCFram\Manager;

abstract class UsersManager extends Manager
{
	abstract public function addUser(\Entity\UserEntity $user);
	
	abstract public function getUser($email);
	
	abstract public function getUniq($key, $value);
	
	abstract public function userExists($email);
	
}