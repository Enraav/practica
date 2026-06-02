<?php

namespace src;

use src\services\Db;
use src\services\Request;

abstract class Entity
{
    public string $tableName = '';
    public int $id;
    protected Request $request;
    protected Db $db;

    public function __construct(Request $request, Db $db){
        $this->request = $request;
        $this->db = $db;
    }

    public function load($fields) {
        foreach($fields as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    public function insert(array $fields){
    $props = [];
    $values = [];
    foreach($fields as $key => $value){
        $props[] = '`' . $key . '`';
        $values[] = $value;
    }
    $propViaSemicolon = implode(', ', $props);
    $valueViaSemicolon = implode('", "', $values);
    $sql = 'INSERT INTO `' . $this->tableName . '` (' . $propViaSemicolon . ') VALUES ("' . $valueViaSemicolon . '")';
    return $this->db->querySql($sql);
}

    public function findAll() : ?array{
        $sql = 'SELECT * FROM ' . $this->tableName;
        $result = $this->db->querySql($sql);
        if($result === false) return null;
        return $result;
    }
    public function getId(int $id): ?array{
        $result = $this->db->querySql('SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $id);
        if(empty($result)) return null;
        return $result;
    }
    public function findByColumn(string $columnName, $value, int $limit = 0): ?array{
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $columnName . ' = "' . $value . '"';
        if($limit > 0) $sql .= ' LIMIT ' . $limit;
        $result = $this->db->querySql($sql);
        if(empty($result)) return null;
        return $result;
    }
    public function findOneByColumn(string $columnName, $value): ?array{
        $result = $this->findByColumn($columnName, $value, 1);
        if(empty($result)) return null;
        return $result[0];
    }
    public function update(array $fields): bool{
        $sets = [];
        foreach($fields as $key => $value){
            $sets[] = "$key='$value'";
        }
        $setSting = implode(', ', $sets);
        $sql = 'UPDATE ' . $this->tableName . ' SET ' . $setSting . ' WHERE id =' . $this->id;
        return $this->db->querySql($sql);
    }
    public function delete(): bool{
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . $this->id;
        return $this->db->querySql($sql);
    }
}