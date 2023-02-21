<?php
    class Materias
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarMaterias(){
            $response = [];
            $sql = "SELECT * FROM materias";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarMateria($Campo, $Valor){
            $response = [];
            $sql = "SELECT * FROM materias WHERE {$Campo} = '{$Valor}'";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ProcesarMateria($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han ingresado datos'];
            }

            $sql = "INSERT INTO materias (NombreMateria)
                    VALUES('".$DataRow['nombreM']."');";
            
            $sql2 = "ALTER TABLE grados ADD ".$DataRow['nombreM']." INT(10)";
            
            $resultset = $this->DB->query($sql);
            $resultset2 = $this->DB->query($sql2);
            if($resultset === true && $resultset2 === true){
                $response['success'] = 'Se ha agregado Exitosamente';
            }else{
                $response['Error'] = 'Error al agregar.';
            }

            return $response;
        }

        public function EliminarMateria($IdMateria = false){
            $response = [];
            if(!$IdMateria){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            
            $sql = "DELETE  FROM materias WHERE idMateria = '{$IdMateria}';";
            
            $sql2 = "SELECT NombreMateria FROM materias WHERE idMateria = '".$IdMateria."'";

            $resultset2 = $this->DB->query($sql2);
            if($resultset2){
                while ($row = $resultset2->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            foreach( $response as $dato){
                $dato['NombreMateria'];
            }

            $sql3 = "ALTER TABLE grados DROP ".$dato['NombreMateria']."";
            
            $resultset = $this->DB->query($sql);
            $resultset3 = $this->DB->query($sql3);
            if($resultset === true && $resultset3 === true){
                $response['success'] = 'La materia ha sido eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar la materia.';
            }

            return $response;
        }

        public function EditarMateria($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE materias SET
            NombreMateria = '".$DataRow['nombreM']."'
            WHERE IdMateria = ".$DataRow['idMateria'].";";

            $sql3 = "SELECT NombreMateria FROM materias WHERE IdMateria = ".$DataRow['idMateria']."";

            $resultset3 = $this->DB->query($sql3);
            if($resultset3){
                while ($row = $resultset3->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            foreach( $response as $dato){
                $dato['NombreMateria'];
            }
            
            
            $sql2 = "ALTER TABLE grados CHANGE ".$dato['NombreMateria']." ".$DataRow['nombreM']."  INT(10)";

            $resultset = $this->DB->query($sql);
            $resultset2 = $this->DB->query($sql2);
            if($resultset === true && $resultset2 === true){
                $response['success'] = 'Se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, la materia ya existe.';
            }

            return $response;
        }
    }
?>