<?php

namespace PhpModerno\Query;

use PHPUnit_Framework_TestCase;
use PhpModerno\Query\Drivers\MySql;

class DbTest extends PHPUnit_Framework_TestCase
{
	public function testSelectWithoutParams()
	{
		$query = new MySql;
		$query->table('users')
			->select();

		$db = new Db();
		$db->config([
			'dsn'=>'mysql:host=localhost;dbname=curso_phpmoderno',
			'user'=>'root',
			'password'=>'123',
			'config'=>[]
		]);

		$db->conn();

		//var_dump($db->getOne($query));
	}

	public function testUpdate()
	{
		$query = new MySql;
		$query->table('users')
			->where(['id'=>1])
			->update(['name'=>'Erik']);

		

		$db = new Db;
		$db->config([
			'dsn'=>'mysql:host=localhost;dbname=curso_phpmoderno',
			'user'=>'root',
			'password'=>'123',
			'config'=>[]
		]);

		$db->conn();

		$db->save($query);

		$query->table('users')
			->select();

	}

	public function testDelete()
	{
		$query = new MySql;
		$query->table('users')
			->where(['id'=>1])
			->delete();

		$db = new Db;
		$db->config([
			'dsn'=>'mysql:host=localhost;dbname=curso_phpmoderno',
			'user'=>'root',
			'password'=>'123',
			'config'=>[]
		]);

		$db->conn();

		$db->delete($query);
	}
}