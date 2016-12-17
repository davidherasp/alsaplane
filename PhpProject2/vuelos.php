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
        <nav class="navbar">
            <h1>Vuelos</h1>
            <button class="btn btn-outline-success float-xs-right" type="button" data-toggle="modal" data-target="#addModal">Añadir</button>
        </nav>
<?php 
    $modelo = new Modelo();
    $vuelos = $modelo->selectVuelos();
    $aviones= $modelo->selectAviones();
    
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
                <th>Fecha</th>
                <th>Precio</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($vuelos as $vuelo) {
            $urlModificar = "modificarVuelo.php?idVuelo=".$vuelo['idVuelo'];
            $urlEliminar = "eliminarVuelo.php?idVuelo=".$vuelo['idVuelo'];
            ?><tr>
                <td><?php echo $vuelo['idVuelo']?></td>
                <td><?php echo $vuelo['idAvion']?></td>
                <td><?php echo $vuelo['origen']?></td>
                <td><?php echo $vuelo['destino']?></td>
                <td><?php echo $vuelo['fechaVuelo']?></td>
                <td><?php echo $vuelo['precioV']?></td>
                <td>
                    <a><button type="button" data-toggle="modal" data-target="#modificar<?php echo $vuelo['idVuelo'] ?>" value="editar">Modificar</button></a>
                    <a href="<?php echo $urlEliminar ?>"><button  name = "boton" value="editar">Eliminar</button></a>
                </td>
              </tr> 
                
                <div class="modal fade" id="modificar<?php echo $vuelo['idVuelo'] ?>" tabindex="-1" role="dialog" aria-labelledby="Modal para añadir" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Modificar el vuelo <?php echo $vuelo['idVuelo'] ?></h4>
                      </div>
                      <form action="modificarVuelo.php" method="POST"> 
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $vuelo['idVuelo'] ?>">
                            <div class="form-group row">
                                <label for="example-date-input" class="col-xs-3 col-form-label">Fecha vuelo</label>
                                <div class="col-xs-9">
                                  <input class="form-control" type="date" value="<?php echo $vuelo['fechaVuelo'] ?>" name="fecha">
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
        echo 'No existen vuelos en la base de datos';
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
            <h4 class="modal-title">Añadir un vuelo</h4>
          </div>
          <form action="insertVuelo.php" method="POST"> 
            <div class="modal-body">
                <div class="form-group row">
                  <label for="inputIdVuelo" class="col-xs-2 col-form-label">ID Vuelo</label>
                  <div class="col-xs-10">
                      <input type="text" class="form-control" id="inputIdVuelo" placeholder="" name="idVuelo">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputIdAvion" class="col-xs-4 col-form-label">ID Avion</label>
                  <div class="col-xs-8">
                      <select class="form-control" name="idAvion">
                      <?php 
                      foreach ($aviones as $avion) 
                      {?>
                          <option><?php echo $avion['idAvion'] ?></option>
                      <?php
                      }?>
                      </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xs-2 col-form-label" for="inputOrigen">Origen</label>
                  <div class="col-xs-4">
                      <input type="text" class="form-control" id="inputOrigen" placeholder="" name="origen">
                  </div>
                  <label class="col-xs-2 col-form-label" for="inputDestino">Destino</label>
                  <div class="col-xs-4">
                      <input type="text" class="form-control" id="inputDestino" placeholder="" name="destino">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-date-input" class="col-xs-4 col-form-label">Fecha vuelo</label>
                  <div class="col-xs-8">
                    <input class="form-control" type="date" value="2011-08-19" name="fecha">
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

