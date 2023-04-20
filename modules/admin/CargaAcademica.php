<?php
    class AsignacionAcademica
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarMaterias(){
            $response = [];
            $sql = "DESC grados";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultaGrados(){
            $response = [];
            $sql = "SELECT * FROM grados";
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultaDocentes($Materia = false){
            $response = [];

            if($Materia){
                $sql = "SELECT IdMateria from materias where NombreMateria = '{$Materia}'";
                $resultset1 = $this->DB->query($sql);
                if($resultset1){
                    while ($row = $resultset1->fetch_array()) {
                        $response1[] = $row;
                    }
                }
                foreach($response1 as $id){

                    $sql2 = "SELECT * FROM docentes where idMateria like '%";
                    $sql2 .='"'.$id['IdMateria'].'"%';
                    $sql2 .= "'";
                    $resultset = $this->DB->query($sql2);
            
                    if($resultset){
                        while ($row = $resultset->fetch_array()) {
                            $response[] = $row;
                        }
                    }
                }
            }else{
                $sql = "SELECT * FROM docentes";
                $resultset1 = $this->DB->query($sql);
                if($resultset1){
                    while ($row = $resultset1->fetch_array()) {
                        $response[] = $row;
                    }
                }
            }

            

            return $response;
        }

        public function ConsultaDocentesID($IdDocente = false){
            $response = [];
            $sql = "SELECT NombresDocente,ApellidosDocente
            FROM docentes WHERE IdDocente = $IdDocente";

            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function EditarCargaAcademica($DataRow = false){
            $response = [];
            if(!$DataRow){
                return ['error' => 'No se han editado los datos'];
            }
            
            $sql2 = "DESC grados";
            $resultset2 = $this->DB->query($sql2);
            if($resultset2){
                while ($row = $resultset2->fetch_array()) {
                    $response[] = $row;
                }
            }
            $sql1 = "UPDATE grados SET";
            $sql = '';
            foreach($response as $column){
                $row = $column['Field'];
                if($row == "IdGrado"){
                    $sql4 =" WHERE $row = ".$DataRow[$row].";";
                }elseif($row == "NombreGrado"){

                }else{
                    $sql.="
                    $row = ".$DataRow[$row].",";

                }
            }
            $campos = substr($sql, 0, -1);

            $sqlCompleto = $sql1.$campos.$sql4;
            

            $resultset = $this->DB->query($sqlCompleto);
            if($resultset === true){
                $response['success'] = 'Se ha actualizado Exitosamente';
            }else{
                $response['Error'] = 'Lo sentimos, error al Modificar.';
            }

            return $response;
        }

        public function ConsultarDirectores($DataPost = false){
            $response = [];
            $sql = "SELECT * FROM grados WHERE DirectorGrado = {$DataPost['IdDirector']}";

            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarDirectoresGrado($DataPost = false){
            $response = [];
            $sql = "SELECT * FROM grados WHERE DirectorGrado = {$DataPost['IdDirector']} AND NombreGrado = '{$DataPost['NombreGrado']}'";

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