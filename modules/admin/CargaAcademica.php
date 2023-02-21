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

            // $sql2 = "SELECT G.*, D.NombresDocente FROM grados G INNER JOIN docentes D ON";
            
            // $sql1 = "DESC grados";
            // $resultset2 = $this->DB->query($sql1);
            // if($resultset2){
            //     while ($row = $resultset2->fetch_array()) {
            //         $response[] = $row;
            //     }
            // }
            // foreach($response as $column){
            //     $row = $column['Field'];
            //     if($row == "IdGrado"){

            //     }elseif($row == "NombreGrado"){

            //     }else{
            //         $sql2 .= " D.IdDocente = G.$row OR";
            //     }
            // }

            // $sql = substr($sql2, 0, -2);

            $sql = "SELECT * FROM grados";
            // //D.NombresDocente = G.DirectorGrado
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
            $sql = "SELECT D.*, M.NombreMateria 
            FROM docentes D
            INNER JOIN materias M ON D.IdMateria = M.IdMateria";

            if($Materia){
                $sql .= " WHERE M.NombreMateria = '{$Materia}'";
            }

            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
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

        // public function ConsultarAcudiente($numeroDocumento, $ValorDocumento,$tipoDocumento,$ValorTD){
        //     $response = [];
        //     $sql = "SELECT * FROM acudientes WHERE {$numeroDocumento} = {$ValorDocumento} AND {$tipoDocumento} = '{$ValorTD}'";
        //     $resultset = $this->DB->query($sql);
         
        //     if($resultset){
        //         while ($row = $resultset->fetch_assoc()) {
        //             $response[] = $row;
        //         }
        //     }

        //     return $response;
        // }

        // public function ProcesarAcudiente($DataRow = false){
        //     $response = [];
        //     if(!$DataRow){
        //         return ['error' => 'No se han ingresado datos'];
        //     }

        //     include '../../../controller/admin/seguridad.php';
        //     $passEncriptada = new Seguridad();
        //     $contraseña = $passEncriptada->encriptarP($DataRow['contraseñaA']);
            
        //     $sql = "INSERT INTO acudientes (NombresAcudiente,apellidosAcudiente,TipoDocumentoAcudiente,NDocumentoAcudiente,FechaNacimientoAcudiente,TelefonoAcudiente,CorreoElectronicoAcudiente,ContraseñaAcudiente)
        //             VALUES('".$DataRow['nombreA']."','".$DataRow['apellidoA']."','".$DataRow['listaDocumentosA']."','".$DataRow['documentoA']."','".$DataRow['fechaNA']."','".$DataRow['telefonoA']."','".$DataRow['emailA']."','".$contraseña."');";
            
        //     $resultset = $this->DB->query($sql);
        //     if($resultset === true){
        //         $response['success'] = 'Se ha agregado Exitosamente';
        //     }else{
        //         $response['Error'] = 'Error al agregar.';
        //     }

        //     return $response;
        // }

        // public function EliminarAcudiente($IdAcudiente = false){
        //     $response = [];
        //     if(!$IdAcudiente){
        //         return ['error' => 'Error en la peticion intente nuevamente.'];
        //     }
            
        //     $sql = "DELETE  FROM acudientes WHERE IdAcudiente = {$IdAcudiente};";
        //     $resultset = $this->DB->query($sql);

        //     if($resultset === true){
        //         $response['success'] = 'El acudiente ha sido eliminado exitosamente.';
        //     }else{
        //         $response['error'] = 'Error al eliminar al acudiente.';
        //     }

        //     return $response;
        // }

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
                $response['Error'] = 'Lo sentimos, el numero de documento ya existe.';
            }

            return $response;
        }
    }
?>