<?php
    class GestionPagina
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
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

        public function ConsultarDireccion($idImagen){
            $response = [];
            $sql = "SELECT Direccion FROM imagenes WHERE id = {$idImagen}";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                $response = mysqli_fetch_row($resultset)[0];
            }

            return $response;
        }


        public function ProcesarDireccion($direccion = false,$id = false){
            $response = [];
            if(!$direccion && !$id){
                return $response = ['Error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE imagenes SET
            Direccion = '".$direccion."'
            WHERE id = ".$id.";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, error al actualizar.';
            }

            return $response;
        }

        public function ProcesarNoticia($direccion = false,$datosNoticia = false){
            $response = [];
            if(!$direccion && !$datosNoticia){
                return $response = ['Error' => 'No se han agregado los datos'];
            }

            $sql = "INSERT INTO noticias (Titulo,Descripcion,Imagen)
            VALUES('{$datosNoticia['titulo']}','{$datosNoticia['descripcion']}','{$direccion}');";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha agregado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, error al agregar.';
            }

            return $response;
        }

        public function EditarNoticia($direccion = false,$datosNoticia = false){
            $response = [];
            if(!$direccion && !$datosNoticia){
                return ['error' => 'No se han editado datos'];
            }

            $sql = "UPDATE noticias SET
            Titulo = '".$datosNoticia['titulo']."',
            Descripcion = '".$datosNoticia['descripcion']."',
            Imagen = '".$direccion."'
            WHERE Id= ".$datosNoticia['idNoticia'].";";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado exitosamente la noticia '.$datosNoticia['titulo'].'.';
            }else{
                $response['error'] = 'Lo sentimos, error al actualizar la noticia '.$datosNoticia['titulo'].'.';
            }

            return $response;
        }

        public function EliminarNoticia($IdNoticia = false){
            $response = [];
            if(!$IdNoticia){
                return $response = ['error' => 'Error en la peticion intente nuevamente.'];
            }

            $sql = "DELETE  FROM noticias WHERE Id = {$IdNoticia};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'La noticia ha sido eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar la noticia.';
            }

            return $response;
        }
    }
?>