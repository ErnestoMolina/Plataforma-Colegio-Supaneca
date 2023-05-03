<?php
    class Actividades{
        private $ActividadesModel;
        private $MateriaModel;

        public function __construct(){
            include_once '../../../modules/docente/actividades.php';
            include_once '../../../modules/admin/materias.php';

            $this->ActividadesModel = new Actividad();
            $this->MateriaModel = new Materias();
        }
        
        public function consultarMaterias(){
            return $DataRespose = $this->MateriaModel->ConsultarMaterias();
        }
        
        public function consultarMateria($Campo,$Valor){
            return $DataRespose = $this->MateriaModel->ConsultarMateria($Campo,$Valor);
        }

        public function consultarGrados(){
            return $DataRespose = $this->ActividadesModel->consultarGrados();
        }

        public function consultarGrado($Campos,$IdGrado){
            return $DataRespose = $this->ActividadesModel->consultarGrado($Campos,$IdGrado);
        }

        public function ProcesarActividad($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            
            if(isset($DataPost['nombreA'])){
                $InfoActividad = $this->ActividadesModel->ConsultarActividad('Nombre',$DataPost['nombreA'],'IdGrado',$DataPost['listaGrados'],'IdMateria',$DataPost['listaMaterias'],'Descripcion',$DataPost['descripcion'],'Periodo',$DataPost['periodo'],'TipoActividad',$DataPost['tipoActividad']);
                if(!$InfoActividad){
                    $DataResponse = $this->ActividadesModel->ProcesarActividad($DataPost);
                }else{
                    $DataResponse = ['error' => 'La actividad ya existe.'];
                }
            }
                
            return $DataResponse;
        }

        public function ConsultarActividades($DataPost){
            return $DataRespose = $this->ActividadesModel->ConsultarActividades($DataPost);
        }

        public function ConsultarActividadesDocente($DataPost){
            return $DataRespose = $this->ActividadesModel->ConsultarActividades($DataPost);
        }

        public function EditarActividad($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            
            if(isset($DataPost['nombreA'])){
                $InfoActividad = $this->ActividadesModel->ConsultarActividad('Nombre',$DataPost['nombreA'],'IdGrado',$DataPost['listaGrados'],'IdMateria',$DataPost['listaMaterias'],'Descripcion',$DataPost['descripcion'],'Periodo',$DataPost['periodo'],'TipoActividad',$DataPost['tipoActividad']);
                if(!$InfoActividad){
                    $DataResponse = $this->ActividadesModel->EditarActividad($DataPost);
                }else{
                    $DataResponse = ['error' => 'La actividad ya existe.'];
                }
            }
                
            return $DataResponse;
        }

        public function EliminarActividad($IdActividad){
            if(!$IdActividad){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            return $this->ActividadesModel->EliminarActividad($IdActividad);
        }

        public function DepurarActividades($DataPost){
            return $this->ActividadesModel->DepurarActividades($DataPost);
        }
    }
?>