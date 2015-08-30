<?php

namespace PhpModerno\Query\Drivers;

use PhpModerno\Query\Query;

class MySql extends Query
{
    protected $select_str = 'SELECT * FROM %s';
    protected $delete_str = 'DELETE FROM %s';
    protected $update_str = 'UPDATE %s SET %s';
    protected $insert_str = 'INSERT INTO %s (%s) VALUES (%s)';
}
