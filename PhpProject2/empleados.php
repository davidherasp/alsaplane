<?php
include("modelo.php"); //Con la ruta donde esta
session_start();
?> 

<!DOCTYPE html>
<html lang="en"> 
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
   
    <title>Alsaplane empleados</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-faded">
      <div class="container">
        <a class="navbar-brand" href="./index.php">Alsaplane</a>
        <div class="float-xs-right">
          <ul class="nav navbar-nav">
            <li class="btn"><i class="material-icons">account_circle</i>Admin</li>
            <li class="btn"><i class="material-icons">highlight_off</i>Logout</li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container">
        <nav class="navbar">
            <button class="btn btn-outline-success float-xs-right" type="button" data-toggle="modal" data-target="#addModal">Añadir</button>
        </nav>
<?php 
    $modelo = new Modelo();
    $empleados = $modelo->selectEmpleados();
    
    if ($empleados != NULL)
    {
        ?>
        <table class="table table-hover">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha nacimiento</th>
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($empleados as $empelado) {
            $urlModificar = "modificarEmpleado.php?idEmpleado=".$empelado['idTrabajador'];
            $urlEliminar = "eliminarEmpleado.php?idEmpleado=".$empelado['idTrabajador'];
            ?><tr>
                <td><?php echo $empelado['idTrabajador']?></td>
                <td><?php echo $empelado['nombreTra']?></td>
                <td><?php echo $empelado['apellidosTra']?></td>
                <td><?php echo $empelado['fechaNacTra']?></td>
                <td><?php echo $empelado['rolTra']?></td>
                <td>
                    <a><button type="button" data-toggle="modal" data-target="#modificar<?php echo $empelado['idTrabajador'] ?>" value="editar">Modificar</button></a>
                    <a href="<?php echo $urlEliminar ?>"><button value="editar" data-target="#modificarModal">Eliminar</button></a>
                </td>
                
                <div class="modal fade" id="modificar<?php echo $empelado['idTrabajador'] ?>" tabindex="-1" role="dialog" aria-labelledby="Modal para añadir" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Modificar un empleado</h4>
                      </div>
                      <form action="modificarEmpleado.php" method="POST"> 
                        <div class="modal-body">
                            <div class="form-group row">
                                <input type="hidden" name="id" value="<?php echo $empelado['idTrabajador'] ?>">
                                <label class="col-xs-2 col-form-label" for="inputRol">Rol</label>
                                <div class="col-xs-10">
                                    <select class="form-control" name="rol">
                                      <option>piloto</option>
                                      <option>copiloto</option>
                                      <option>auxiliar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
            <?php    
        }
        ?>
        </tbody>
        </table>
        <?php 
    } 
    else
    {
        echo 'No existen empleados en la base de datos';
    }
?>
    </div>
      
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="Modal para añadir" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Añadir un empleado</h4>
          </div>
          <form action="insertEmpleado.php" method="POST"> 
            <div class="modal-body">
                  <div class="form-group row">
                    <label for="inputNombre" class="col-xs-2 col-form-label">Nombre</label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" id="inputNombre" placeholder="" name="nombre">
                    </div>
                    <label for="inputApellidos" class="col-xs-2 col-form-label">Apellidos</label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="inputApellidos" placeholder="" name="apellidos">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-date-input" class="col-xs-4 col-form-label">Fecha nacimiento</label>
                    <div class="col-xs-8">
                      <input class="form-control" type="date" value="2011-08-19" name="fechaNac">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-xs-2 col-form-label" for="inputRol">Rol</label>
                    <div class="col-xs-10">
                        <select class="form-control" name="rol">
                          <option>piloto</option>
                          <option>copiloto</option>
                          <option>auxiliar</option>
                        </select>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->   
  
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
</body>
</html>

