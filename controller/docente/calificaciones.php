<?php
    class Calificaciones{
        private $CalificacionesModel;
        private $DocentesModel;

        public function __construct(){
            include_once '../../../modules/docente/calificaciones.php';
            include_once '../../../modules/admin/docentes.php';

            $this->CalificacionesModel = new Calificacion();
            $this->DocentesModel = new Docentes();
        }
        
        public function consultarGradosMateria($DataPost){
            if(!$DataPost){
               
            }else{
                // echo $DataPost['materia'];
                return $this->CalificacionesModel->consultarGradosMateria($DataPost);
            }
        }

        public function consultarMaterias($IdDocente){
            $Docentes = $this->DocentesModel->ConsultarDocentes("IdDocente = {$IdDocente}", 'D.idMateria');

            foreach($Docentes as $Materia){
                $Materias = $Materia['idMateria'];
            }

            return $Materias;
        }

        public function ProcesarCalificaciones($DataPost){
            $countExito = 0;
            foreach($DataPost['Estudiante'] as $calificacion){
                $DataRow = $calificacion;
                $DataRow['IdMateria'] = $DataPost['IdMateria'];
                $DataRow['IdGrado'] = $DataPost['IdGrado'];
                $DataRow['IdActividad'] = $DataPost['IdActividad'];
                $DataRow['IdPeriodo'] = $DataPost['IdPeriodo'];
                // $DataRow['Id'] = $DataPost['Id'];
                
                // print_r($DataRow);
                $infoCalificacion = $this->CalificacionesModel->CosultarCalificacionesRegistradas($DataRow);
                // print_r($infoCalificacion);die;
                if(!$infoCalificacion){
                    $response = $this->CalificacionesModel->ProcesarCalificaciones($DataRow);
                    
                    if(isset($response['success'])){
                        $countExito++;
                    }
                }else{
                    $DataRow['Id'] = $infoCalificacion['Id'];
                    $response = $this->CalificacionesModel->EditarCalificaciones($DataRow);
                    
                    if(isset($response['success'])){
                        $countExito++;
                    }
                }
            }
            
            if(count($DataPost['Estudiante']) == $countExito)
                return ['success' => 'Calificaciones guardadas exitosamente.'];
            else
                return ['error' => 'Error al guardar las calificaciones.'];
        }

        public function ProcesarPorcentajesActividades($DataPost){
            if($DataPost['tareas'] != '' && $DataPost['talleres'] != '' && $DataPost['evaluaciones'] != ''){
                $infoCalificacion = $this->CalificacionesModel->CosultarPorcentajesActividades($DataPost);
                // return $infoCalificacion;die;
                if(!$infoCalificacion){
                    $response = $this->CalificacionesModel->ProcesarPorcentajesActividades($DataPost);
                }else{
                    foreach($infoCalificacion as $datosporcentaje){
                        $DataPost['Id'] = $datosporcentaje['Id'];
                    }
                    $response = $this->CalificacionesModel->EditarPorcentajesActividades($DataPost);
                }

            }else{
                $response = ['error' => 'Error en la peticion, Rellene todos los campos'];
            }

            return $response;
            
        }
        
        public function ConsultarPorcentajesActividades($DataPost){
            $response = [];
            if($DataPost){
                $response = $this->CalificacionesModel->CosultarPorcentajesActividades($DataPost);
            }else{
                $response =  ['error' => 'Error en la consulta.'];
            }
            
            return $response;
        }

        public function ConsultarDefinitivasPeriodos($DataPost){
            $response = [];
            if($DataPost){
                $response = $this->CalificacionesModel->ConsultarDefinitivasPeriodos($DataPost);
            }else{
                $response =  ['error' => 'Error en la consulta.'];
            }
            
            return $response;
        }

        public function CosultarCalificaciones($DataPost){
            $response = [];
            if($DataPost){
                $response = $this->CalificacionesModel->CosultarCalificaciones($DataPost);
            }else{
                $response =  ['error' => 'Error en la consulta.'];
            }
            
            return $response;
        }

        public function CosultarCalificacionesActividades($DataPost = false){
            $response = [];
            if($DataPost){
                $response = $this->CalificacionesModel->CosultarCalificacionesActividades($DataPost);
            }else{
                $response =  ['error' => 'Error en la consulta.'];
            }
            
            return $response;
        }

        public function ConsultarObservaciones($DataPost){
            $response = [];
            if($DataPost){
                $response = $this->CalificacionesModel->ConsultarObservaciones($DataPost);
            }else{
                $response =  ['error' => 'Error en la consulta.'];
            }
            
            return $response;
        }

        public function procesarObservaciones($DataPost){
            if($DataPost['desempeño'] != ''){
                $InfoObservaciones = $this->CalificacionesModel->ConsultarObservaciones($DataPost);
                // return $infoCalificacion;die;
                if(!$InfoObservaciones){
                    $response = $this->CalificacionesModel->procesarObservaciones($DataPost);
                }else{
                    foreach($InfoObservaciones as $datosObservaciones){
                        $DataPost['Id'] = $datosObservaciones['Id'];
                    }
                    $response = $this->CalificacionesModel->EditarObservaciones($DataPost);
                }

            }else{
                $response = ['error' => 'Error en la peticion, Rellene todos los campos'];
            }

            return $response;
            
        }

        public function procesarDefinitiva($DataPost){
            if($DataPost['desempeñoDefinitiva'] != ''){
                $InfoDefinitiva = $this->CalificacionesModel->ConsultarDefinitiva($DataPost);
                // return $InfoDefinitiva;die;
                if(!$InfoDefinitiva){
                    $response = $this->CalificacionesModel->procesarDefinitva($DataPost);
                }else{
                    foreach($InfoDefinitiva as $datosDefinitiva){
                        $DataPost['Id'] = $datosDefinitiva['Id'];
                    }
                    $response = $this->CalificacionesModel->EditarDefinitiva($DataPost);
                }

            }else{
                $response = ['error' => 'Error en la peticion, Rellene todos los campos'];
            }

            return $response;
            
        }

        public function procesarDefinitivaAño($DataPost){
            if($DataPost['desempeñoDefinitiva'] != ''){
                $InfoDefinitivaAño = $this->CalificacionesModel->ConsultarDefinitivaAño($DataPost);
                // return $InfoDefinitivaAño;die;
                if(!$InfoDefinitivaAño){
                    $response = $this->CalificacionesModel->procesarDefinitivaAño($DataPost);
                }else{
                    foreach($InfoDefinitivaAño as $datosDefinitiva){
                        $DataPost['Id'] = $datosDefinitiva['Id'];
                    }
                    $response = $this->CalificacionesModel->EditarDefinitivaAño($DataPost);
                }

            }else{
                $response = ['error' => 'Error en la peticion, Rellene todos los campos'];
            }

            return $response;
            
        }

        public function DepurarCalificaciones($DataPost){
            return $this->CalificacionesModel->DepurarCalificaciones($DataPost);
        }
    }
?>