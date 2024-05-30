<?php

    session_start();
    if (!isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $info = $_SESSION['info'];
        header("Location: login.php");
        exit();
    }

    $idTarea = "";

    if($_GET["p1"]!="") {
        $idTarea = $_GET['p1'];
        $descripcion = $_GET['p2'];
        $fecha_inicio = $_GET['p3'];
        $fecha_fin = $_GET['p4'];
        $idActividad = $_GET['p5'];
        $estado = $_GET['p6'];
        $presupuesto = $_GET['p7'];
    }

    require_once(__DIR__ . '/../Controller/actividadController.php');
    require_once(__DIR__ . '/../Controller/tareaController.php');

    $ctlActividad = new ActividadController();
    $ctlTarea = new TareaController();
    $actividades = $ctlActividad->list();
    
    if(isset($_GET['estado'])){
        $tareas = $ctlTarea->getEstados();
    } 
    else {
        $tareas = $ctlTarea->list();
    }
    function info($idActividad, $ctlActividad){
        $actividad = $ctlActividad->info($idActividad);
        return $actividad['descripcion'];
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
                <a class="nav-link " aria-current="page" href="proyectos.php">PROYECTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="actividades.php">ACTIVIDADES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="tareas.php">TAREAS</a>
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
    <div class=" text-center px-5 my-5 w-100">
        <div class="row w-100">
            <!-- Formulario -->
            <?php if ($idTarea!=""): ?>
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Modificar tarea</h5>
                    <div class="card-body">
                        <h5 class="card-title">Información de tarea</h5>
                        <form class="form" action="../index.php?controller=tarea&action=update&id=<?php echo $idTarea?>" method="post">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="idProyecto" name="idTarea" placeholder="idTarea"  <?php echo 'value="'.$idTarea.'"'  ?> required disabled>
                                <label for="idTarea">ID</label>
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
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="YYYY-MM-DD" <?php echo 'value="'.$fecha_fin.'"'  ?> required>
                                <label for="fecha_fin">Fecha de fin</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="idActividad" name="idActividad" aria-label="Tarea" >
                                    <option>Seleccionar</option>
                                    <?php
                                    foreach ($actividades as $value) {
                                        if ($value['idActividad']==$idActividad){
                                            echo '<option value="'.$value['idActividad'].'" selected>'.$value['descripcion'].'</option>';
                                        }
                                        else {
                                            echo '<option value="'.$value['idActividad'].'">'.$value['descripcion'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="idActividad">Actividad</label>
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
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="presupuesto" name="presupuesto" placeholder="presupuesto" <?php echo 'value="'.$presupuesto.'"'  ?> required>
                                <label for="presupuesto">Presupuesto</label>
                            </div>
                            <button class="btn btn-outline-warning" type="submit">MODIFICAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Registro Tarea</h5>
                    <div class="card-body">
                        <h5 class="card-title">Información de tarea</h5>
                        <form class="form" action="../index.php?controller=tarea&action=insert" method="post">
                        <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion"  required>
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="YYYY-MM-DD" required>
                                <label for="fecha_inicio">Fecha de inicio</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="YYYY-MM-DD" required>
                                <label for="fecha_fin">Fecha de fin</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="idActividad" name="idActividad" aria-label="Tarea" >
                                    <option>Seleccionar</option>
                                    <?php
                                    foreach ($actividades as $value) {
                                        echo '<option value="'.$value['idActividad'].'">'.$value['descripcion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idActividad">Actividad</label>
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
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="presupuesto" name="presupuesto" placeholder="presupuesto" required>
                                <label for="presupuesto">Presupuesto</label>
                            </div>
                            <button class="btn btn-outline-success" type="submit">REGISTRAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Tabla -->
            <div class="col-8 mb-4" >
                <a href="tareas.php" class="btn btn-primary mx-2">TODOS</a>
                <a href="tareas.php?estado=terminado" class="btn btn-success mx-2">TERMINADOS</a>
                <a href="tareas.php?estado=comenzado" class="btn btn-warning mx-2">COMENZANDOS</a>
                <a href="tareas.php?estado=sin iniciar" class="btn btn-dark mx-2">SIN INICIAR</a>
                <a href="tareas.php?estado=Atrasado" class="btn btn-danger mx-2">ATRASADO</a>
                <div class="card my-3 w-100">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DESCRIPCION</th>
                                    <th scope="col">INICIO</th>
                                    <th scope="col">FIN</th>
                                    <th scope="col">ACTIVIDAD</th>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col">PRESUPUESTO</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($tareas as $value) {
                                        $estado = "";
                                        if ($value['estado']== 'terminado') $estado = '<span class="badge rounded-pill text-bg-success">Terminado</span>';
                                        else if ($value['estado']== 'comenzado') $estado = '<span class="badge rounded-pill text-bg-warning">Comenzado</span>';
                                        else if ($value['estado']== 'sin iniciar') $estado = '<span class="badge rounded-pill text-bg-dark">Sin iniciar</span>';
                                        else if ($value['estado']== 'atrasado') $estado = '<span class="badge rounded-pill text-bg-danger">Atrasado</span>';
                                        echo '<tr>
                                            <th scope="row">'.$value['idTarea'].'</th>
                                            <td>'.$value['descripcion'].'</td>
                                            <td>'.$value['fecha_inicio'].'</td>
                                            <td>'.$value['fecha_fin'].'</td>
                                            <td>'.info($value['idActividad'], $ctlActividad).'</td>
                                            <td>'.$estado.'</td>
                                            <td>'.$value['presupuesto'].'</td>
                                            <td>
                                            <a class="btn btn-primary" href="../index.php?controller=tarea&action=listId&id='.$value['idTarea'].'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg>
                                            </a>    
                                            <a class="btn btn-danger" href="../index.php?controller=tarea&action=delete&id='.$value['idTarea'].'">
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