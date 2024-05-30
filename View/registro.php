<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
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
    <div class=" text-center px-5 my-5  w-100">
            <div class="card card-form mx-auto my-5 w-50">
                <h5 class="card-header">Registro persona</h5>
                <div class="card-body">
                    <h5 class="card-title">Información Básica</h5>
                    <form class="form" action="../index.php?controller=persona&action=insert" method="post">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" id="idPersona" name="idPersona" placeholder="Documento" required>
                            <label for="idPersona">Documento</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                            <label for="contraseña">Contraseña</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" >
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" >
                            <label for="direccion">Direccion</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="telefono" maxlength="10" name="telefono" placeholder="300....." >
                            <label for="telefono">Telefono</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-select" id="sexo" name="sexo" aria-label="Sexo" >
                                <option selected>Seleccionar</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                            <label for="sexo">Sexo</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="YYYY-MM-DD" >
                            <label for="fechanacimiento">Fecha de Nacimiento</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Ing de ..." >
                            <label for="profesion">Profesión</label>
                        </div>
                        <button class="btn btn-outline-success" type="submit">REGISTRAR</button>
                        <a class="btn btn-outline-danger" href="login.php">SALIR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>