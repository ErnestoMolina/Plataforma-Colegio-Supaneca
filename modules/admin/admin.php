<?php
    class Administradores{

        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarAdministrador($IdAdmin){
            $response = [];
            $sql = "SELECT * FROM administradores WHERE IdAdministrador = '{$IdAdmin}'";
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
            TelefonoAdministrador = '".$DataRow['telefonoA']."',
            CorreoElectronicoAdministrador = '".$DataRow['emailA']."'
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