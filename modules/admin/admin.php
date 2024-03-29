<?php
    class Administradores{

        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarAdministrador($Filtro){
            $response = [];
            $sql = "SELECT * FROM administradores";
            if($Filtro){
                $sql .= " {$Filtro}";
            }
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
                $sql .= " $Filtro";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarCorreoDocente($Filtro){
            $response = [];
            $sql = "SELECT * FROM docentes";
            if($Filtro){
                $sql .= " $Filtro";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }
        
        public function EditarDatos($DataRow){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado datos'];
            }

            $sql = "UPDATE administradores SET
            NombresAdministrador = '".$DataRow['nombreA']."',
            ApellidosAdministrador = '".$DataRow['apellidoA']."',
            TipoDocumentoAdministrador = '".$DataRow['listaDocumentosA']."',
            NDocumentoAdministrador = ".$DataRow['documentoA'].",
            FechaNacimientoAdministrador = '".$DataRow['fechaNA']."',
            TelefonoAdministrador = '".$DataRow['telefonoA']."',";
            if($DataRow['contraseñaA']){
                include '../../../controller/admin/seguridad.php';
                $passEncriptada = new Seguridad();
                $contraseña = $passEncriptada->encriptarP($DataRow['contraseñaA']);
                $sql .= " Contraseña = '".$contraseña."',";
            }
            $sql .= " CorreoElectronicoAdministrador = '".$DataRow['emailA']."'
            WHERE IdAdministrador = ".$DataRow['idAdmin'].";";
            
            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Sus datos se han actualizado Exitosamente.';
            }else{
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;

        }
    }
?>