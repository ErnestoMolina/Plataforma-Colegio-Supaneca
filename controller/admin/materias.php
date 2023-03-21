<?php
    class Materia{
        private $MateriasModel;

        public function __construct(){
            include_once '../../../modules/admin/materias.php';
            include_once '../../../modules/admin/docentes.php';
            $this->MateriasModel = new Materias();
            $this->DocentesModel = new Docentes();
        }

        public function ConsultarMaterias(){
            return $this->MateriasModel->ConsultarMaterias();
        }

        public function ConsultarMateria($Campo, $Valor){
            return $this->MateriasModel->ConsultarMateria($Campo, $Valor);
        }

        public function ProcesarMateria($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }

            if(isset($DataPost['nombreM'])){
                // validamos si la materia ya existe
                $InfoMateria = $this->MateriasModel->ConsultarMateria('NombreMateria', $DataPost['nombreM']);

                if(!$InfoMateria){
                    $DataResponse = $this->MateriasModel->ProcesarMateria($DataPost);
                }else{
                    $DataResponse = ['error' => 'La materia ya existe.'];
                }
            }

            return $DataResponse;
        }

        public function validarDocentesAsociados($IdMateria = false){
            if(!$IdMateria){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            $Filtro = "idMateria LIKE '%";
            $Filtro .= '"'.$IdMateria.'"%';
            $Filtro .= "'";
            return $this->DocentesModel->ConsultarDocentes($Filtro);
        }

        public function EliminarMateria($IdMateria = false){
            if(!$IdMateria){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            return $this->MateriasModel->EliminarMateria($IdMateria);
        }

        public function EditarMateria($DataPost = false){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['nombreM'])){
                // validamos si la materia ya existe
                $InfoMateria = $this->MateriasModel->ConsultarMateria('NombreMateria', $DataPost['nombreM']);

                if(!$InfoMateria){
                    $DataResponse = $this->MateriasModel->EditarMateria($DataPost);
                }else{
                    $DataResponse = ['error' => 'Lo sentimos, la materia ya existe.'];
                }
            }

            return $DataResponse;
        }
    }
?>