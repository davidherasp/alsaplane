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
            
            public function eliminarVuelo($idVuelo)
            {
                $this->open();
                
                $consulta="DELETE FROM VUELOS WHERE (idVuelo LIKE '$idVuelo')";
                
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
                
                if ($result){
                    return $result;
                }else{
                    return NULL;
                } 
            }  
            
            public function insertVuelo($idVuelo, $idAvion, $origen, $destino, $fecha, $precio1, $precio2)
            {
                $this->open();
                
                $consulta="INSERT INTO vuelos ( idVuelo, idAvion, origen, destino, fechaVuelo, precioV )
                           VALUES ('".$idVuelo."','".$idAvion."','".$origen."','".$destino."','".$fecha."','".$precio1.".".$precio2."');";
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
            }
            
            public function modificarVuelo($id, $fecha, $precio1, $precio2)
            {
                $this->open();
                
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
}//class modelo

