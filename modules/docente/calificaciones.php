<?php
    class Calificacion{

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }
        
        public function consultarGradosMateria($DataPost){
            $response = [];
            $response2 = [];

            $sql2 = "SELECT * FROM materias WHERE IdMateria = {$DataPost['materia']}";
            $resultset2 = $this->DB->query($sql2);
            
            if($resultset2){
                while ($row = $resultset2->fetch_assoc()) {
                    $response2[] = $row;
                }
            }
            foreach($response2 as $nombre){
                $sql = 'SELECT * FROM grados WHERE '.$nombre['NombreMateria'].' = '.$DataPost['IdUser'].'';
            


            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }
        }
            return $response;
            
        }

        public function consultarPlantillaGrado($DataPost){
            
            // $response = [];
            // $sql = 'SELECT * FROM grados WHERE '.$DataPost['materia'].' = '.$DataPost['IdUser'].'';

            // $resultset = $this->DB->query($sql);

            // if($resultset){
            //     while ($row = $resultset->fetch_assoc()) {
            //         $response[] = $row;
            //     }
            // }

            // return $response;
        }
    }
?>