<?php
require_once(__DIR__ . '/../Model/proyecto.php');


class ProyectoController
{

    private $model;


    public function __construct()
    {
        $this->model = new Proyecto();
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

    public function info($id){
        try {
            $data = $this->model->getById($id);
            return $data;
        }  catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public function listId(){
        try {
            $id = $_GET["id"];
            $data = $this->model->getById($id);
            header("Location: view/proyectos.php?p1={$data['idProyecto']}&p2={$data['descripcion']}&p3={$data['fecha_inicio']}&p4={$data['fecha_entrega']}&p5={$data['valor']}&p6={$data['lugar']}&p7={$data['responsable']}&p8={$data['estado']}");
        } catch (PDOException $e) {
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
                    "fecha_entrega" => $_POST['fecha_entrega'],
                    "valor" => $_POST['valor'], 
                    "lugar" => $_POST['lugar'],
                    "responsable" => $_POST['responsable'],
                    "estado" => $_POST['estado'],
                ];
                $this->model->store($data);
                header("Location: view/proyectos.php");
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
                    "fecha_entrega" => $_POST['fecha_entrega'],
                    "valor" => $_POST['valor'], 
                    "lugar" => $_POST['lugar'],
                    "responsable" => $_POST['responsable'],
                    "estado" => $_POST['estado'],
                ];
                $this->model->setUpdate($id, $data);
                header("Location: view/proyectos.php");
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
            header("Location: view/proyectos.php");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
         }
    }

    public function getEstadosProyectos(){
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