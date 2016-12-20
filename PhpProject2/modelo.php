<?php

class Modelo{

            //Variables
            private $conexion; //Para conectarme a la base de datos

            //Constructor
            public function __construct(){}

            //Destructor
            public function __destruct(){}

            //Funcion para conectar y desconectarme a la base de datos que las voy necesitar todo el rato
            public function open()
            {
                   $this->conexion=  mysqli_connect("localhost:3306","root") or die (msql_error());
                   mysqli_select_db($this->conexion, 'alsaplane') or die (msql_error());
            }


            //Funcion para cerrar la conexion
            public function close(){
                    
                    if(isset($this->conexion))//Compruebo que haya alguna conexion
                    {       
                            mysqli_close($this->conexion) or die (msql_error());//Si la hay, la cierro
                    }
            }//Function close

            public function selectVuelos(){
                
                $this->open();
                $consulta="SELECT idVuelo,idAvion,origen,destino,fechaVuelo,precioV FROM vuelos";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nfilas = mysqli_num_rows($rs);
                
                if($nfilas != 0){
                    
                    $vuelos = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $vuelos[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $vuelos;
                
                }else{
                        
                    $this->close();
                    return NULL;
                }
            }
            
            public function selectReservas(){
                
                $this->open();
                $consulta="SELECT idVuelo, idCliente, precioR, asiento FROM reservas";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nfilas = mysqli_num_rows($rs);
                
                if($nfilas != 0){
                    
                    $reservas = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $reservas[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $reservas;
                
                }else{
                        
                    $this->close();
                    return NULL;
                }
            }
            
            public function selectAviones(){
                $this->open();
                $consulta="SELECT idAvion, modelo, numAsientos FROM aviones";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nfilas = mysqli_num_rows($rs);
                
                if($nfilas != 0){
                    
                    $aviones = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $aviones[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $aviones;
                
                }else{
                        
                    $this->close();
                    return NULL;
                }
            }
            
            public function selectEmpleados(){
                $this->open();
                $consulta="SELECT idTrabajador, nombreTra, apellidosTra, fechaNacTra, rolTra FROM trabajadores";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nfilas = mysqli_num_rows($rs);
                
                if($nfilas != 0){
                    
                    $empleados = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $empleados[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $empleados;
                
                }else{
                        
                    $this->close();
                    return NULL;
                }
            }
            
            public function selectClientes(){
                $this->open();
                $consulta="SELECT dni, nombreCli, fechaNacCli, emailCli, tipoCli, password FROM clientes";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nfilas = mysqli_num_rows($rs);
                
                if($nfilas != 0){
                    
                    $clientes = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $clientes[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $clientes;
                
                }else{
                        
                    $this->close();
                    return NULL;
                }
            }
            
            public function selectTripulacion($idVuelo)
            {
                $this->open();
                $consulta=" SELECT idTrabajador, nombreTra, rolTra FROM trabajadores 
                            WHERE idTrabajador IN (SELECT idTrabajador FROM lineatripulacion 
                            WHERE idVuelo= '$idVuelo'); ";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nfilas = mysqli_num_rows($rs);
                
                if($nfilas != 0){
                    
                    $result = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $result[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $result;
                }else{
                        
                    $this->close();
                    return NULL;
                }
            }
            
            public function eliminarLineaTripulacion($idVuelo, $idTrabajador)
            {
                $this->open();
                
                $consulta = "DELETE FROM lineatripulacion WHERE lineatripulacion.idTrabajador = $idTrabajador AND lineatripulacion.idVuelo = '$idVuelo'";
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();

                if ($result){
                    return $result;
                }else{
                    return NULL;
                }
            }
            
            public function eliminarVuelo($idVuelo)
            {
                $this->open();
                
                $consulta1="DELETE FROM lineatripulacion WHERE lineatripulacion.idVuelo = '$idVuelo'";
                $consulta2="DELETE FROM VUELOS WHERE (idVuelo LIKE '$idVuelo')";
                
                $result=mysqli_query($this->conexion,$consulta1);
                $result=mysqli_query($this->conexion,$consulta2);
                $this->close();
                
                if ($result){
                    return $result;
                }else{
                    return NULL;
                } 
            }  
            
            public function insertVuelo($idVuelo, $idAvion, $origen, $destino, $fecha, $precio1, $precio2, $tripulacion)
            {
                $this->open();

                $consulta="INSERT INTO vuelos ( idVuelo, idAvion, origen, destino, fechaVuelo, precioV )
                           VALUES ('".$idVuelo."','".$idAvion."','".$origen."','".$destino."','".$fecha."','".$precio1.".".$precio2."');";
                
                $result=mysqli_query($this->conexion,$consulta);
                
                foreach( $tripulacion as $tripulante)
                {
                    $idTrabajador = $tripulante['idTrabajador'];
                    $consulta2=" INSERT INTO lineatripulacion ( idTrabajador, idVuelo ) "
                             . " VALUES ('".$idTrabajador."', '".$idVuelo."' )          ";
                    
                    //echo $consulta2;
                    mysqli_query($this->conexion,$consulta2);
                }
                
                $this->close();
            }
            
            public function modificarVuelo($id, $fecha, $precio1, $precio2, $tripulacion)
            {
                $this->open();
                
                foreach( $tripulacion as $tripulante)
                {
                    $idTrabajador = $tripulante['idTrabajador'];
                    $consulta2=" INSERT INTO lineatripulacion ( idTrabajador, idVuelo ) "
                             . " VALUES ('".$idTrabajador."', '".$id."' )          ";

                    mysqli_query($this->conexion,$consulta2);
                }
                
                if($precio1 == "")
                {
                    $consulta="UPDATE vuelos "
                        . "SET fechaVuelo='".$fecha."' "
                        . "WHERE idVuelo='".$id."' ";
                }
                else
                {
                    $consulta="UPDATE vuelos "
                        . "SET fechaVuelo='".$fecha."', precioV='".$precio1.".".$precio2."' "
                        . "WHERE idVuelo='".$id."' ";
                }
                
//                echo $consulta;
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function eliminarReserva($idVuelo, $idCliente)
            {
                $this->open();
                
                $consulta="DELETE FROM RESERVAS WHERE (idVuelo LIKE '$idVuelo') AND (idCliente LIKE '$idCliente')";
                
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
                
                if ($result){
                    return $result;
                }else{
                    return NULL;
                } 
            }
            
            public function insertReserva($idVuelo, $idCliente, $precio1, $precio2, $asiento)
            {
                $this->open();
                
                $consulta="INSERT INTO reservas ( idVuelo, idCliente, precioR, asiento )
                           VALUES ('".$idVuelo."','".$idCliente."','".$precio1.".".$precio2."','".$asiento."');";
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function modificarReserva($idVuelo, $idCliente, $asiento)
            {
                $this->open();
                
                $consulta="UPDATE reservas "
                        . "SET asiento='".$asiento."' "
                        . "WHERE idVuelo='".$idVuelo."' AND idCliente='".$idCliente."';";
                
//                echo $consulta;
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function eliminarAvion($idAvion)
            {
                $this->open();
                
                $consulta="DELETE FROM AVIONES WHERE (idAvion LIKE '$idAvion')";
                
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
                
                if ($result){
                    return $result;
                }else{
                    return NULL;
                } 
            }
            
            public function insertAvion($modelo, $asientos)
            {
                $this->open();
                
                $consulta="INSERT INTO aviones ( modelo, numAsientos ) 
                           VALUES ('".$modelo."','".$asientos."');";

                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function modificarAvion($id, $asientos)
            {
                $this->open();
                
                $consulta="UPDATE aviones "
                        . "SET numAsientos=".$asientos." "
                        . "WHERE idAvion='".$id."' ";
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function eliminarEmpleado($idTrabajador)
            {
                $this->open();
                
                $consulta="DELETE FROM TRABAJADORES WHERE (idTrabajador LIKE '$idTrabajador')";
                
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
                
                if ($result){
                    return $result;
                }else{
                    return NULL;
                } 
            }
            
            public function insertEmpleado($nombre, $apellidos, $fechaNac, $rol)
            {
                $this->open();
                
                $consulta="INSERT INTO trabajadores ( nombreTra,apellidosTra,fechaNacTra,rolTra)
                           VALUES ('".$nombre."','".$apellidos."','".$fechaNac."','".$rol."');";
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function modificarEmpleado($id, $rol)
            {
                $this->open();
                
                $consulta="UPDATE trabajadores "
                        . "SET rolTra='".$rol."' "
                        . "WHERE idTrabajador=".$id." ";
                
//                echo $consulta;
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function loginAdmin($nombre,$clave){
                
                $this->open();
                $consulta="SELECT * FROM administrador WHERE (user LIKE '$nombre') and (password LIKE '$clave')";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                if(mysqli_num_rows($rs) != 0)
                {
                    $admin = mysqli_fetch_array($rs);
                    $this->close();
                    return $admin;
                }
                else
                {
                    $this->close();
                    return NULL;
                }
            
            }
}//class modelo

