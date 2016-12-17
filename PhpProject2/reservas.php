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
        <nav class="navbar">
            <h1>Reservas</h1>
            <button class="btn btn-outline-success float-xs-right" type="button" data-toggle="modal" data-target="#addModal">Añadir</button>
        </nav>
<?php 
    $modelo = new Modelo();
    $reservas = $modelo->selectReservas();
    $clientes = $modelo->selectClientes();
    $vuelos   = $modelo->selectVuelos();
    
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
            $urlModificar = "modificarReserva.php?idVuelo=".$reserva['idVuelo']."&idCliente=".$reserva['idCliente'];
            $urlEliminar = "eliminarReserva.php?idVuelo=".$reserva['idVuelo']."&idCliente=".$reserva['idCliente'];
            ?><tr>
                <td><?php echo $reserva['idVuelo']?></td>
                <td><?php echo $reserva['idCliente']?></td>
                <td><?php echo $reserva['precioR']?></td>
                <td><?php echo $reserva['asiento']?></td>
                <td>
                    <a><button type="button" data-toggle="modal" data-target="#modificar<?php echo $reserva['idVuelo'], $reserva['idCliente'] ?>" value="editar">Modificar</button></a>
                    <a href="<?php echo $urlEliminar ?>"><button  name = "boton" value="eliminar">Eliminar</button></a>
                </td>
                
                <div class="modal fade" id="modificar<?php echo $reserva['idVuelo'], $reserva['idCliente'] ?>" tabindex="-1" role="dialog" aria-labelledby="Modal para añadir" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Modificar la reserva <?php echo $reserva['idVuelo'], $reserva['idCliente'] ?></h4>
                      </div>
                      <form action="modificarReserva.php" method="POST"> 
                        <div class="modal-body">
                            <input type="hidden" name="idVuelo" value="<?php echo $reserva['idVuelo'] ?>">
                            <input type="hidden" name="idCliente" value="<?php echo $reserva['idCliente'] ?>">
                            <div class="form-group row form-inline">
                                <label for="inputAsiento" class="col-xs-2 col-form-label">Asiento</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="inputAsiento" placeholder="0" name="asiento">
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
        echo 'No existen reservas en la base de datos';
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
            <h4 class="modal-title">Añadir una reserva</h4>
          </div>
          <form action="insertReserva.php" method="POST"> 
            <div class="modal-body">
                <div class="form-group row">
                  <label for="inputIdVuelo" class="col-xs-2 col-form-label">ID Vuelo</label>
                  <div class="col-xs-10">
                      <select class="form-control" name="idVuelo">
                      <?php 
                      foreach ($vuelos as $vuelo) 
                      {?>
                          <option><?php echo $vuelo['idVuelo'] ?></option>
                      <?php
                      }?>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputIdAvion" class="col-xs-4 col-form-label">ID Avion</label>
                  <div class="col-xs-8">
                      <select class="form-control" name="idCliente">
                      <?php 
                      foreach ($clientes as $cliente) 
                      {?>
                          <option><?php echo $cliente['dni'] ?></option>
                      <?php
                      }?>
                      </select>
                  </div>
                </div>
                <div class="form-group row form-inline">
                    <label class="col-xs-2 col-form-label" for="inputPrecio">Precio</label>
                    <div class="input-group col-xs-8">
                        <div class="input-group-addon">€</div>
                        <input type="text" class="form-control" id="inputPrecio" placeholder="0" name="precio1">
                        <div class="input-group-addon">.</div>
                        <input type="text" class="form-control" id="inputPrecio" placeholder="00" name="precio2">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label" for="inputAsiento">Asiento</label>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="inputAsiento" placeholder="0" name="asiento">
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

