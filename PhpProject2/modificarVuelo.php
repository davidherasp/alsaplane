<?php
include("modelo.php");

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$precio1 = $_POST['precio1'];
$precio2 = $_POST['precio2'];
$tripulacion = $_POST['tripulacion'];

$modelo = new Modelo();
$modelo->modificarVuelo($id, $fecha, $precio1, $precio2, $tripulacion);

header("Location:vuelos.php");