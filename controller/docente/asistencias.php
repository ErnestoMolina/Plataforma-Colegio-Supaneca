<?php
    class Asistencias{
        private $InasistenciaModel;

        public function __construct(){
            include_once '../../../modules/docente/asistencias.php';

            $this->InasistenciaModel = new Asistencia();
        }

        public function ProcesarInasistencia($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            
            if(isset($DataPost['fecha'])){
                $InfoActividad = $this->InasistenciaModel->ConsultarInasistensias('Fecha',$DataPost['fecha'],'IdMateria',$DataPost['listaMaterias'],'Periodo',$DataPost['periodo'],'IdEstudiante',$DataPost['idEstudiante'],'Descripcion',$DataPost['descripcion']);
                if(!$InfoActividad){
                    $DataResponse = $this->InasistenciaModel->ProcesarInasistencia($DataPost);
                }else{
                    $DataResponse = ['error' => 'La Inasistencia ya existe.'];
                }
            }
                
            return $DataResponse;
        }

        public function consultarEstudiantes($IdGrado){
            return $DataResponse = $this->InasistenciaModel->consultarEstudiantes($IdGrado);
        }

        public function ConsultarInasistensias($campo,$filtro,$campo2,$filtro2,$campo3,$filtro3,$campo4,$filtro4,$campo5,$filtro5){
            return $DataResponse = $this->InasistenciaModel->ConsultarInasistensias($campo,$filtro,$campo2,$filtro2,$campo3,$filtro3,$campo4,$filtro4,$campo5,$filtro5);
        }

        public function ConsultarEstudiante($campo,$valor){
            return $DataResponse = $this->InasistenciaModel->ConsultarEstudiante($campo,$valor);
        }

        public function EditarInasistencia($DataPost){
            $DataResponse;
            if(!$DataPost){
                return ['error' => 'No se han ingresado datos'];
            }
            if(isset($DataPost['fecha'])){
                $InfoActividad = $this->InasistenciaModel->ConsultarInasistensias('Fecha',$DataPost['fecha'],'IdMateria',$DataPost['listaMaterias'],'Periodo',$DataPost['periodo'],'IdEstudiante',$DataPost['idEstudiante'],'Descripcion',$DataPost['descripcion']);
                if(!$InfoActividad){
                    $DataResponse = $this->InasistenciaModel->EditarInasistencia($DataPost);
                }else{
                    $DataResponse['error'] = 'La Inasistencia ya existe.';
                }
            }
            return $DataResponse;
        }

        public function EliminarInasistencia($IdInasistencia){
            if(!$IdInasistencia){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            return $this->InasistenciaModel->EliminarInasistencia($IdInasistencia);
        }
    }
?>