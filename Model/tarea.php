<?php

require_once(__DIR__ . '/../Model/DAO.php');

class Tarea extends DAO
{


    protected $table = "tareas";
    protected $ident = "idTarea";


    public function getAll()
    {
        $result = $this->selectAll();
        return $result;
    }

    public function consult($sql)
    {
        $result = $this->query($sql);
        return $result;
    }

    
    public function getById($id) 
    {
        $result = $this->selectId($id);
        return $result;
    }


    public function insert($data) {
        $this->store($data);
    }


    public function setUpdate($id, $data) {
        $this->update($id, $data);
    }


    public function remove($id) {
        $this->delete($id);
    }

    public function getEstado($param)
    {
        $result = $this->query("SELECT * FROM $this->table WHERE estado = '". $param."'");
        return $result;
    }

    
    
}