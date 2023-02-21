<?php
    class Calificaciones{
        private $CalificacionesModel;

        public function __construct(){
            include_once '../../modules/admin/calificaciones.php';
            $CalificacionesModel = new Calificaciones();
        }
        
        public function ConsultarCalificaciones(){
            return $this->CalificacionesModel->ConsultarCalificaciones();
        }

    }
?>