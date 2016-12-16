<?php
include("modelo.php");

$id = $_POST['id'];
$rol = $_POST['rol'];

$modelo = new Modelo();
$modelo->modificarEmpleado($id, $rol);

header("Location:empleados.php");