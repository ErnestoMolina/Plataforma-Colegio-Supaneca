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
                $InfoDocente = $this->DocentesModel->ConsultarDocente('NDocumentoDocente', $DataPost['documentoD'],'TipoDocumentoDocente',$DataPost['listaDocumentosD']);

                if(!$InfoDocente){
                    $DataResponse = $this->DocentesModel->ProcesarDocente($DataPost);
                }else{
                    $DataResponse = ['error' => 'El numero de documento ya existe.'];
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
                $InfoDocente = $this->DocentesModel->ConsultarDocente('IdDocente', $DataPost['idDocente'],'TipoDocumentoDocente',$DataPost['listaDocumentosD']);

                if($InfoDocente){
                    $DataResponse = $this->DocentesModel->EditarDocente($DataPost);
                }else{
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }
            }

            return $DataResponse;
        }
        public function EditarDocentePerfil($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['idDocente'])){
                // validamos si el documento del Docente ya existe
                $InfoDocente = $this->DocentesModel->ConsultarDocente('IdDocente', $DataPost['idDocente'],'TipoDocumentoDocente',$DataPost['listaDocumentosD']);

                if($InfoDocente){
                    $DataResponse = $this->DocentesModel->EditarDocentePerfil($DataPost);
                }else{
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }
            }

            return $DataResponse;
        }
    }
?>