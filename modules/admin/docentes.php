<?php
    class Docentes  
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarDocentes($Filtro = false){
            $response = [];
            $sql = "SELECT D.*, M.NombreMateria 
                    FROM docentes D
                    INNER JOIN materias M ON D.IdMateria = M.IdMateria";
            if($Filtro){
                $sql .= " WHERE {$Filtro}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }
            // print_r($response);
            return $response;
        }
        
        public function ConsultarDocente($numeroDocumento, $ValorDocumento,$tipoDocumento,$ValorTD){
            $response = [];
            $sql = "SELECT * FROM docentes WHERE {$numeroDocumento} = {$ValorDocumento} AND {$tipoDocumento} = '{$ValorTD}'";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function consultarDocenteMateria($IdDocente,$Valorid){
            $response = [];
            $sql = "SELECT *,IdMateria FROM docentes WHERE {$IdDocente} = {$Valorid}";
            $sql2 = "SELECT D.*, M.NombreMateria 
            FROM docentes D
            INNER JOIN materias M ON D.IdMateria = M.IdMateria WHERE {$IdDocente} = {$Valorid}";
            $resultset = $this->DB->query($sql2);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ProcesarDocente($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han ingresado datos'];
            }

            
            include '../../../controller/admin/seguridad.php';
            $passEncriptada = new Seguridad();
            $contraseña = $passEncriptada->encriptarP($DataRow['contraseñaD']);

            $sql = "INSERT INTO docentes (NombresDocente,ApellidosDocente,tipoDocumentoDocente,NDocumentoDocente,FechaNacimientoDocente,TelefonoDocente,CorreoElectronicoDocente,ContraseñaDocente,idMateria)
                    VALUES('".$DataRow['nombreD']."','".$DataRow['apellidoD']."','".$DataRow['listaDocumentosD']."','".$DataRow['documentoD']."','".$DataRow['fechaND']."','".$DataRow['telefonoD']."','".$DataRow['emailD']."','".$contraseña."','".$DataRow['listaMaterias']."');";
            
            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha agregado Exitosamente';
            }else{
                $response['Error'] = 'Error al agregar.';
            }

            return $response;
        }

        public function EliminarDocente($IdDocente = false){
            $response = [];
            if(!$IdDocente){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            $sql = "DELETE  FROM docentes WHERE IdDocente = {$IdDocente};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'El docente ha sido eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar al docente.';
            }

            return $response;
        }

        public function EditarDocente($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado datos'];
            }

            $sql = "UPDATE docentes SET
            NombresDocente = '".$DataRow['nombreD']."',
            ApellidosDocente = '".$DataRow['apellidoD']."',
            TipoDocumentoDocente = '".$DataRow['listaDocumentosD']."',
            NDocumentoDocente = ".$DataRow['documentoD'].",
            FechaNacimientoDocente = '".$DataRow['fechaND']."',
            TelefonoDocente = '".$DataRow['telefonoD']."',
            CorreoElectronicoDocente = '".$DataRow['emailD']."',
            ContraseñaDocente = '".$DataRow['contraseñaD']."',
            idMateria = '".$DataRow['listaMaterias']."'
            WHERE IdDocente = ".$DataRow['idDocente'].";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;
        }
    }      
?>