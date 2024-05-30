<?php

require_once(__DIR__ . '/../Connection/db.php');

class DAO {

    private $connection;

    public function __construct()
    {
        $this->connection = DB::getInstance();
    }

    
    public function query($sql)
    {        
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectId($id)
    {
        $sql = "SELECT * FROM $this->table WHERE ".$this->ident." = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        $res = $stm->fetch();
        if ($res == false) {
            return null;
        }
        return $res;
    }

    public function store($data) {
        $columnas = implode(', ', array_keys($data));
        $datos = array_values($data);
        $places = [];
        $i = 0;
        foreach ($datos as $value) { 
            if(is_numeric($value))
                $places[$i] = "$value";
            else {
                $places[$i] = "'$value'";
            }
            $i++;
        }
        $placeholders = implode(", ", $places);

        $sql = "INSERT INTO $this->table ($columnas) VALUES ($placeholders)";

        // Ejecuta la consulta
        $stm = $this->connection->prepare($sql);
        $stm->execute();
    }
    
    

    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE {$this->ident} = ".$id;
        $stm = $this->connection->prepare($sql);
        $stm->execute();
    }
    
    public function update($id, $data) {
        $sets = [];
        foreach ($data as $column => $value) {
            if(is_numeric($value))
                $sets[] = "$column = $value";
            else {
                $sets[] = "$column = '$value'";
            }
            
        }
        $setClause = implode(', ', $sets);
    
        $sql = "UPDATE $this->table SET $setClause WHERE $this->ident = ".$id;
        $stm = $this->connection->prepare($sql);
        $stm->execute();
    }
    
}