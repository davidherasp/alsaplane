<?php
include("modelo.php");

$modeloA = $_POST['modelo'];
$asientos = $_POST['asientos'];

$modelo = new Modelo();
$modelo->insertAvion($modeloA, $asientos);

header("Location:aviones.php");