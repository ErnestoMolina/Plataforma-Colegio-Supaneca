<?php
    class Administradores{

        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarAdministrador($nombreAdmin){
            $response = [];
            $sql = "SELECT * FROM administradores WHERE NombresAdministrador = '{$nombreAdmin}'";
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
                $response['success'] = 'Se ha actualizado Exitosamente, cierre he inicie session nuevamente.';
            }else{
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;

        }
    }
?>