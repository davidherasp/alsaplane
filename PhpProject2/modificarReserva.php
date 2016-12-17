<?php
include("modelo.php");

$idVuelo = $_POST['idVuelo'];
$idCliente = $_POST['idCliente'];
$asiento = $_POST['asiento'];

//echo $id, $fecha, $precio1, $precio2;
$modelo = new Modelo();
$modelo->modificarReserva($idVuelo, $idCliente, $asiento);

header("Location:reservas.php");