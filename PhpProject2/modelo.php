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
            
            public function loginCliente($dni,$clave){
                
                $this->open();
                $consulta="SELECT dni,nombreCli,fechaNacCli,emailCli,tipoCli,password FROM clientes WHERE (dni LIKE '$dni') and (password LIKE '$clave')";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                if(mysqli_num_rows($rs) != 0)
                {
                    $cliente = mysqli_fetch_array($rs);
                    $this->close();
                    return $cliente;
                
                }else
                {
                    $this->close();
                    return NULL;
                }
            
            }
            
            public function selectVuelo($idVuelo){
                
                $this->open();
                $consulta="SELECT idVuelo,idAvion,origen,destino,precioV FROM vuelos WHERE (idVuelo LIKE '$idVuelo')";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                if(mysqli_num_rows($rs) != 0)
                {
                    $vuelo = mysqli_fetch_array($rs);
                    $this->close();
                    return $vuelo;
                
                }else
                {
                    $this->close();
                    return NULL;
                }
            
            }           
            
            public function selectAsientosAvion($idAvion){
                
                $this->open();
                $consulta="SELECT modelo,numAsientos FROM aviones WHERE (idAvion LIKE '$idAvion')";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                if(mysqli_num_rows($rs) != 0)
                {
                    $avion = mysqli_fetch_array($rs);
                    $this->close();
                    return $avion;
                
                }else
                {
                    $this->close();
                    return NULL;
                }
            
            }
            
            public function selectNumerosAsientosVuelo($idVuelo){
                
                $this->open();
                $consulta="SELECT asiento FROM reservas WHERE (idVuelo LIKE '$idVuelo')";
                
                $rs =  mysqli_query($this->conexion,$consulta);
                $nReservas = mysqli_num_rows($rs);
                
                if($nReservas != 0){
                    
                    $asientosReservados = array();
                    $i=0;
                    while ($reg=mysqli_fetch_array($rs)){
                        $asientosReservados[$i]=$reg;
                        $i++;
                    }
                    
                    $this->close();
                    return $asientosReservados;
                
                }else{
                        
                    $this->close();
                    return NULL;
                }

            
            }
           
            public function insertCliente($dni, $nombreCli, $fechaNacCli, $emailCli, $tipoCli, $password){
                
                $this->open();
                $consulta="INSERT INTO clientes ( dni,       nombreCli,       fechaNacCli,       emailCli,       tipoCli,      password)
                                      VALUES ('".$dni."','".$nombreCli."','".$fechaNacCli."','".$emailCli."','".$tipoCli."','".$password."');";
                
                $result=mysqli_query($this->conexion,$consulta);
                $this->close();
                
            }
            
}//class modelo

