<?php
     class Actividad{

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function consultarGrados(){
            $response = [];
            $sql = "SELECT * FROM grados";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarActividad($NombreActividad,$valorNombre,$IdGrado,$valorGrado,$IdMateria,$valorMateria,$Descripcion,$valorDescripcion,$Periodo,$valorPeriodo){
            $response = [];
            $sql = "SELECT * FROM actividades WHERE ".$NombreActividad." = '".$valorNombre."' AND ".$IdGrado." = '".$valorGrado."' AND ".$IdMateria." = '".$valorMateria."' AND ".$Descripcion." = '".$valorDescripcion."' AND ".$Periodo." = '".$valorPeriodo."';";

            $resultset = $this->DB->query($sql);

            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row;
                } 
            }
            return $response;
        }

        public function ProcesarActividad($DataPost){
            $response = [];
            $sql = "INSERT INTO actividades (IdGrado,IdMateria,Nombre,Descripcion,Periodo)
                    VALUES('".$DataPost['listaGrados']."','".$DataPost['listaMaterias']."','".$DataPost['nombreA']."','".$DataPost['descripcion']."','".$DataPost['periodo']."');";

            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'Se ha agregado Exitosamente'; 
            }else{
                $response['Error'] = 'Error al agregar'; 
            }

            return $response;
        }

        public function EditarActividad($DataPost){
            $response = [];
            if(!$DataPost){
                return ['error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE actividades SET
            IdGrado = '{$DataPost['listaGrados']}',
            IdMateria = '{$DataPost['listaMaterias']}',
            Nombre = '{$DataPost['nombreA']}',
            Descripcion = '{$DataPost['descripcion']}',
            Periodo = '{$DataPost['periodo']}'
            WHERE Id = {$DataPost['idActividad']}";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'La actividad ha sido modificada.'; 
            }else{
                $response['error'] = 'La actividad no se ha modificado.'; 
            }

            return $response;
        }

        public function ConsultarActividades($DataPost = false){
            $response = [];
            $sql = "SELECT * FROM actividades";
            if($DataPost){
                $sql .= " WHERE IdMateria = {$DataPost['materia']} AND Periodo = {$DataPost['periodo']} AND IdGrado = {$DataPost['ListaGrados']}";
            }

            $resultset = $this->DB->query($sql);
            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row; 
                }
            }
            return $response;
        }

        public function consultarGrado($Campo, $Filtro = false){
            $response = [];
            $sql = "SELECT * FROM grados";

            if($Filtro){
                $sql .= " WHERE {$Campo} = {$Filtro}";
            }
            
            $resultset = $this->DB->query($sql);
            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row; 
                }
            }
            return $response;
        }

        public function EliminarActividad($IdActividad){
            $response = [];
            if(!$IdActividad){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            $sql = "DELETE FROM actividades WHERE Id = {$IdActividad};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'La actividad se ha eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar la actividad.';
            }

            return $response;
        }
    }
?>