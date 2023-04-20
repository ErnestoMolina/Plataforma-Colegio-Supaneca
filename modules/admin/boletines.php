<?php
    class Boletines
    {
        private $DB;

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }

        public function ConsultarBoletinPeriodo($Filtro){
            $response = [];
            $sql = "SELECT D.*,G.NombreGrado,M.NombreMateria,E.NombresEstudiante,E.ApellidosEstudiante,A.NombresAcudiente,A.ApellidosAcudiente,O.Observaciones
            FROM definitivas D
            INNER JOIN observacionesdefinitivas O ON D.Desempeño = O.Desempeño AND D.IdMateria = O.IdMateria
            INNER JOIN grados G ON D.IdGrado = G.IdGrado
            INNER JOIN materias M ON D.Idmateria = M.IdMateria
            INNER JOIN estudiantes E ON D.IdEstudiante = E.IdEstudiante
            INNER JOIN acudientes A ON E.IdAcudiente = A.IdAcudiente";
            if($Filtro){
                $sql .= " WHERE  D.IdEstudiante = {$Filtro['IdEstudiante']} AND D.Periodo = {$Filtro['periodo']} AND O.IdGrado = {$Filtro['grado']} AND YEAR(Fecha) = {$Filtro['vigencia']}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarBoletinFinal($Filtro){
            $response = [];
            $sql = "SELECT D.*,G.NombreGrado,M.NombreMateria,E.NombresEstudiante,E.ApellidosEstudiante,E.TipoDocumentoEstudiante,E.NDocumentoEstudiante,A.NombresAcudiente,A.ApellidosAcudiente
            FROM definitivasaño D
            INNER JOIN grados G ON D.IdGrado = G.IdGrado
            INNER JOIN materias M ON D.Idmateria = M.IdMateria
            INNER JOIN estudiantes E ON D.IdEstudiante = E.IdEstudiante
            INNER JOIN acudientes A ON E.IdAcudiente = A.IdAcudiente";
            if($Filtro){
                $sql .= " WHERE  D.IdEstudiante = {$Filtro['IdEstudiante']} AND D.IdGrado = {$Filtro['grado']} AND YEAR(Fecha) = {$Filtro['vigencia']}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                while ($row = $resultset->fetch_array()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarDocenteMateriaGrado($Filtro){
            $response;
            $sql = "SELECT {$Filtro['materia']} FROM grados ";
            if($Filtro){
                $sql .= " WHERE IdGrado = {$Filtro['grado']}";
            }
            $resultset = $this->DB->query($sql);
         
            if($resultset){
                // while ($row = $resultset->fetch_array()) {
                //     $response[] = $row;
                // }
                $response = mysqli_fetch_row($resultset)[0];
            }

            return $response;
        }

        public function ConsultarDocente($Filtro){
            $response;
            $sql = "SELECT NombresDocente,ApellidosDocente FROM docentes ";
            if($Filtro){
                $sql .= " WHERE IdDocente = {$Filtro['id']}";
            }
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