<?php
    class Web{
        private $WebModel;
        private $EstudiantesModel;

        public function __construct(){
            include_once '../../modules/admin/homePerfil.php';
            $this->WebModel = new GestionPagina();
        }

        public function ConsultarImagenes(){
            return $this->WebModel->ConsultarImagenes();
        }

        public function ConsultarNoticias($Filtro = false){
            return $this->WebModel->ConsultarNoticias($Filtro);
        }

        public function NoticiasPaginacion($limit,$offset){
            return $this->WebModel->NoticiasPaginacion($limit,$offset);
        }

    }
?>