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
            ?><tr>
                <td><?php echo $empelado['idTrabajador']?></td>
                <td><?php echo $empelado['nombreTra']?></td>
                <td><?php echo $empelado['apellidosTra']?></td>
                <td><?php echo $empelado['fechaNacTra']?></td>
                <td><?php echo $empelado['rolTra']?></td>
                <td><a href="#"><button  name = "boton" value="editar">Editar</button></a></td>
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
        
</body>
</html>

