<?php
    class Docente
    {
        private $DocentesModel;

            public function __construct(){
                include_once '../../../modules/admin/docentes.php';
                $this->DocentesModel = new Docentes();
            }

        public function ConsultarDocentes($Filtro,$Campos){
            return $this->DocentesModel->ConsultarDocentes($Filtro,$Campos);
        }

        public function consultarDocenteMateria($id){
            return $this->DocentesModel->consultarDocenteMateria('IdDocente',$id);
        }

        public function ProcesarDocente($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }

            if(isset($DataPost['documentoD'])){
                // validamos si el documento del docente ya existe
                // $InfoDocente = $this->DocentesModel->ConsultarDocente('NDocumentoDocente', $DataPost['documentoD'],'TipoDocumentoDocente',$DataPost['listaDocumentosD']);
                $InfoDocenteDocumento = $this->DocentesModel->ConsultarDocente('WHERE NDocumentoDocente = "'.$DataPost['documentoD'].'" AND TipoDocumentoDocente = "'.$DataPost['listaDocumentosD'].'"');
                $InfoAcudienteEmail = $this->DocentesModel->ConsultarAcudienteEditar('WHERE CorreoElectronicoAcudiente = "'.$DataPost['emailD']);
                $InfoDocenteEmail = $this->DocentesModel->ConsultarDocente('WHERE CorreoElectronicoDocente = "'.$DataPost['emailD'].'"');
                $InfoAdminEmail = $this->DocentesModel->ConsultarCorreoAdmin('WHERE CorreoElectronicoAdministrador = "'.$DataPost['emailD'].'"');
                // print_r($InfoDocenteDocumento);
                // echo '<br>';
                // print_r($InfoAcudienteEmail);
                // echo '<br>';
                // print_r($InfoDocenteEmail);
                // echo'<br>';
                // print_r($InfoAdminEmail);die;
                if(empty($InfoDocenteDocumento) && empty($InfoAcudienteEmail) && empty($InfoDocenteEmail) && empty($InfoAdminEmail)){
                    $DataResponse = $this->DocentesModel->ProcesarDocente($DataPost);
                }elseif(!empty($InfoDocenteDocumento)){
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe'];
                }elseif(!empty($InfoAcudienteEmail) || !empty($InfoDocenteEmail) || !empty($InfoAdminEmail)){
                    $DataResponse = ['error' => 'Lo sentimos, el correo electronico ya esta siendo usado.'];
                }
            }

            return $DataResponse;
        }

        public function EliminarDocente($IdDocente = false){
            if(!$IdDocente){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            return $this->DocentesModel->EliminarDocente($IdDocente);
        }

        public function EditarDocente($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['idDocente'])){
                // validamos si el documento del Docente ya existe
                $InfoDocenteDocumento = $this->DocentesModel->ConsultarDocente('WHERE NDocumentoDocente = "'.$DataPost['documentoD'].'" AND TipoDocumentoDocente = "'.$DataPost['listaDocumentosD'].'" AND IdDocente NOT LIKE '.$DataPost['idDocente']);
                $InfoAcudienteEmail = $this->DocentesModel->ConsultarAcudienteEditar('WHERE CorreoElectronicoAcudiente = "'.$DataPost['emailD'].'"');
                $InfoDocenteEmail = $this->DocentesModel->ConsultarDocente('WHERE CorreoElectronicoDocente = "'.$DataPost['emailD'].'" AND IdDocente NOT LIKE '.$DataPost['idDocente']);
                $InfoAdminEmail = $this->DocentesModel->ConsultarCorreoAdmin('WHERE CorreoElectronicoAdministrador = "'.$DataPost['emailD'].'"');
                // print_r($InfoDocenteDocumento);
                // echo '<br>';
                // print_r($InfoAcudienteEmail);
                // echo '<br>';
                // print_r($InfoDocenteEmail);
                // echo'<br>';
                // print_r($InfoAdminEmail);die;
                if(empty($InfoDocenteDocumento) && empty($InfoAcudienteEmail) && empty($InfoDocenteEmail) && empty($InfoAdminEmail)){
                    $DataResponse = $this->DocentesModel->EditarDocente($DataPost);
                }elseif(!empty($InfoDocenteDocumento)){
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe'];
                }elseif(!empty($InfoAcudienteEmail) || !empty($InfoDocenteEmail) || !empty($InfoAdminEmail)){
                    $DataResponse = ['error' => 'Lo sentimos, el correo electronico ya esta siendo usado.'];
                }
            }

            return $DataResponse;
            // print_r($DataResponse);
        }
        public function EditarDocentePerfil($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['idDocente'])){
                // validamos si el documento del Docente ya existe
                $InfoDocenteDocumento = $this->DocentesModel->ConsultarDocente('WHERE NDocumentoDocente = "'.$DataPost['documentoD'].'" AND TipoDocumentoDocente = "'.$DataPost['listaDocumentosD'].'" AND IdDocente NOT LIKE '.$DataPost['idDocente']);
                $InfoAcudienteEmail = $this->DocentesModel->ConsultarAcudienteEditar('WHERE CorreoElectronicoAcudiente = "'.$DataPost['emailD'].'"');
                $InfoDocenteEmail = $this->DocentesModel->ConsultarDocente('WHERE CorreoElectronicoDocente = "'.$DataPost['emailD'].'" AND IdDocente NOT LIKE '.$DataPost['idDocente']);
                $InfoAdminEmail = $this->DocentesModel->ConsultarCorreoAdmin('WHERE CorreoElectronicoAdministrador = "'.$DataPost['emailD'].'"');
                // print_r($InfoDocenteDocumento);
                // echo '<br>';
                // print_r($InfoAcudienteEmail);
                // echo '<br>';
                // print_r($InfoDocenteEmail);
                // echo'<br>';
                // print_r($InfoAdminEmail);die;
                if(empty($InfoDocenteDocumento) && empty($InfoAcudienteEmail) && empty($InfoDocenteEmail) && empty($InfoAdminEmail)){
                    $DataResponse = $this->DocentesModel->EditarDocentePerfil($DataPost);
                }elseif(!empty($InfoDocenteDocumento)){
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe'];
                }elseif(!empty($InfoAcudienteEmail) || !empty($InfoDocenteEmail) || !empty($InfoAdminEmail)){
                    $DataResponse = ['error' => 'Lo sentimos, el correo electronico ya esta siendo usado.'];
                }
            }

            return $DataResponse;
            // print_r($DataResponse);
        }
    }
?>