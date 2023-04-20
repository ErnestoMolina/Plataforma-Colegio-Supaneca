<?php
    class Calificacion{

        public function __construct(){
            include_once '../../../modules/admin/conexion.php';
            $conexion = new conexion();
            $this->DB = $conexion->conectarDB();
        }
        
        public function consultarGradosMateria($DataPost){
            $response = [];
            $response2 = [];

            $sql2 = "SELECT * FROM materias WHERE IdMateria = {$DataPost['materia']}";
            $resultset2 = $this->DB->query($sql2);
            
            if($resultset2){
                while ($row = $resultset2->fetch_assoc()) {
                    $response2[] = $row;
                }
            }
            foreach($response2 as $nombre){
                $sql = 'SELECT * FROM grados WHERE '.$nombre['NombreMateria'].' = '.$DataPost['IdUser'].'';
            


            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }
        }
            return $response;
            
        }

        public function ProcesarCalificaciones($DataPost){
            $response = [];
            $sql = "INSERT INTO calificaciones (IdActividad,IdEstudiante,IdGrado, IdMateria, IdPeriodo, Calificacion, Observacion)
            VALUES ({$DataPost['IdActividad']}, {$DataPost['IdEstudiante']}, {$DataPost['IdGrado']}, {$DataPost['IdMateria']}, {$DataPost['IdPeriodo']}, {$DataPost['nota']}, '{$DataPost['observacion']}')";
            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'La actividad se ha eliminado exitosamente.';
            }else{
                $response['error'] = 'Error al eliminar la actividad.';
            }

            return $response;
        }

        public function EditarCalificaciones($DataPost){
            $response = [];
            $sql = "UPDATE calificaciones SET
            Calificacion = {$DataPost['nota']},
            Observacion = '{$DataPost['observacion']}',
            IdPeriodo = '{$DataPost['IdPeriodo']}'
            WHERE Id = {$DataPost['Id']}";

            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'La calificacion se ha modificado exitosamente.';
            }else{
                $response['error'] = 'Error al modificar la calificacion.';
            }

            return $response;
        }

        public function CosultarCalificaciones($DataPost){
            $response = [];
            $sql = "SELECT * FROM calificaciones";
            if($DataPost){
                $sql .= " WHERE IdActividad = {$DataPost['IdActividad']} AND 
                IdEstudiante = {$DataPost['IdEstudiante']} AND IdGrado = {$DataPost['IdGrado']} AND 
                IdMateria = {$DataPost['IdMateria']}";;
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ConsultarDefinitivasPeriodos($DataPost){
            $response = [];
            $sql = "SELECT * FROM definitivas";
            if($DataPost){
                $sql .= " WHERE IdEstudiante = {$DataPost['IdEstudiante']}
                AND IdGrado = {$DataPost['IdGrado']} AND 
                IdMateria = {$DataPost['IdMateria']}";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function CosultarCalificacionesActividades($DataPost){
            $response = [];
            $sql = "SELECT C.*,A.* FROM calificaciones C INNER JOIN	actividades A ON C.IdActividad = A.Id";
            if($DataPost){
                $sql .= " where C.IdMateria = {$DataPost['materia']} AND C.IdGrado = {$DataPost['ListaGrados']} AND C.IdEstudiante = {$DataPost['estudiantes']} AND A.Periodo = {$DataPost['periodo']}";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function CosultarCalificacionesRegistradas($DataPost){
            $response = [];
            $sql = "SELECT * FROM calificaciones";
            if($DataPost){
                $sql .= " WHERE IdActividad = {$DataPost['IdActividad']} AND 
                IdEstudiante = {$DataPost['IdEstudiante']} AND IdGrado = {$DataPost['IdGrado']} AND 
                IdMateria = {$DataPost['IdMateria']}";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response = $row;
                }
            }

            return $response;
        }

        public function CosultarPorcentajesActividades($DataPost){
            $response = [];
            $sql = "SELECT * FROM porcentajeactividades";
            if($DataPost){
                $sql .= " WHERE IdGrado = {$DataPost['IdGrado']} AND IdMateria = {$DataPost['IdMateria']}";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function ProcesarPorcentajesActividades($DataPost){
            $response = [];
            $sql = "INSERT INTO porcentajeactividades (IdGrado, IdMateria, Tareas, Talleres, Evaluaciones)
            VALUES ({$DataPost['IdGrado']}, {$DataPost['IdMateria']}, {$DataPost['tareas']}, {$DataPost['talleres']}, {$DataPost['evaluaciones']})";
            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'Porcentajes guardados exitosamente.';
            }else{
                $response['error'] = 'Error al guardar los porcentajes.';
            }

            return $response;
        }

        public function EditarPorcentajesActividades($DataPost){
            $response = [];
            $sql = "UPDATE porcentajeactividades SET
            Tareas = {$DataPost['tareas']},
            Talleres = {$DataPost['talleres']},
            Evaluaciones = {$DataPost['evaluaciones']}
            WHERE Id = {$DataPost['Id']}";

            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'Porcentajes guardados exitosamente.';
            }else{
                $response['error'] = 'Error al guardar los porcentajes.';
            }

            return $response;
        }

        public function ConsultarObservaciones($DataPost){
            $response = [];
            $sql = "SELECT * FROM observacionesdefinitivas";
            if($DataPost){
                $sql .= " WHERE IdGrado = {$DataPost['IdGrado']} AND IdMateria = {$DataPost['IdMateria']} AND Desempeño = '{$DataPost['desempeño']}'";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function procesarObservaciones($DataPost){
            $response = [];
            $sql = "INSERT INTO observacionesdefinitivas (IdGrado, IdMateria, Desempeño, Observaciones)
            VALUES ({$DataPost['IdGrado']}, {$DataPost['IdMateria']}, '{$DataPost['desempeño']}', '{$DataPost['observaciones']}')";
            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'Observaciones guardados exitosamente.';
            }else{
                $response['error'] = 'Error al guardar los observaciones.';
            }

            return $response;
        }

        public function EditarObservaciones($DataPost){
            $response = [];
            $sql = "UPDATE observacionesdefinitivas SET
            Observaciones = '{$DataPost['observaciones']}'
            WHERE Id = {$DataPost['Id']}";

            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'Observaciones modificadas exitosamente.';
            }else{
                $response['error'] = 'Error al modificar las observaciones.';
            }

            return $response;
        }

        public function ConsultarDefinitiva($DataPost){
            $response = [];
            $sql = "SELECT * FROM definitivas";
            if($DataPost){
                $sql .= " WHERE IdGrado = {$DataPost['IdGrado']} AND IdMateria = {$DataPost['IdMateria']} AND Periodo = {$DataPost['periodo']} AND IdEstudiante = {$DataPost['IdEstudiante']}";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function procesarDefinitva($DataPost){
            $response = [];
            $sql = "INSERT INTO definitivas (IdGrado, IdMateria, Periodo, IdEstudiante, Desempeño, Calificacion)
            VALUES ({$DataPost['IdGrado']}, {$DataPost['IdMateria']}, {$DataPost['periodo']}, {$DataPost['IdEstudiante']}, '{$DataPost['desempeñoDefinitiva']}', {$DataPost['definitiva']})";
            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'Definitiva guardada exitosamente.';
            }else{
                $response['error'] = 'Error al guardar la definitiva.';
            }

            return $response;
        }

        public function EditarDefinitiva($DataPost){
            $response = [];
            $sql = "UPDATE definitivas SET
            Desempeño = '{$DataPost['desempeñoDefinitiva']}',
            Calificacion = {$DataPost['definitiva']}
            WHERE Id = {$DataPost['Id']}";

            $resultset = $this->DB->query($sql);


            if($resultset === true){
                $response['success'] = 'Definitiva modificada exitosamente.';
            }else{
                $response['error'] = 'Error al modificar la definitiva.';
            }

            return $response;
        }
        
        public function ConsultarDefinitivaAño($DataPost){
            $response = [];
            $sql = "SELECT * FROM definitivasaño";
            if($DataPost){
                $sql .= " WHERE IdGrado = {$DataPost['IdGrado']} AND IdMateria = {$DataPost['IdMateria']} AND IdEstudiante = {$DataPost['IdEstudiante']} AND YEAR(Fecha) = {$DataPost['Vigencia']}";
            }
            $resultset = $this->DB->query($sql);

            if($resultset){
                while ($row = $resultset->fetch_assoc()) {
                    $response[] = $row;
                }
            }

            return $response;
        }

        public function procesarDefinitivaAño($DataPost){
            $response = [];
            $Historial = str_replace(",", "-", $DataPost['HistorialNotas']);
            $Historial = substr($Historial, 1);
            $sql = "INSERT INTO definitivasaño (IdGrado, IdMateria, IdEstudiante, Desempeño, Calificacion, HitorialNotas)
            VALUES ({$DataPost['IdGrado']}, {$DataPost['IdMateria']}, {$DataPost['IdEstudiante']}, '{$DataPost['desempeñoDefinitiva']}', {$DataPost['definitiva']}, '$Historial')";
            
            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Definitiva guardada exitosamente.';
            }else{
                $response['error'] = 'Error al guardar la definitiva.';
            }

            return $response;
        }

        public function EditarDefinitivaAño($DataPost){
            $response = [];
            $Historial = str_replace(",", " - ", $DataPost['HistorialNotas']);
            $Historial = substr($Historial, 3);
            $sql = "UPDATE definitivasaño SET
            Desempeño = '{$DataPost['desempeñoDefinitiva']}',
            Calificacion = {$DataPost['definitiva']},
            HistorialNotas = '$Historial'
            WHERE Id = {$DataPost['Id']}";

            $resultset = $this->DB->query($sql);
            if($resultset === true){
                $response['success'] = 'Definitiva modificada exitosamente.';
            }else{
                $response['error'] = 'Error al modificar la definitiva.';
            }

            return $response;
        }
    }
?>