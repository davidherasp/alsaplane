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

        <title>Alsaplane admin login</title>
    </head>
    <body>
        <div class="container">
            <h1 class="display-1 text-xs-center">Alsaplane admin</h1>

            <div class="row">
            <div class="card card-block" style="width: 18rem; float: none; margin: 0 auto;">
                <h4 class="card-title">Login admin</h4>
                <form action="iniciarSesion.php" method="POST">
                    <div class="form-group">
                      <label for="formGroupInput">Nombre admin</label>
                      <input type="text" class="form-control" id="formGroupInput" placeholder="Usuario" name="nombre">
                    </div>
                    <div class="form-group">
                      <label for="formGroupInput2">Contraseña admin</label>
                      <input type="password" class="form-control" id="formGroupInput2" placeholder="Contraseña" name="clave">
                    </div>
                    <button type="submit" class="btn btn-primary">Introducir</button>
                </form>
            </div>
            </div>
        </div>
        
    </body>
</html>