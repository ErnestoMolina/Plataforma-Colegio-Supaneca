<?php
    class Observaciones{
        private $ObservacionesModel;

        public function __construct(){
            include_once '../../../modules/docente/observaciones.php';

            $this->ObservacionesModel = new Observacion();
        }
        
        public function ProcesarObservaciones($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            
            if(isset($DataPost['idEstudiante'])){
                $DataResponse = $this->ObservacionesModel->ProcesarObservacion($DataPost);
            }
                
            return $DataResponse;
        }

        public function ConsultarObservacionesEstudiante($IdEstudiante){
            if(!$IdEstudiante){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            return $this->ObservacionesModel->ConsultarObservacionesEstudiante($IdEstudiante);
        }

        public function EditarObservacion($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }

            if(isset($DataPost['idEstudiante'])){
                $DataResponse = $this->ObservacionesModel->EditarObservacion($DataPost);
            }
                
            return $DataResponse;
        }

        public function EliminarObservacion($IdObservacion){
            if(!$IdObservacion){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }

            return $this->ObservacionesModel->EliminarObservacion($IdObservacion);
        }
    }