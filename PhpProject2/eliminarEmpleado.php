<?php
session_start();
include("modelo.php");

$idEmpleado = $_GET['idEmpleado'];

echo '--->'.$idEmpleado;
$modelo = new Modelo();
$result = $modelo->eliminarEmpleado($idEmpleado);

if($result != NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha eliminado el empleado. Otro parado más :(')
                    window.location.href='empleados.php';
           </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha producido un error al eliminar el empleado')
                    window.location.href='empleados.php';
           </SCRIPT>");
}