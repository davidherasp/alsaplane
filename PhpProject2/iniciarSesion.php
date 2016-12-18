<?php
session_start();
include("modelo.php");

$nombre = $_POST['nombre'];
$clave = $_POST['clave'];

$modelo = new Modelo();

$admin = $modelo->loginAdmin($nombre, $clave);
if ($admin != NULL) {
    //Creo un parametro de sesion para guardar los datos
    $_SESSION['user'] = $admin['user'];
    $_SESSION['clave'] = $admin['password'];

    header("Location:index.php");
} else {
    //Muestro alert
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Nombre o clave incorrectos')
                    window.location.href='login.php';
    </SCRIPT>");
}