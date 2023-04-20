<?php
    class Boletin
    {
        private $EstudiantesModel;

            public function __construct(){
                include_once '../../../modules/admin/boletines.php';
                $this->BoletinModel = new Boletines();
            }

        public function ConsultarBoletinPeriodo($DataPost){
            if($DataPost){
                $response = $this->BoletinModel->ConsultarBoletinPeriodo($DataPost);
            }else{
                $response = ['error' => 'Error en la petición'];
            }

            return $response;
        }

        public function ConsultarBoletinFinal($DataPost){
            if($DataPost){
                $response = $this->BoletinModel->ConsultarBoletinFinal($DataPost);
            }else{
                $response = ['error' => 'Error en la petición'];
            }

            return $response;
        }

        public function ConsultarDocenteMateriaGrado($DataPost){
            if($DataPost){
                $response = $this->BoletinModel->ConsultarDocenteMateriaGrado($DataPost);
            }else{
                $response = ['error' => 'Error en la petición'];
            }

            return $response;
        }

        public function ConsultarDocente($DataPost){
            if($DataPost){
                $response = $this->BoletinModel->ConsultarDocente($DataPost);
            }else{
                $response = ['error' => 'Error en la petición'];
            }

            return $response;
        }
    }
?>