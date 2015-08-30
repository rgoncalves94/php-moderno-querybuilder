<?php

namespace PhpModerno\Query;

use PHPUnit_Framework_TestCase;

class QueryBuilderTest extends PHPUnit_Framework_TestCase
{
	public function testQueryBuilder()
	{

		QueryBuilder::getDb([
			'dsn'=>'mysql:host=localhost;dbname=curso_phpmoderno',
			'user'=>'root',
			'password'=>'123',
			'config'=>[]
		]);

		QueryBuilder::query('users')->select();

		var_dump(QueryBuilder::getOne());
	}
}