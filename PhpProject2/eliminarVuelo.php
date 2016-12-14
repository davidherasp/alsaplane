<?php
session_start();
include("modelo.php");

$idVuelo = $_GET['idVuelo'];

echo '--->'.$idVuelo;
$modelo = new Modelo();
$result = $modelo->eliminarVuelo($idVuelo);

if($result != NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha eliminado el vuelo')
                    window.location.href='vuelos.php';
           </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha producido un error al eliminar el avión')
                    window.location.href='vuelos.php';
           </SCRIPT>");
}