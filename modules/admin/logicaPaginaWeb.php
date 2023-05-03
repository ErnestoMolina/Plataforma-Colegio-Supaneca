<?php
    class logica{
        private $DB;

        public function __construct(){
            include_once 'modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
            // print_r($conexion);die;
        }

        public function ConsultarImagenes(){
            $response = [];
            $sql = "SELECT * FROM imagenes";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarNoticias($Filtro = false){
            $response = [];
            $sql = "SELECT * FROM noticias";
            if($Filtro != ''){
                $sql .= " WHERE {$Filtro};";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }
        
        public function NoticiasPaginacion($limit,$offset){
            $response = [];
            $sql = "SELECT * FROM noticias ORDER BY Fecha DESC LIMIT $limit OFFSET $offset";
            $resultset = $this->DB->query($sql);
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }
    }
?>