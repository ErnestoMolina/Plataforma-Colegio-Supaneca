<?php
    class Asistencia{
        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ProcesarInasistencia($DataPost){
            $response = [];
            $sql = "INSERT INTO inasistencias (IdEstudiante,IdGrado,IdMateria,Periodo,Descripcion,Fecha)
            VALUES({$DataPost['idEstudiante']},{$DataPost['listaGrados']},{$DataPost['listaMaterias']},
            {$DataPost['periodo']},'{$DataPost['descripcion']}','{$DataPost['fecha']}')";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Se ha agregado Exitosamente'; 
            }else{
                $response['error'] = 'Error al agregar'; 
            }

            return $response;

        }

        public function ConsultarInasistensias($campo,$Filtro,$campo2,$filtro2,$campo3,$filtro3,$campo4,$filtro4,$campo5,$filtro5){
            $response = [];
            $sql = "SELECT * FROM inasistencias";

            if($Filtro){
                $sql .= " WHERE {$campo} = '{$Filtro}' AND {$campo2} = {$filtro2} AND {$campo3} = {$filtro3} AND {$campo4} = {$filtro4} AND {$campo5} = {$filtro5}";
            }
            $resultset = $this->DB->query($sql);
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }
            return $response;
        }

        public function consultarEstudiantes($IdGrado){
            $response = [];
            $sql = "SELECT * FROM estudiantes WHERE GradoEstudiante = {$IdGrado}";

            $resultset = $this->DB->query($sql);
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarEstudiante($campo,$valor){
            $response = [];
            $sql = "SELECT * FROM estudiantes";
            if($valor){
                $sql .= " WHERE {$campo} = {$valor};";
            }
            $resultset = $this->DB->query($sql);
            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;

        }

        public function EditarInasistencia($DataPost){
            $response = [];
            if(!$DataPost){
                return ['error' => 'No se han editado los datos'];
            }

            $sql = "UPDATE inasistencias SET
            IdEstudiante = {$DataPost['idEstudiante']},
            IdGrado = {$DataPost['listaGrados']},
            IdMateria = {$DataPost['listaMaterias']},
            Periodo = '{$DataPost['periodo']}',
            Descripcion = '{$DataPost['descripcion']}',
            Fecha = '{$DataPost['fecha']}'
            WHERE Id = {$DataPost['idInasistencia']}";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response = ['success' => 'La Inasisencia ha sido modificada.']; 
            }else{
                $response = ['error' => 'La Inasisencia no se ha modificado.']; 
            }

            return $response;
        }

        public function EliminarInasistencia($IdInasistencia){
            $response = [];
            if(!$IdInasistencia){
                return ['error' => 'Error en la peticion intente nuevamente.'];
            }
            $sql = "DELETE FROM inasistencias WHERE Id = {$IdInasistencia};";
            $resultset = $this->DB->query($sql);

            if($resultset === true){
                $response['success'] = 'La inasistencia se ha eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar la inasistencia.';
            }

            return $response;
        }

        public function ConsultarInasistensiasFiltro($DataPost){
            $response = [];
            $sql = "SELECT * FROM inasistencias";
            if($DataPost){
                $sql .= " WHERE IdMateria = {$DataPost['materia']} AND Periodo = {$DataPost['periodo']} AND IdGrado = {$DataPost['ListaGrados']}";
            }

            $resultset = $this->DB->query($sql);
            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row; 
                }
            }
            return $response;
        }

        public function ConsultarInasistensiasAcudiente($DataPost){
            $response = [];
            $sql = "SELECT I.*, G.NombreGrado, E.NombresEstudiante, E.ApellidosEstudiante, M.NombreMateria FROM inasistencias I
            INNER JOIN estudiantes E ON I.IdEstudiante = E.IdEstudiante
            INNER JOIN grados G ON I.IdGrado = G.IdGrado
            INNER JOIN materias M ON I.IdMateria = M.IdMateria";
            if($DataPost){
                $sql .= " WHERE I.IdMateria = {$DataPost['materia']} AND I.Periodo = {$DataPost['periodo']} AND I.IdGrado = {$DataPost['ListaGrados']} AND I.IdEstudiante = {$DataPost['estudiantes']}";
            }

            $resultset = $this->DB->query($sql);
            if($resultset){
                while($row = $resultset->fetch_assoc()){
                    $response[] = $row; 
                }
            }
            return $response;
        }
    }
?>