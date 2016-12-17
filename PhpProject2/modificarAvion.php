<?php
include("modelo.php");

$id = $_POST['id'];
$asientos = $_POST['asientos'];

$modelo = new Modelo();
$modelo->modificarAvion($id, $asientos);

header("Location:aviones.php");