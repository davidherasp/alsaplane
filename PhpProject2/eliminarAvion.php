<?php
session_start();
include("modelo.php");

$idAvion = $_GET['idAvion'];

echo '--->'.$idAvion;
$modelo = new Modelo();
$result = $modelo->eliminarAvion($idAvion);

if($result != NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha eliminado el avión')
                    window.location.href='aviones.php';
           </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha producido un error al eliminar el avión')
                    window.location.href='aviones.php';
           </SCRIPT>");
}