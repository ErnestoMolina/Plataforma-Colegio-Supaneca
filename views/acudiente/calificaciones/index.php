<?php
    include_once '../../../controller/admin/matricula.php';
    include_once '../../../controller/admin/CargaAcademica.php';
    include_once '../../../controller/admin/materias.php';
    include_once '../../../controller/docente/actividades.php';
    include '../../../controller/docente/calificaciones.php';
    $EstudianteCTR = new Estudiante();
    $CargaAcademicaCTR = new CargaAcademica();
    $MateriasCTR = new Materia();
    $ActividadesCTR = new Actividades();
    $DocenteCTR = new Calificaciones();

    $Titulo = 'Calificaciones';
    $mensagge = '';
    $tipoAlert = '';
    $Grados = '';
    $Actividades = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'consultarGradoEstudiante':
                $Grado = $EstudianteCTR->consultarGradoEstudiante($dataRequest);
                echo json_encode($Grado);
                return false;
            break;
            case 'consultarActividades':
                $Actividades = $ActividadesCTR->ConsultarActividades($_POST);
            break;
            case 'CargarEstudiantes':
                $Filtro = 'E.GradoEstudiante = '.$dataRequest['grado'];
                $Estudiantes = $EstudianteCTR->ConsultarEstudiantes($Filtro);
                echo json_encode($Estudiantes);
                return false;
            break;
            case 'calificarActividad':
                $Estudiantes = $DocenteCTR->ProcesarCalificaciones($_POST);
                echo json_encode($Estudiantes);
                return false;
            break;
            case 'ConsultarCalificaciones':
                $Calificaciones = $DocenteCTR->CosultarCalificacionesActividades($dataRequest);
                echo json_encode($Calificaciones);
                return false;
            break;
            case 'ConsultarDefinitivasPeriodos':
                $Calificaciones = $DocenteCTR->ConsultarDefinitivasPeriodos($dataRequest);
                echo json_encode($Calificaciones);
                return false;
            break;
            case 'ConsultarPorcentajeActividades':
                $Porcentajes = $DocenteCTR->ProcesarPorcentajesActividades($dataRequest);
                echo json_encode($Porcentajes);
                return false;
            break;
            case 'ConsultarPorcentaje':
                $Porcentaje = $DocenteCTR->ConsultarPorcentajesActividades($dataRequest);
                echo json_encode($Porcentaje);
                return false;
            break;
            case 'ConsultarObservaciones':
                $Observaciones = $DocenteCTR->ConsultarObservaciones($dataRequest);
                echo json_encode($Observaciones);
                return false;
            break;
            case 'procesarObservaciones':
                $Observaciones = $DocenteCTR->procesarObservaciones($dataRequest);
                echo json_encode($Observaciones);
                return false;
            break;
            case 'procesarDefinitiva':
                $Definitiva = $DocenteCTR->procesarDefinitiva($dataRequest);
                echo json_encode($Definitiva);
                return false;
            break;
            case 'procesarDefinitivaAño':
                $DefinitivaAño = $DocenteCTR->procesarDefinitivaAño($dataRequest);
                echo json_encode($DefinitivaAño);
                return false;
            break;
            

        }
    }
    
    // $Estudiantes = $EstudianteCTR->ConsultarEstudiantes();
    // $Acudientes = $AcudienteCTR->ConsultarAcudientes(); 
    
    include('./views/vistaGeneral.php');