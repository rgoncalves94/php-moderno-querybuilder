<?php

namespace PhpModerno\Query;

use PhpModerno\Query\Drivers\MySql;

class QueryBuilder
{
	private static $db;
	private static $is_connected;
	private static $sql;

	public static function getDb(Array $config)
	{
		if (is_null(self::$db))
			self::$db = new Db;

		self::$db->config($config);

		return self::$db;
	}

	public static function query($table)
	{
		self::$sql = new MySql();
		self::$sql->table($table);
		return self::$sql;
	}

	public static function getOne()
	{
		self::conn();
		return self::$db->getOne(self::$sql);
	}

	public static function getAll()
	{
		self::conn();
		return self::$db->getOne(self::$sql);
	}

	protected static function conn()
	{
		if (!self::$is_connected) {
			self::$db->conn();
			self::$is_connected = true;
		}
	}

}
