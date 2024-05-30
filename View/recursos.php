<?php

    session_start();
    if (!isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $info = $_SESSION['info'];
        header("Location: login.php");
        exit();
    }

    $idRecurso = "";

    if($_GET["p1"]!="") {
        $idRecurso = $_GET['p1'];
        $descripcion = $_GET['p2'];
        $valor = $_GET['p3'];
        $unidadmedida = $_GET['p4'];
    }

    require_once(__DIR__ . '/../Controller/recursoController.php');
    require_once(__DIR__ . '/../Controller/tareaController.php');
    require_once(__DIR__ . '/../Controller/tareaxrecursosController.php');

    $ctlRecurso = new RecursoController();
    $ctlTarea = new TareaController();
    $ctlTareaxRecursos = new TareaxrecursosController();
    $recursos = $ctlRecurso->list();
    $tareas = $ctlTarea->list();
    $asignaciones = $ctlTareaxRecursos->list();

    function info($id, $ctl){
        $resp = $ctl->info($id);
        return $resp['descripcion'];
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
    <div class=" text-center px-5 my-5 w-100">
        <div class="row w-100">
            <!-- Formulario -->
            <?php if ($idRecurso!=""): ?>
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Modificar recurso</h5>
                    <div class="card-body">
                        <h5 class="card-title">Información de recurso</h5>
                        <form class="form" action="../index.php?controller=recurso&action=update&id=<?php echo $idRecurso?>" method="post">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="idProyecto" name="idRecurso" placeholder="idRecurso"  <?php echo 'value="'.$idRecurso.'"'  ?> required disabled>
                                <label for="idRecurso">ID</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion"  <?php echo 'value="'.$descripcion.'"'  ?> required>
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="valor" name="valor" placeholder="valor" <?php echo 'value="'.$valor.'"'  ?> required>
                                <label for="valor">Valor</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="unidadmedida" maxlength="10" name="unidadmedida" placeholder="unidadmedida"  <?php echo 'value="'.$unidadmedida.'"'  ?> required>
                                <label for="unidadmedida">Unidad medida</label>
                            </div>
                            <button class="btn btn-outline-warning" type="submit">MODIFICAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Registro Recurso</h5>
                    <div class="card-body">
                        <h5 class="card-title">Información de recurso</h5>
                        <form class="form" action="../index.php?controller=recurso&action=insert" method="post">
                        <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="valor" name="valor" placeholder="valor" required>
                                <label for="valor">Valor</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="unidadmedida" maxlength="10" name="unidadmedida" placeholder="unidadmedida" required>
                                <label for="unidadmedida">Unidad medida</label>
                            </div>
                            <button class="btn btn-outline-success" type="submit">REGISTRAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Tabla -->
            <div class="col-8 mb-4" >
                <div class="card w-100">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DESCRIPCION</th>
                                    <th scope="col">VALOR</th>
                                    <th scope="col">UNIDAD MEDIDA</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($recursos as $value) {
                                        echo '<tr>
                                            <th scope="row">'.$value['idRecurso'].'</th>
                                            <td>'.$value['descripcion'].'</td>
                                            <td>'.$value['valor'].'</td>
                                            <td>'.$value['unidadmedida'].'</td>
                                            <td>
                                            <a class="btn btn-primary" href="../index.php?controller=recurso&action=listId&id='.$value['idRecurso'].'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg>
                                            </a>    
                                            <a class="btn btn-danger" href="../index.php?controller=recurso&action=delete&id='.$value['idRecurso'].'">
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
    <div class=" text-center px-5 my-5 w-100">
        <div class="row w-100">
            <!-- Formulario -->
            <div class="col-4 mb-4">
                <div class="card card-form w-100">
                    <h5 class="card-header">Asignar recursos a tarea</h5>
                    <div class="card-body">
                        <h5 class="card-title">Asignación</h5>
                        <form class="form" action="../index.php?controller=tareaxrecursos&action=insert" method="post">
                            <div class="form-floating mb-2">
                                <select class="form-select" id="idTarea" name="idTarea" aria-label="Tarea" >
                                    <option>Seleccionar</option>
                                    <?php
                                    foreach ($tareas as $value) {
                                        echo '<option value="'.$value['idTarea'].'">'.$value['descripcion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idTarea">Tarea</label>
                            </div>
                            <div class="form-floating mb-2">
                                <select class="form-select" id="idRecurso" name="idRecurso" aria-label="Recurso" >
                                    <option>Seleccionar</option>
                                    <?php
                                    foreach ($recursos as $value) {
                                        echo '<option value="'.$value['idRecurso'].'">'.$value['descripcion'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="idRecurso">Recurso</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad" required>
                                <label for="cantidad">Cantidad</label>
                            </div>
                            <button class="btn btn-outline-warning" type="submit">Asignar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="col-8 mb-4" >
                <div class="card w-100">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">TAREA</th>
                                    <th scope="col">RECURSO</th>
                                    <th scope="col">CANTIDAD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($asignaciones as $value) {
                                        echo '<tr>
                                            <td>'.info($value['idTarea'], $ctlTarea).'</td>
                                            <td>'.info($value['idRecurso'], $ctlRecurso).'</td>
                                            <td>'.$value['cantidad'].'</td>
                                            <td> 
                                            <a class="btn btn-danger" href="../index.php?controller=tareaxrecursos&action=delete&id='.$value['idTarea'].'">
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