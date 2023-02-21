<?php
    class conexion{
        private $server;
        private $user;
        private $pass;
        private $db;

        function conectarDB(){
            $server = 'localhost';
            $user = 'root';
            $pass = 'root';
            $db = 'plataforma';

            $conexion = new mysqli($server,$user,$pass,$db);
            if($conexion->connect_error){
                echo 'Error';
            }

            return $conexion;
        }   
    }
?>
