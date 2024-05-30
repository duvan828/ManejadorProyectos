<?php
require_once(__DIR__ . '/../Model/persona.php');


class PersonaController
{

    private $model;


    public function __construct()
    {
        $this->model = new Persona();
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

    public function login(){
        try {
            $id = $_POST['idPersona'];
            $contraseña = $_POST['contraseña'];
            $data = $this->model->getById($id);
            if ($data!=null) {
                if(password_verify($contraseña, $data['contraseña'])){
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['info'] = $data['nombre'].' '.$data['apellido'];
                    header('Location: view/personas.php');
                } else {
                    echo "Contraseña incorrecta";
                }
            } else {
                echo "Usuario no existe";
            }

         } 
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function leave(){
        $_SESSION["id"] = null;
        session_unset();
        session_destroy();
        header("Location: view/login.php");
        exit();
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
            header("Location: view/personas.php?p1={$data['idPersona']}&p2={$data['contraseña']}&p3={$data['nombre']}&p4={$data['apellido']}&p5={$data['direccion']}&p6={$data['telefono']}&p7={$data['sexo']}&p8={$data['fechanacimiento']}&p9={$data['profesion']}");
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public function insert() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    "idPersona" => $_POST["idPersona"],
                    "contraseña" => password_hash($_POST['contraseña'], PASSWORD_BCRYPT), // Asegúrate de hashear la contraseña
                    "nombre" => $_POST['nombre'],
                    "apellido" => $_POST['apellido'],
                    "direccion" => $_POST['direccion'],
                    "telefono" => $_POST['telefono'],
                    "sexo" => $_POST['sexo'],
                    "fechanacimiento" => $_POST['fechanacimiento'],
                    "profesion" => $_POST['profesion']
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
                    "nombre" => $_POST['nombre'],
                    "apellido" => $_POST['apellido'],
                    "direccion" => $_POST['direccion'],
                    "telefono" => $_POST['telefono'],
                    "sexo" => $_POST['sexo'],
                    "fechanacimiento" => $_POST['fechanacimiento'],
                    "profesion" => $_POST['profesion']
                ];
                if($_POST['contraseña']!=""){
                    $data = [...$data, "contraseña" => password_hash($_POST['contraseña'], PASSWORD_BCRYPT)];
                }
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