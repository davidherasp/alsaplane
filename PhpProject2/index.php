<?php
include("modelo.php"); //Con la ruta donde esta
session_start();
$modelo = new Modelo();
?> 

<html>
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <title>Alsaplane admin</title>
    </head>
    <body>
        <nav class="navbar navbar-light bg-faded">
            <div class="container">
                <a class="navbar-brand" href="#">Alsaplane</a>
                <div class="float-xs-right">
                <ul class="nav navbar-nav">
                  <li class="btn"><i class="material-icons">account_circle</i>Admin</li>
                  <li class="btn"><i class="material-icons">highlight_off</i>Logout</li>
                </ul>
                </div>
            </div>
	</nav>
        
        <div class="container">
            <div class="row">
                <h1 class="display-1">Alsaplane</h1>
                <h1 class="display-4">Página de administración</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="card" style="width: 322px">
                  <img class="card-img-top" src="./images/vuelos.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h4 class="card-title">Vuelos</h4>
                    <p class="card-text">Gestiona los vuelos.</p>
                    <a href="./vuelos.php" class="btn btn-primary">Ver vuelos</a>
                  </div>
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="card" style="width: 322px">
                  <img class="card-img-top" src="./images/reservas.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h4 class="card-title">Reservas</h4>
                    <p class="card-text">Gestiona las reservas.</p>
                    <a href="./reservas.php" class="btn btn-primary">Ver reservas</a>
                  </div>
                </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="card" style="width: 322px">
                  <img class="card-img-top" src="./images/avion.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h4 class="card-title">Aviones</h4>
                    <p class="card-text">Gestiona las aviones.</p>
                    <a href="./aviones.php" class="btn btn-primary">Ver aviones</a>
                  </div>
                </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="card" style="width: 322px">
                  <img class="card-img-top" src="./images/empleados.jpg" alt="Card image cap">
                  <div class="card-block">
                    <h4 class="card-title">Empleados</h4>
                    <p class="card-text">Gestiona los empleados.</p>
                    <a href="./empleados.php" class="btn btn-primary">Ver empleados</a>
                  </div>
                </div>
                </div>
            </div>
	</div>
    </body>
</html>
