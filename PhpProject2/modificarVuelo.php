<?php
include("modelo.php");

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$precio1 = $_POST['precio1'];
$precio2 = $_POST['precio2'];
//echo $id, $fecha, $precio1, $precio2;
$modelo = new Modelo();
$modelo->modificarVuelo($id, $fecha, $precio1, $precio2);

header("Location:vuelos.php");