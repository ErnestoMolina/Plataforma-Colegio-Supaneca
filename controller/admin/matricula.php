<?php
    class Estudiante
    {
        private $EstudiantesModel;

            public function __construct(){
                include_once '../../../modules/admin/estudiantes.php';
                $this->EstudiantesModel = new Estudiantes();
            }

        public function ConsultarEstudiantes(){
            return $this->EstudiantesModel->ConsultarEstudiantes();
        }

        public function ConsultarEstudiantesGrado(){
            return $this->EstudiantesModel->ConsultarEstudiantesGrado();
        }

        public function ProcesarEstudiante($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }

            if(isset($DataPost['documentoE'])){
                // validamos si el documento del estudiante ya existe
                $InfoEstudiante = $this->EstudiantesModel->ConsultarEstudiante('NDocumentoEstudiante', $DataPost['documentoE'],'TipoDocumentoEstudiante',$DataPost['listaDocumentosE']);

                if(!$InfoEstudiante){
                    $DataResponse = $this->EstudiantesModel->ProcesarEstudiante($DataPost);
                }else{
                    $DataResponse = ['error' => 'El numero de documento ya existe.'];
                }
            }

            return $DataResponse;
        }

        public function EliminarEstudiante($documentoEstudiante = false){
            if(!$documentoEstudiante){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            return $this->EstudiantesModel->EliminarEstudiante($documentoEstudiante);
        }

        public function EditarEstudiante($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['idEstudiante'])){
                // validamos si el documento del estudiante ya existe
                $InfoEstudiante = $this->EstudiantesModel->ConsultarEstudiante('IdEstudiante', $DataPost['idEstudiante']);

                if($InfoEstudiante){
                    $DataResponse = $this->EstudiantesModel->EditarEstudiante($DataPost);
                }else{
                    $DataResponse = ['error' => 'Lo sentimos, el numero de documento ya existe.'];
                }
            }

            return $DataResponse;
        }
    }
?>