<?php
    class Administrador{
        private $AdministradoresModel;

        public function __construct(){
            include_once '../../../modules/admin/admin.php';
            $this->AdministradoresModel = new Administradores();
        }

        public function ConsultarAdministrador($IdAdmin){
            return $this->AdministradoresModel->ConsultarAdministrador("WHERE IdAdministrador = '{$IdAdmin}'");
        } 

        public function EditarDatos($DataRow){
            $DataResponse;
            if(!$DataRow){
                return ['error' => 'No se han ingresado datos'];
            }

            if(isset($DataRow['documentoA'])){
                // validamos si el documento del acudiente ya existe
                $InfoAdminDocumento = $this->AdministradoresModel->ConsultarAdministrador('WHERE NDocumentoAdministrador = "'.$DataRow['documentoA'].'" AND TipoDocumentoAdministrador = "'.$DataRow['listaDocumentosA'].'" AND IdAdministrador NOT LIKE '.$DataRow['idAdmin']);
                $InfoAcudienteEmail = $this->AdministradoresModel->ConsultarAcudienteEditar('WHERE CorreoElectronicoAdministrador = "'.$DataRow['emailA'].'" AND IdAdministrador NOT LIKE '.$DataRow['idAdmin']);
                $InfoDocenteEmail = $this->AdministradoresModel->ConsultarCorreoDocente('WHERE CorreoElectronicoDocente = "'.$DataRow['emailA'].'"');
                $InfoAdminEmail = $this->AdministradoresModel->ConsultarAdministrador('WHERE CorreoElectronicoAdministrador = "'.$DataRow['emailA'].'"');
                // print_r($InfoAdminDocumento);echo '<br>';
                // print_r($InfoAcudienteEmail);echo '<br>';
                // print_r($InfoDocenteEmail);echo '<br>';
                // print_r($InfoAdminEmail);die;
                if(empty($InfoAdminDocumento) && empty($InfoAcudienteEmail) && empty($InfoDocenteEmail) && empty($InfoAdminEmail)){
                    $DataResponse = $this->AdministradoresModel->EditarDatos($DataRow);
                }elseif(!empty($InfoAdminDocumento)){
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }elseif(!empty($InfoAcudienteEmail) || !empty($InfoDocenteEmail) || !empty($InfoAdminEmail)){
                    $DataResponse = ['error' => 'Lo sentimos, el correo electronico ya esta siendo usado.'];
                }
            }

            return $DataResponse;
        }
    }
?>