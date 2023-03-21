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

        public function consultarPlantillaGrado($DataPost){
            if(!$DataPost){
               
            }else{
                // echo $DataPost['materia'];
                return $this->CalificacionesModel->consultarPlantillaGrado($DataPost);
            }
        }

        public function consultarMaterias($IdDocente){
            $Docentes = $this->DocentesModel->ConsultarDocentes("IdDocente = {$IdDocente}", 'D.idMateria');

            foreach($Docentes as $Materia){
                $Materias = $Materia['idMateria'];
            }

            return $Materias;
        }

    }
?>