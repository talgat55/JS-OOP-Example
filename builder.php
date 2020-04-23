<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 23.04.20
 * Time: 21:41
 */

interface SQLQueryBuilder
{
    public function select($table, $fields);

    public function where($field, $value, $operator);

    public function limit($start, $offset);

    public function getSQL();

}


class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected $query;

    protected function reset()
    {
        $this->query = new stdClass();
    }

    public function select($table, $fields)
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(', ', $fields) . " FROM " . $table;
        $this->query->type = 'select';

        return $this;

    }

    public function where($field, $value, $operator)
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception('need use one is operations SELECT, UPDATE, DELETE');
        }

        $this->query->where[] = "$field $operator '$value'";
        return $this;
    }

    public function limit($start, $offset)
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new Exception('limit cal use only in SELECT');
        }

        $this->query->limit = " LIMIT " . $start . ", " . $offset;
        return $this;
    }

    public function getSQL()
    {
        $query = $this->query;
        $sql = $query->base;

        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }

        if (isset($query->limit)) {
            $sql .= $query->limit;

        }
        $sql .= ";";

        return $sql;


    }
}


function clientCode($queryBuilder)
{
    $query = $queryBuilder
        ->select('users', ['name', 'email', 'password'])
        ->where('age', 18, ">")
        ->where('age', 30, "<")
        ->getSQL();

    echo $query;
}

echo "Testing MySQL query builder:\n";
clientCode(new MysqlQueryBuilder);