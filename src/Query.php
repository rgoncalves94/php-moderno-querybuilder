<?php

namespace PhpModerno\Query;

abstract class Query
{
    protected $table;
    protected $sql;
    protected $parameters;
    protected $bind = [];

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select()
    {
        $this->sql = sprintf($this->select_str, $this->table);
        return $this;
    }

    public function delete()
    {
        $this->sql = sprintf($this->delete_str, $this->table);
        return $this;
    }

    public function update(Array $data)
    {
        $str = $this->setParams($data);

        $this->sql = sprintf($this->update_str, $this->table, $str);
        return $this;
    }

    public function insert(Array $data)
    {
        $this->bind = array_merge($this->bind, $data);
        $fields = implode('`, `', array_keys($data));
        $values = implode(', :', array_keys($data));
        $this->sql = sprintf($this->insert_str, $this->table, '`'.$fields.'`', ':'.$values);
        return $this;
    }

    public function where(Array $data)
    {
        $str = $this->setParams($data);

        $this->parameters = ' WHERE ';
        $this->parameters .= $str;
        return $this;
    }

    public function getSql()
    {
        return $this->sql.$this->parameters.';';
    }

    public function getBind()
    {
        return $this->bind;
    }

    protected function setParams($data)
    {
        $str = '';
        foreach ($data as $k => $v)
            $str = '`'.$k.'`=:'.$k;

        $this->bind = array_merge($this->bind, $data);
        return $str;
    }
}
