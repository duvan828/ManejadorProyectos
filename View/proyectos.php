<?php

    session_start();
    if (!isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $info = $_SESSION['info'];
        header("Location: login.php");
        exit();
    }

    $idProyecto = "";

    if(isset($_GET["p1"])) {
        $idProyecto = $_GET['p1'];
        $descripcion = $_GET['p2'];
        $fecha_inicio = $_GET['p3'];
        $fecha_entrega = $_GET['p4'];
        $valor = $_GET['p5'];
        $lugar = $_GET['p6'];
        $responsable = $_GET['p7'];
        $estado = $_GET['p8'];
    }
    require_once(__DIR__ . '/../Controller/personaController.php');
    require_once(__DIR__ . '/../Controller/proyectoController.php');

    $ctlPersona = new PersonaController();
    $ctlProyecto = new ProyectoController();

    $personas = $ctlPersona->list();
    if(isset($_GET['estado'])){
        $proyectos = $ctlProyecto->getEstadosProyectos();
    }
    else {
        $proyectos = $ctlProyecto->list();
    }

    function info($responsable, $ctlPersona){
        $persona = $ctlPersona->info($responsable);
        return $persona['nombre'].' '.$persona['apellido'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <style>
        .card-form {
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GESTIÓN DE PROYECTOS - <?php print_r($_SESSION['info']) ?></a>
        <button class="navbar-toggler" type="butarton" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">OPCIONES</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link" href="personas.php">PERSONAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="proyectos.php">PROYECTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="actividades.php">ACTIVIDADES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="tareas.php">TAREAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="recursos.php">RECURSOS</a>
            </li>
            <li>
                <hr class="nav-divider">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php?controller=persona&action=leave">CERRAR SESIÓN</a>
            </li>
            </ul>
        </div>
        </div>
    </div>
    </nav>
    <div class=" text-center px-5 w-100" style="margin-top: 80px;">
        <div class="row w-100">
            <!-- Formulario -->
            <?php if ($idProyecto!=""): ?>
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Modificar proyecto</h5>
                    <div class="card-body">
                        <h5 class="card-title">Información de proyecto</h5>
                        <form class="form" action="../index.php?controller=proyecto&action=update&id=<?php echo $idProyecto?>" method="post">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="idProyecto" name="idProyecto" placeholder="idProyecto"  <?php echo 'value="'.$idProyecto.'"'  ?> required disabled>
                                <label for="idProyecto">ID</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion"  <?php echo 'value="'.$descripcion.'"'  ?> required>
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="YYYY-MM-DD" <?php echo 'value="'.$fecha_inicio.'"'  ?> required>
                                <label for="fecha_inicio">Fecha de inicio</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" placeholder="YYYY-MM-DD" <?php echo 'value="'.$fecha_entrega.'"'  ?> required>
                                <label for="fecha_entrega">Fecha de entrega</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="valor" name="valor" placeholder="valor" <?php echo 'value="'.$valor.'"'  ?> required>
                                <label for="valor">Valor</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="lugar" name="lugar" placeholder="lugar" <?php echo 'value="'.$lugar.'"'  ?> required>
                                <label for="lugar">Lugar</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="responsable" name="responsable" aria-label="Responsable" >
                                    <option>Seleccionar</option>
                                    <?php
                                    foreach ($personas as $person) {
                                        if ($person['idPersona']==$responsable){
                                            echo '<option value="'.$person['idPersona'].'" selected>'.$person['nombre'].' '.$person['apellido'].'</option>';
                                        }
                                        else {
                                            echo '<option value="'.$person['idPersona'].'">'.$person['nombre'].' '.$person['apellido'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="responsable">Responsable</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="estado" name="estado" aria-label="Estado" >
                                    <option value="sin iniciar" <?php if($estado=="sin iniciar") echo 'selected' ?>>Sin iniciar</option>
                                    <option value="comenzado" <?php if($estado=="comenzado") echo 'selected' ?>>Comenzado</option>
                                    <option value="terminado" <?php if($estado=="terminado") echo 'selected' ?>>Terminado</option>
                                    <option value="atrasado" <?php if($estado=="atrasado") echo 'selected' ?>>Atrasado</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                            <button class="btn btn-outline-warning" type="submit">MODIFICAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Registro Proyecto</h5>
                    <div class="card-body">
                        <h5 class="card-title">Información de proyecto</h5>
                        <form class="form" action="../index.php?controller=proyecto&action=insert" method="post">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" required>
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="YYYY-MM-DD" >
                                <label for="fecha_inicio">Fecha de inicio</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" placeholder="YYYY-MM-DD" >
                                <label for="fecha_entrega">Fecha de entrega</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="valor" name="valor" placeholder="valor" >
                                <label for="valor">Valor</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="lugar" name="lugar" placeholder="lugar" >
                                <label for="lugar">Lugar</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="responsable" name="responsable" aria-label="Responsable" >
                                    <option selected>Seleccionar</option>
                                    <?php
                                    foreach ($personas as $person) {
                                        echo '<option value="'.$person['idPersona'].'">'.$person['nombre'].' '.$person['apellido'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="responsable">Responsable</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="estado" name="estado" aria-label="Estado" >
                                    <option value="sin iniciar">Sin iniciar</option>
                                    <option value="comenzado">Comenzado</option>
                                    <option value="terminado">Terminado</option>
                                    <option value="atrasado">Atrasado</option>
                                </select>
                                <label for="estado">Estado</label>
                            </div>
                            <button class="btn btn-outline-success" type="submit">REGISTRAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Tabla -->
            <div class="col-8 mb-4" >
            <a href="proyectos.php" class="btn btn-primary mx-2">TODOS</a>
            <a href="proyectos.php?estado=terminado" class="btn btn-success mx-2">TERMINADOS</a>
            <a href="proyectos.php?estado=comenzado" class="btn btn-warning mx-2">COMENZANDOS</a>
            <a href="proyectos.php?estado=sin iniciar" class="btn btn-dark mx-2">SIN INICIAR</a>
            <a href="proyectos.php?estado=Atrasado" class="btn btn-danger mx-2">ATRASADO</a>
                <div class="card w-100 mt-2">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DESCRIPCION</th>
                                    <th scope="col">INICIO</th>
                                    <th scope="col">ENTREGA</th>
                                    <th scope="col">VALOR</th>
                                    <th scope="col">LUGAR</th>
                                    <th scope="col">RESPONSABLE</th>
                                    <th scope="col">ESTADO</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($proyectos as $value) {
                                        $estado = "";
                                        if ($value['estado']== 'terminado') $estado = '<span class="badge rounded-pill text-bg-success">Terminado</span>';
                                        else if ($value['estado']== 'comenzado') $estado = '<span class="badge rounded-pill text-bg-warning">Comenzado</span>';
                                        else if ($value['estado']== 'sin iniciar') $estado = '<span class="badge rounded-pill text-bg-dark">Sin iniciar</span>';
                                        else if ($value['estado']== 'atrasado') $estado = '<span class="badge rounded-pill text-bg-danger">Atrasado</span>';
                                        echo '<tr>
                                            <th scope="row">'.$value['idProyecto'].'</th>
                                            <td>'.$value['descripcion'].'</td>
                                            <td>'.$value['fecha_inicio'].'</td>
                                            <td>'.$value['fecha_entrega'].'</td>
                                            <td>'.$value['valor'].'</td>
                                            <td>'.$value['lugar'].'</td>
                                            <td>'.info($value['responsable'], $ctlPersona).'</td>
                                            <td>'.$estado.'</td>
                                            <td>
                                            <a class="btn btn-primary" href="../index.php?controller=proyecto&action=listId&id='.$value['idProyecto'].'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg>
                                            </a>    
                                            <a class="btn btn-danger" href="../index.php?controller=proyecto&action=delete&id='.$value['idProyecto'].'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                </svg>
                                            </a>
                                            </td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>