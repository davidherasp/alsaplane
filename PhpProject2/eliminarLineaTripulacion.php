<?php
session_start();
include("modelo.php");

$idVuelo = $_GET['idVuelo'];
$idTrabajador = $_GET['idTrabajador'];

$modelo = new Modelo();
$result = $modelo->eliminarLineaTripulacion($idVuelo, $idTrabajador);

if($result != NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha eliminado el tripulante')
                    window.location.href='vuelos.php';
           </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha producido un error al eliminar el tripulante')
                    window.location.href='vuelos.php';
           </SCRIPT>");
}