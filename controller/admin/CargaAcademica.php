<?php
    class CargaAcademica{
        private $CargaAcademicaModel;

        public function __construct(){
            include_once '../../../modules/admin/CargaAcademica.php';
            $this->CargaAcademicaModel = new AsignacionAcademica();
        }

        public function ConsultarMaterias(){
            return $this->CargaAcademicaModel->ConsultarMaterias();
        }

        public function ConsultaGrados(){
            return $this->CargaAcademicaModel->ConsultaGrados();
        }

        public function ConsultaDocentes($Materia){
            return $this->CargaAcademicaModel->ConsultaDocentes($Materia);
        }

        public function ConsultaDocentesID($IdDocente){
            return $this->CargaAcademicaModel->ConsultaDocentesID($IdDocente);
        }

        public function EditarCargaAcademica($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }else{
                $DataResponse = $this->CargaAcademicaModel->EditarCargaAcademica($DataPost);
            }

            return $DataResponse;
        }

        public function ConsultarDirectores($DataPost){
            if($DataPost){
                $InfoDirector = $this->CargaAcademicaModel->ConsultarDirectores($DataPost);
                // return print_r($InfoDirector);die;
                if($InfoDirector){
                    $Info = $this->CargaAcademicaModel->ConsultarDirectoresGrado($DataPost);
                    if($Info){
                        $response = ['permitir' => 'Docente ya Asignado a este grado.'];
                    }else{
                        $response = ['error' => 'El docente ya se encuentra asignado en otro grado como director.'];
                    }
                }else{
                    $response = ['success' => 'Asignacion valida.'];
                }
            }else{
                $response = ['error' => 'Error en la petición.'];
            }
            return $response;
        }
    }
?>