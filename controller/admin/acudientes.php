<?php
    class Acudiente{
        private $AcudientesModel;
        private $EstudiantesModel;

        public function __construct(){
            include_once '../../../modules/admin/acudientes.php';
            include_once '../../../modules/admin/estudiantes.php';
            $this->AcudientesModel = new Acudientes();
            $this->EstudiantesModel = new Estudiantes();
        }

        public function ConsultarAcudientes(){
            return $this->AcudientesModel->ConsultarAcudientes();
        }

        public function ConsultarAcudientePerfil($DataPost){
            return $this->AcudientesModel->ConsultarAcudientePerfil($DataPost);
        }

        public function ConsultarAcudiente(){
            return $this->AcudientesModel->ConsultarAcudiente();
        }

        public function ProcesarAcudiente($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }

            if(isset($DataPost['documentoA'])){
                // validamos si el documento del acudiente ya existe
                $InfoAcudienteDocumento = $this->AcudientesModel->ConsultarAcudienteEditar('WHERE NDocumentoAcudiente = "'.$DataPost['documentoA'].'" AND TipoDocumentoAcudiente = "'.$DataPost['listaDocumentosA'].'"');
                $InfoAcudienteEmail = $this->AcudientesModel->ConsultarAcudienteEditar('WHERE CorreoElectronicoAcudiente = "'.$DataPost['emailA'].'"');
                $InfoDocenteEmail = $this->AcudientesModel->ConsultarCorreoDocente('WHERE CorreoElectronicoDocente = "'.$DataPost['emailA'].'"');
                $InfoAdminEmail = $this->AcudientesModel->ConsultarCorreoAdmin('WHERE CorreoElectronicoAdministrador = "'.$DataPost['emailA'].'"');
                // print_r($InfoAcudienteDocumento);
                // print_r($InfoAcudienteEmail);
                // print_r($InfoDocenteEmail);
                // print_r($InfoAdminEmail);die;
                if(empty($InfoAcudienteDocumento) && empty($InfoAcudienteEmail) && empty($InfoDocenteEmail) && empty($InfoAdminEmail)){
                    $DataResponse = $this->AcudientesModel->ProcesarAcudiente($DataPost);
                }elseif(!empty($InfoAcudienteDocumento)){
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }elseif(!empty($InfoAcudienteEmail) || !empty($InfoDocenteEmail) || !empty($InfoAdminEmail)){
                    $DataResponse = ['error' => 'Lo sentimos, el correo electronico ya esta siendo usado.'];
                }
            }

            return $DataResponse;
        }

        public function validarEstudiantesAsociados($IdAcudiente = false){
            if(!$IdAcudiente){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            $Filtro = "E.idAcudiente = {$IdAcudiente}";
            return $this->EstudiantesModel->ConsultarEstudiantes($Filtro);
        }

        public function EliminarAcudiente($IdAcudiente = false){
            if(!$IdAcudiente){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            return $this->AcudientesModel->EliminarAcudiente($IdAcudiente);
        }

        public function EditarAcudiente($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['idAcudiente'])){
                // validamos si el documento del estudiante ya existe
                $InfoAcudienteDocumento = $this->AcudientesModel->ConsultarAcudienteEditar('WHERE NDocumentoAcudiente = "'.$DataPost['documentoA'].'" AND TipoDocumentoAcudiente = "'.$DataPost['listaDocumentosA'].'" AND IdAcudiente NOT LIKE '.$DataPost['idAcudiente']);
                $InfoAcudienteEmail = $this->AcudientesModel->ConsultarAcudienteEditar('WHERE CorreoElectronicoAcudiente = "'.$DataPost['emailA'].'" AND IdAcudiente NOT LIKE '.$DataPost['idAcudiente']);
                $InfoDocenteEmail = $this->AcudientesModel->ConsultarCorreoDocente('WHERE CorreoElectronicoDocente = "'.$DataPost['emailA'].'"');
                $InfoAdminEmail = $this->AcudientesModel->ConsultarCorreoAdmin('WHERE CorreoElectronicoAdministrador = "'.$DataPost['emailA'].'"');
                // print_r($InfoAcudienteDocumento);echo '<br>';
                // print_r($InfoAcudienteEmail);echo '<br>';
                // print_r($InfoDocenteEmail);echo '<br>';
                // print_r($InfoAdminEmail);die;
                if(empty($InfoAcudienteDocumento) && empty($InfoAcudienteEmail) && empty($InfoDocenteEmail) && empty($InfoAdminEmail)){
                    $DataResponse = $this->AcudientesModel->EditarAcudiente($DataPost);
                }elseif(!empty($InfoAcudienteDocumento)){
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }elseif(!empty($InfoAcudienteEmail) || !empty($InfoDocenteEmail) || !empty($InfoAdminEmail)){
                    $DataResponse = ['error' => 'Lo sentimos, el correo electronico ya esta siendo usado.'];
                }
            }

            return $DataResponse;
            // print_r($DataResponse);
        }
    }
?>