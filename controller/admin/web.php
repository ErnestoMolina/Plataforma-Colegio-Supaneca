<?php
    class Web{
        private $WebModel;
        private $EstudiantesModel;

        public function __construct(){
            include_once '../../../modules/admin/web.php';
            $this->WebModel = new GestionPagina();
        }

        public function ConsultarImagenes(){
            return $this->WebModel->ConsultarImagenes();
        }

        public function ConsultarNoticias($Filtro){
            return $this->WebModel->ConsultarNoticias($Filtro);
        }

        public function ConsultarDireccion($DataPost){
            return $this->WebModel->ConsultarDireccion($DataPost);
        }

        public function ProcesarDireccion($direccion,$id){
            return $this->WebModel->ProcesarDireccion($direccion,$id);
        }

        public function ProcesarNoticia($direccion,$datosNoticia){
            return $response = $this->WebModel->ProcesarNoticia($direccion,$datosNoticia);
        }

        public function EditarNoticia($direccion,$datosNoticia){
            return $response = $this->WebModel->EditarNoticia($direccion,$datosNoticia);
        }

        public function EliminarNoticia($IdNoticia){
            return $response = $this->WebModel->EliminarNoticia($IdNoticia);
        }
    }
?>