<?php

namespace PhpModerno\Query;

use PHPUnit_Framework_TestCase;

class QueryTest extends PHPUnit_Framework_TestCase
{
	public function testSimpleSelect()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->select()
			->getSql();

		$this->assertEquals('SELECT * FROM users;', $sql);
	}

	public function testSimpleUpdate()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->update(['name'=>'Erik'])
			->getSql();

		$this->assertEquals('UPDATE users SET `name`=:name;', $sql);
	}

	public function testSimpleInsert()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->insert(['name'=>'erik', 'lastname'=>'figueiredo'])
			->getSql();

		$this->assertEquals('INSERT INTO users (`name`, `lastname`) VALUES (:name, :lastname);', $sql);
	}

	public function testSimpleDelete()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->delete()
			->getSql();

		$this->assertEquals('DELETE FROM users;', $sql);
	}

	public function testDeleteWithWhere()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->where(['id'=>'1'])
			->delete()
			->getSql();

		$this->assertEquals('DELETE FROM users WHERE `id`=:id;', $sql);
	}

	public function testUpdateWithWhere()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->where(['id'=>1])
			->update(['name'=>'Erik'])
			->getSql();

		$this->assertEquals('UPDATE users SET `name`=:name WHERE `id`=:id;', $sql);
	}

	public function testSelectWithWhere()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->where(['id'=>'1'])
			->select()
			->getSql();

		$this->assertEquals('SELECT * FROM users WHERE `id`=:id;', $sql);
	}

	public function testBindValues()
	{
		$query = new Drivers\Mysql;
		$sql = $query->table('users')
			->where(['id'=>'1'])
			->select()
			->getSql();

		$this->assertEquals(['id'=>1], $query->getBind());
	}
}
