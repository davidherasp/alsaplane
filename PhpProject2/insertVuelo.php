<?php
include("modelo.php");

$idVuelo = $_POST['idVuelo'];
$idAvion = $_POST['idAvion'];
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$fecha = $_POST['fecha'];
$precio1 = $_POST['precio1'];
$precio2 = $_POST['precio2'];
$tripulacion = $_POST['tripulacion'];

$modelo = new Modelo();
$modelo->insertVuelo($idVuelo, $idAvion, $origen, $destino, $fecha, $precio1, $precio2, $tripulacion);

header("Location:vuelos.php");