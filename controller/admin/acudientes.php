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
                $InfoAcudiente = $this->AcudientesModel->ConsultarAcudiente('NDocumentoAcudiente', $DataPost['documentoA'],'TipoDocumentoAcudiente',$DataPost['listaDocumentosA']);

                if(!$InfoAcudiente){
                    $DataResponse = $this->AcudientesModel->ProcesarAcudiente($DataPost);
                }else{
                    $DataResponse = ['error' => 'El numero de documento ya existe.'];
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
                $InfoAcudiente = $this->AcudientesModel->ConsultarAcudienteEditar('IdAcudiente = '.$DataPost['idAcudiente']);

                if($InfoAcudiente){
                    $DataResponse = $this->AcudientesModel->EditarAcudiente($DataPost);
                }else{
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }
            }

            return $DataResponse;
        }

        public function EditarAcudientePerfil($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['idAcudiente'])){
                // validamos si el documento del estudiante ya existe
                $InfoAcudiente = $this->AcudientesModel->ConsultarAcudienteEditar('IdAcudiente = '.$DataPost['idAcudiente']);
                // print_r($InfoAcudiente);die;
                if($InfoAcudiente){
                    $DataResponse = $this->AcudientesModel->EditarAcudientePerfil($DataPost);
                }else{
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }
            }

            return $DataResponse;
        }
    }
?>