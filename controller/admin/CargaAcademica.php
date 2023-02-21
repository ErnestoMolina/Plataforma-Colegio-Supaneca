<?php
    class CargaAcademica{
        // private $AcudientesModel;
        private $CargaAcademicaModel;

        public function __construct(){
            // include_once '../../../modules/admin/acudientes.php';
            include_once '../../../modules/admin/CargaAcademica.php';
            // $this->AcudientesModel = new Acudientes();
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

        // public function ConsultarAcudiente(){
        //     return $this->AcudientesModel->ConsultarAcudiente();
        // }

        // public function ProcesarAcudiente($DataPost = false){
        //     $DataResponse;
        //     if(!$DataPost){
        //         return ['error' => 'No se han ingresado datos'];
        //     }

        //     if(isset($DataPost['documentoA'])){
        //         // validamos si el documento del acudiente ya existe
        //         $InfoAcudiente = $this->AcudientesModel->ConsultarAcudiente('NDocumentoAcudiente', $DataPost['documentoA'],'TipoDocumentoAcudiente',$DataPost['listaDocumentosA']);

        //         if(!$InfoAcudiente){
        //             $DataResponse = $this->AcudientesModel->ProcesarAcudiente($DataPost);
        //         }else{
        //             $DataResponse = ['error' => 'El numero de documento ya existe.'];
        //         }
        //     }

        //     return $DataResponse;
        // }

        // public function validarEstudiantesAsociados($IdAcudiente = false){
        //     if(!$IdAcudiente){
        //         return ['error' => 'Error en la peticion intente nuevamente.'];
        //     }

        //     $Filtro = "E.idAcudiente = {$IdAcudiente}";
        //     return $this->EstudiantesModel->ConsultarEstudiantes($Filtro);
        // }

        // public function EliminarAcudiente($IdAcudiente = false){
        //     if(!$IdAcudiente){
        //         return ['error' => 'Error en la peticion intente nuevamente.'];
        //     }

        //     return $this->AcudientesModel->EliminarAcudiente($IdAcudiente);
        // }

        public function EditarCargaAcademica($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }else{
                $DataResponse = $this->CargaAcademicaModel->EditarCargaAcademica($DataPost);
            }
            

            return $DataResponse;
        }
    }
?>