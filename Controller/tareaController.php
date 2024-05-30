<?php
require_once(__DIR__ . '/../Model/tarea.php');


class TareaController
{

    private $model;


    public function __construct()
    {
        $this->model = new Tarea();
    }


    public function list()
    {      
        try {
            $data = $this->model->getAll();
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        } 
    }

    public function listId(){
        try {
            $id = $_GET["id"];
            $data = $this->model->getById($id);
            header("Location: view/tareas.php?p1={$data['idTarea']}&p2={$data['descripcion']}&p3={$data['fecha_inicio']}&p4={$data['fecha_fin']}&p5={$data['idActividad']}&p6{$data['estado']}&p7={$data['presupuesto']}");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public function info($id){
        try {
            $data = $this->model->getById($id);
            return $data;
        }  catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public function insert() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "descripcion" => $_POST['descripcion'],
                    "fecha_inicio" => $_POST['fecha_inicio'],
                    "fecha_fin" => $_POST['fecha_fin'],
                    "idActividad" => $_POST['idActividad'], 
                    "estado" => $_POST['estado'],
                    "presupuesto" => $_POST['presupuesto']
                ];
                $this->model->store($data);
                header("Location: view/tareas.php");
                exit();
            } else {
                echo "ERROR: Método de solicitud no permitido.";
            }
        } catch (PDOException $e) {
            echo "Código de error: " . $e->getCode() . "<br>";
            echo "Mensaje de error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    public function update()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_GET["id"];
                $data = [
                    "descripcion" => $_POST['descripcion'],
                    "fecha_inicio" => $_POST['fecha_inicio'],
                    "fecha_fin" => $_POST['fecha_fin'],
                    "idActividad" => $_POST['idActividad'],
                    "estado" => $_POST['estado'],
                    "presupuesto" => $_POST['presupuesto']
                ];
                $this->model->setUpdate($id, $data);
                header("Location: view/tareas.php");
                exit();
            } else {
                echo "ERROR";
            }
            
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
         }
    }

    public function delete(){
        try {
            $id = $_GET["id"];
            $this->model->remove($id);
            header("Location: view/tareas.php");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
         }
    }
    
    public function getEstados(){
        try {
            $estado = $_GET["estado"];
            $data = $this->model->getEstado($estado);
            return $data;
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
         }
    }
}