<?php
include("modelo.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fechaNac = $_POST['fechaNac'];
$rol = $_POST['rol'];

$modelo = new Modelo();
$modelo->insertEmpleado($nombre, $apellidos, $fechaNac, $rol);

header("Location:empleados.php");