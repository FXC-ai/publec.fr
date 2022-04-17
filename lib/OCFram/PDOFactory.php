<?php
namespace OCFram;

class PDOFactory
{
	public static function getMysqlConnexion()
	{
		$db = new \PDO('mysql:host=db654270263.db.1and1.com;dbname=db654270263', 'dbo654270263', '92a22f2.A');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		
		/*
		$db = new \PDO('mysql:host=localhost;dbname=news', 'root', '');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		*/
		return $db;
	}
}