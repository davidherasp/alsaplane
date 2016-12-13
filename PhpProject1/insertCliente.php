<?php
include("registroValidate.php");
include("modelo.php");


$dni = $_POST['dni'];
$nombreCli = $_POST['nombreCli'];
$fechaNacCli = $_POST['fechaNacCli'];
$emailCli = $_POST['emailCli'];
$tipoCli = $_POST['tipoCli'];
$password = $_POST['password'];

$validar = new Validar();

$errores = $validar->validateForm($dni, $nombreCli, $fechaNacCli, $emailCli, $tipoCli, $password);

if(count($errores)==0){//Si no hay errores
            
            $modelo = new Modelo();
            $modelo->insertCliente($dni, $nombreCli, $fechaNacCli, $emailCli, $tipoCli, $password);
            $cliente = $modelo->loginCliente($dni, $password);
            $_SESSION['dni'] = $cliente['dni'];
            $_SESSION['nombreCli'] = $cliente['nombreCli'];
            $_SESSION['fechaNacCli'] = $cliente['fechaNacCli'];
            $_SESSION['emailCli'] = $cliente['emailCli'];
            $_SESSION['tipoCli'] = $cliente['tipoCli'];
            $_SESSION['password'] = $cliente['password'];

            //echo '---->'.$_SESSION['nombreCli'];
            header("Location:index.php");
}else{
    
    $validar->drawFormInsert($errores, $dni, $nombreCli, $emailCli);
    //Hubo errores de validacion
}

            
            
        
            
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

