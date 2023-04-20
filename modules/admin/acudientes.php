<?php
    class Acudientes
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarAcudientePerfil($Filtro = false){
            $response = [];
            $sql = "SELECT * FROM acudientes";
            if($Filtro){
                $sql .= " WHERE $Filtro;";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarAcudientes(){
            $response = [];
            $sql = "SELECT * FROM acudientes";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarAcudiente($numeroDocumento, $ValorDocumento,$tipoDocumento,$ValorTD){
            $response = [];
            $sql = "SELECT * FROM acudientes WHERE {$numeroDocumento} = {$ValorDocumento} AND {$tipoDocumento} = '{$ValorTD}'";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarAcudienteEditar($Filtro){
            $response = [];
            $sql = "SELECT * FROM acudientes";
            if($Filtro){
                $sql .= " WHERE $Filtro";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ProcesarAcudiente($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han ingresado datos'];
            }

            include '../../../controller/admin/seguridad.php';
            $passEncriptada = new Seguridad();
            $contraseña = $passEncriptada->encriptarP($DataRow['contraseñaA']);
            
            $sql = "INSERT INTO acudientes (NombresAcudiente,apellidosAcudiente,TipoDocumentoAcudiente,NDocumentoAcudiente,FechaNacimientoAcudiente,TelefonoAcudiente,CorreoElectronicoAcudiente,ContraseñaAcudiente)
                    VALUES('".$DataRow['nombreA']."','".$DataRow['apellidoA']."','".$DataRow['listaDocumentosA']."','".$DataRow['documentoA']."','".$DataRow['fechaNA']."','".$DataRow['telefonoA']."','".$DataRow['emailA']."','".$contraseña."');";
            
            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha agregado Exitosamente';
            }else{
                $response['Error'] = 'Error al agregar.';
            }

            return $response;
        }

        public function EliminarAcudiente($IdAcudiente = false){
            $response = [];
            if(!$IdAcudiente){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            
            $sql = "DELETE  FROM acudientes WHERE IdAcudiente = {$IdAcudiente};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'El acudiente ha sido eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar al acudiente.';
            }

            return $response;
        }

        public function EditarAcudiente($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE acudientes SET
            NombresAcudiente = '".$DataRow['nombreA']."',
            ApellidosAcudiente = '".$DataRow['apellidoA']."',
            TipoDocumentoAcudiente = '".$DataRow['listaDocumentosA']."',
            NDocumentoAcudiente = ".$DataRow['documentoA'].",
            FechaNacimientoAcudiente = '".$DataRow['fechaNA']."',
            TelefonoAcudiente = '".$DataRow['telefonoA']."',
            CorreoElectronicoAcudiente = '".$DataRow['emailA']."',
            ContraseñaAcudiente = '".$DataRow['contraseñaA']."'
            WHERE IdAcudiente= ".$DataRow['idAcudiente'].";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;
        }


        public function EditarAcudientePerfil($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE acudientes SET
            NombresAcudiente = '".$DataRow['nombreA']."',
            ApellidosAcudiente = '".$DataRow['apellidoA']."',
            TipoDocumentoAcudiente = '".$DataRow['listaDocumentosA']."',
            NDocumentoAcudiente = ".$DataRow['documentoA'].",
            FechaNacimientoAcudiente = '".$DataRow['fechaNA']."',
            TelefonoAcudiente = '".$DataRow['telefonoA']."',
            CorreoElectronicoAcudiente = '".$DataRow['emailA']."'
            WHERE IdAcudiente= ".$DataRow['idAcudiente'].";";

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