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
  
  <title>Alsaplane reservas</title>
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
    $reservas = $modelo->selectReservas();
    
    if ($reservas != NULL)
    {
        ?>
        <table class="table table-hover">
        <thead class="thead-inverse">
            <tr>
                <th>ID vuelo</th>
                <th>ID cliente</th>
                <th>Precio reserva</th>
                <th>Asiento</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($reservas as $reserva) {
            ?><tr>
                <td><?php echo $reserva['idVuelo']?></td>
                <td><?php echo $reserva['idCliente']?></td>
                <td><?php echo $reserva['precioR']?></td>
                <td><?php echo $reserva['asiento']?></td>
                <td>
                    <a href="#"><button  name = "boton" value="editar">Modificar</button></a>
                    <a href="#"><button  name = "boton" value="editar">Eliminar</button></a>
                </td>
            <?php    
        }
        ?>
        </tbody>
        </table>
        <?php 
    } 
    else
    {
        echo 'No existen reservas en la base de datos';
    }
?>
    </div>
        
</body>
</html>

