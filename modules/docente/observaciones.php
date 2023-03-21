<?php
    class Observacion{

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }
        
        public function ConsultarObservacion($IdEstudiante,$valorEstudiante,$tipo,$valortipo,$Observacion,$valorObservacion){
            $response = [];
            $sql = "SELECT * FROM observaciones WHERE ".$IdEstudiante." = '".$valorEstudiante."' AND ".$tipo." = '".$valortipo."' AND ".$Observacion." = '".$valorObservacion."';";

            $resultset = $this->DB->query($sql);

            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row;
                } 
            }
            return $response;
        }

        public function ProcesarObservacion($DataPost){
            $response = [];
            $sql = "INSERT INTO observaciones (IdEstudiante,Tipo,Observacion,VersionEstudiante,Compromiso,Seguimiento)
                    VALUES(".$DataPost['idEstudiante'].",'".$DataPost['tipo']."','".$DataPost['observacion']."','".$DataPost['versionEstudiante']."','".$DataPost['compromiso']."',".$DataPost['IdDocente'].");";

            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'Se ha agregado Exitosamente'; 
            }else{
                $response['Error'] = 'Error al agregar'; 
            }

            return $response;
        }

        public function ConsultarObservacionesEstudiante($IdEstudiante){
            $response = [];
            $sql = "SELECT * FROM observaciones WHERE IdEstudiante = ".$IdEstudiante.";";

            $resultset = $this->DB->query($sql);

            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row;
                } 
            }
            return $response;
        }

        public function EditarObservacion($DataPost){
            if(!$DataPost){
                return ['error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE observaciones SET
            IdEstudiante = {$DataPost['idEstudiante']},
            Tipo = '{$DataPost['tipo']}',
            Observacion = '{$DataPost['observacion']}',
            VersionEstudiante = '{$DataPost['versionEstudiante']}',
            Compromiso = '{$DataPost['compromiso']}',
            Seguimiento = {$DataPost['seguimiento']}
            WHERE Id = {$DataPost['idObservacion']}";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'La observacion ha sido modificada.'; 
            }else{
                $response['error'] = 'La observacion no se ha modificado.'; 
            }

            return $response;
        }

        public function EliminarObservacion($IdObservacion){
            $response = [];
            if(!$IdObservacion){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            $sql = "DELETE FROM observaciones WHERE Id = {$IdObservacion};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'La Observacion se ha eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar la Observacion.';
            }

            return $response;
        }
    }
?>