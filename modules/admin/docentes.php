<?php
    class Docentes  
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();

            include_once '../../../modules/admin/materias.php';
            $this->MateriasModel = new Materias();
            
        }

        public function ConsultarDocentes($Filtro = false, $Campos = 'D.*'){
            $response = [];
            $sql = "SELECT {$Campos}
                    FROM docentes D";
            if($Filtro){
                $sql .= " WHERE {$Filtro}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            if($response != ''){
                foreach($response as &$Docente){
                    if ($Docente['idMateria'] != '') {
                        $Materias = json_decode($Docente['idMateria'], true);
                        foreach ($Materias as &$Materia) {
                            $DataMateria = $this->MateriasModel->ConsultarMateria('IdMateria', $Materia);
                            $Materia = $DataMateria[0];
                        }
                        $Docente['idMateria'] = $Materias;
                    }
                }
            }

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

        public function consultarDocenteMateria($columna, $IdDocente){
            $response = [];
            $sql2 = "SELECT D.*, M.NombreMateria 
            FROM docentes D
            INNER JOIN materias M ON D.IdMateria = M.IdMateria WHERE {$columna} = {$IdDocente}";
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
            // echo $DataRow['listaMaterias'];die;
            $Materias = json_encode($DataRow['listaMaterias']);

            $sql = "INSERT INTO docentes (NombresDocente,ApellidosDocente,tipoDocumentoDocente,NDocumentoDocente,FechaNacimientoDocente,TelefonoDocente,CorreoElectronicoDocente,ContraseñaDocente,idMateria)
                    VALUES('".$DataRow['nombreD']."','".$DataRow['apellidoD']."','".$DataRow['listaDocumentosD']."','".$DataRow['documentoD']."','".$DataRow['fechaND']."','".$DataRow['telefonoD']."','".$DataRow['emailD']."','".$contraseña."','".$Materias."');";
            
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

            $Materias = json_encode($DataRow['listaMaterias']);
            
            $sql = "UPDATE docentes SET
            NombresDocente = '".$DataRow['nombreD']."',
            ApellidosDocente = '".$DataRow['apellidoD']."',
            TipoDocumentoDocente = '".$DataRow['listaDocumentosD']."',
            NDocumentoDocente = ".$DataRow['documentoD'].",
            FechaNacimientoDocente = '".$DataRow['fechaND']."',
            TelefonoDocente = '".$DataRow['telefonoD']."',
            CorreoElectronicoDocente = '".$DataRow['emailD']."',
            ContraseñaDocente = '".$DataRow['contraseñaD']."',
            idMateria = '".$Materias."'
            WHERE IdDocente = ".$DataRow['idDocente'].";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;
        }
        
        public function EditarDocentePerfil($DataRow = false){
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
            CorreoElectronicoDocente = '".$DataRow['emailD']."'
            WHERE IdDocente = ".$DataRow['idDocente'].";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Sus datos se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;
        }
    }      
?>