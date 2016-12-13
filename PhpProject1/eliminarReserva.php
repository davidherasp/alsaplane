<?php
session_start();
include("modelo.php");

$idVuelo = $_GET['idVuelo'];
$dni = $_SESSION['dni'];

echo '--->'.$idVuelo.'-',$dni;
$modelo = new Modelo();
$result = $modelo->eliminarReserva($dni,$idVuelo);

if($result != NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha eliminado la reserva')
                    window.location.href='micuenta.php';
            </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha producido un error al eliminar la reserva')
                    window.location.href='micuenta.php';
            </SCRIPT>");
}