<?php
    class Estudiantes
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarEstudiantesGrado($Filtro = false){
            $response = [];
            $sql = "SELECT E.*, A.NombresAcudiente, A.ApellidosAcudiente 
                    FROM estudiantes E
                    INNER JOIN acudientes A ON A.IdAcudiente = E.idAcudiente";
            if($Filtro){
                $sql .= " WHERE GradoEstudiante= {$Filtro['grado']}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function consultarGradoEstudiante($Filtro = false){
            $response = [];
            $sql = "SELECT E.*, A.NombresAcudiente, A.ApellidosAcudiente 
                    FROM estudiantes E
                    INNER JOIN acudientes A ON A.IdAcudiente = E.idAcudiente";
            if($Filtro){
                $sql .= " WHERE IdEstudiante = {$Filtro['IdEstudiante']}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarEstudiantes($Filtro = false){
            $response = [];
            $sql = "SELECT E.*, A.NombresAcudiente, A.ApellidosAcudiente 
                    FROM estudiantes E
                    INNER JOIN acudientes A ON A.IdAcudiente = E.idAcudiente";
            if($Filtro){
                $sql .= " WHERE {$Filtro}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }
        
        public function ConsultarEstudiante($numeroDocumento, $ValorDocumento,$tipoDocumento,$ValorTD){
            $response = [];
            $sql = "SELECT * FROM estudiantes WHERE {$numeroDocumento} = {$ValorDocumento} AND {$tipoDocumento} = '{$ValorTD}'";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ProcesarEstudiante($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han ingresado datos'];
            }

            $sql = "INSERT INTO estudiantes (NombresEstudiante,apellidosEstudiante,tipoDocumentoEstudiante,NDocumentoEstudiante,FechaNacimientoEstudiante,Estato,GradoEstudiante,idAcudiente)
                    VALUES('".$DataRow['nombreE']."','".$DataRow['apellidoE']."','".$DataRow['listaDocumentosE']."','".$DataRow['documentoE']."','".$DataRow['fechaNE']."',".$DataRow['statusE'].",".$DataRow['listaGrados'].",'".$DataRow['listaAcudientes']."');";
            
            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha realizado la matricula Exitosamente';
            }else{
                $response['error'] = 'Error al realizar la matricula.';
            }
            
            return $response;
        }

        public function EliminarEstudiante($DocumentoEstudiante = false){
            $response = [];
            if(!$DocumentoEstudiante){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            $sql = "DELETE  FROM estudiantes WHERE NDocumentoEstudiante = {$DocumentoEstudiante};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'El estudiante ha sido eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar al estudiante.';
            }

            return $response;
        }

        public function EditarEstudiante($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado datos'];
            }

            $sql = "UPDATE estudiantes SET
            NombresEstudiante = '".$DataRow['nombreE']."',
            apellidosEstudiante = '".$DataRow['apellidoE']."',
            tipoDocumentoEstudiante = '".$DataRow['listaDocumentosE']."',
            NDocumentoEstudiante = ".$DataRow['documentoE'].",
            FechaNacimientoEstudiante = '".$DataRow['fechaNE']."',
            Estado = '".$DataRow['statusE']."',
            GradoEstudiante = ".$DataRow['listaGrados'].",
            idAcudiente = '".$DataRow['listaAcudientes']."'
            WHERE IdEstudiante= ".$DataRow['idEstudiante'].";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado exitosamente los datos de '.$DataRow['nombreE'].' '.$DataRow['apellidoE'].'.';
            }else{
                $response['error'] = 'Lo sentimos, error al actualizar los datos de '.$DataRow['nombreE'].' '.$DataRow['apellidoE'].'.';
            }

            return $response;
        }
    }      
?>