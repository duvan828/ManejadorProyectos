<?php
require_once(__DIR__ . '/../Model/personasxtareas.php');


class PersonasxtareasController
{

    private $model;


    public function __construct()
    {
        $this->model = new PersonasxRecursos();
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
            header("Location: view/personas.php?p1={$data['idPersona']}&p2={$data['idTarea']}&p3={$data['duracion']}");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public function insert() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "idPersona" => $_POST['idPersona'],
                    "idTarea" => $_POST['idTarea'], 
                    "duracion" => $_POST['duracion']
                ];
                $this->model->store($data);
                header("Location: view/personas.php");
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
                    "idPersona" => $_POST['idPersona'],
                    "idTarea" => $_POST['idTarea'], 
                    "duracion" => $_POST['duracion']
                ];
                $this->model->setUpdate($id, $data);
                header("Location: view/personas.php");
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
            header("Location: view/personas.php");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
         }
    }
    
}