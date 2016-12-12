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
  
  <title>Alsaplane vuelos</title>
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
    $vuelos = $modelo->selectVuelos();
    
    if ($vuelos != NULL)
    {
        ?>
        <table class="table table-hover">
        <thead class="thead-inverse">
            <tr>
                <th>Identificador</th>
                <th>Avion ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Precio</th>
                <th>PrecioV</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($vuelos as $vuelo) {
            ?><tr>
                <td><?php echo $vuelo['idVuelo']?></td>
                <td><?php echo $vuelo['idAvion']?></td>
                <td><?php echo $vuelo['origen']?></td>
                <td><?php echo $vuelo['destino']?></td>
                <td><?php echo $vuelo['precioV']?></td>
                <td><?php echo $vuelo['precioV']?></td>
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
        echo 'No existen vuelos en la base de datos';
    }
?>
    </div>
        
</body>
</html>

