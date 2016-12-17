<?php
include("modelo.php");

$idVuelo = $_POST['idVuelo'];
$idCliente = $_POST['idCliente'];
$precio1 = $_POST['precio1'];
$precio2 = $_POST['precio2'];
$asiento = $_POST['asiento'];

//echo $idVuelo.$idAvion.$origen.$destino.$fecha.$precio;
$modelo = new Modelo();
$modelo->insertReserva($idVuelo, $idCliente, $precio1, $precio2, $asiento);

header("Location:reservas.php");