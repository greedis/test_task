<?php

namespace DolgoyAudiopunk\Framework\Models;

use DolgoyAudiopunk\Framework\DB;

abstract class Model
{
    /**
     * @var DB
     */
    protected DB $pdo;
    /**
     * @var string
     */
    protected string $table;
    /**
     * @var boolean
     */
    protected bool $created_at = false;

    /**
     *
     */
    public function __construct()
    {
        $this->pdo = DB::instance();
    }

    /**
     * @param array<string|int> $search
     * @param string            $operator
     * @param string            $columns
     * @param string            $join
     * @return array<array>
     */
    public function where(array $search, string $operator, string $columns, string $join): array
    {
        $search = convArray($search, $operator);
        $search = implode(' AND ', $search);

        $sql = "SELECT $columns FROM $this->table $join WHERE $search";
        return $this->pdo->query($sql);
    }

    /**
     * @param array<string> $array
     * @return array<array>
     */
    public function insert(array $array): array
    {
        $array = array_map(function ($val) {
            return htmlspecialchars($val);
        }, $array);

        if ($this->created_at) {
            $arr = [
                'created_at' => date('Y-m-d h:m:s'),
            ];
            $array = array_merge($array, $arr);
        }

        $keysString = implode(',', array_keys($array));
        $valuesString = implode('\',\'', array_values($array));

        $sql = "INSERT INTO $this->table ($keysString) VALUES ('$valuesString')";
        return $this->pdo->query($sql);
    }

    /**
     * @param array<string|int> $params
     * @param array<int>    $search
     * @return array
     */
    public function update(array $params, array $search): array
    {
        $params = array_map(function ($val) {
            return htmlspecialchars($val);
        }, $params);

        $params = convArray($params);
        $search = convArray($search);

        $valuesString = implode(', ', $params);
        $searchValuesString = implode(', ', $search);

        if ($this->updated_at) {
            $updated_at = date('Y-m-d');
            $sql = "UPDATE $this->table SET $valuesString, updated_at = '$updated_at' WHERE $searchValuesString";
        } else {
            $sql = "UPDATE $this->table SET $valuesString WHERE $searchValuesString";
        }
        return $this->pdo->query($sql);
    }

    /**
     * @param array $search
     * @return array
     */
    public function delete(array $search): array
    {
        $search = convArray($search);
        $searchValuesString = implode(', ', $search);

        $sql = "DELETE FROM $this->table WHERE $searchValuesString";
        return $this->pdo->query($sql);
    }

    /**
     * @param string $column
     * @param string $order
     * @param array<int|string> $search
     * @param string $columns
     * @param string $join
     * @param string $operator
     * @param string $limit
     * @return array<array>
     */
    public function order(string $column, string $order, array $search, string $columns = '*', string $join = '', string $operator = '=', string $limit = ''): array
    {
        $search = convArray($search, $operator);
        $search = implode(' AND ', $search);
        $sql = "SELECT $columns FROM $this->table  $join WHERE $search ORDER BY $column $order $limit";
        return $this->pdo->query($sql);
    }
}
