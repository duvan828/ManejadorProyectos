<?php
require_once(__DIR__ . '/../Model/recurso.php');


class RecursoController
{

    private $model;


    public function __construct()
    {
        $this->model = new Recurso();
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
            header("Location: view/recursos.php?p1={$data['idRecurso']}&p2={$data['descripcion']}&p3={$data['valor']}&p4={$data['unidadmedida']}");
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
                    "valor" => $_POST['valor'], 
                    "unidadmedida" => $_POST['unidadmedida']
                ];
                $this->model->store($data);
                header("Location: view/recursos.php");
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
                    "valor" => $_POST['valor'], 
                    "lugar" => $_POST['unidadmedida']
                ];
                $this->model->setUpdate($id, $data);
                header("Location: view/recursos.php");
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
            header("Location: view/recursos.php");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
         }
    }
    
}