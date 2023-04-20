<?php
    include_once '../../../controller/admin/matricula.php';
    $EstudianteCTR = new Estudiante();
    include_once '../../../controller/docente/actividades.php';
    $ActividadesCTR = new Actividades();
    include '../../../controller/docente/calificaciones.php';
    $DocenteCTR = new Calificaciones();

    $Titulo = 'Calificar';
    $mensagge = '';
    $tipoAlert = '';
    $Grados = '';
    $Actividades = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'consultarGradosMateria':
                $Grados = $DocenteCTR->consultarGradosMateria($dataRequest);
                echo json_encode($Grados);
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
                $Calificaciones = $DocenteCTR->CosultarCalificaciones($dataRequest);
                echo json_encode($Calificaciones);
                return false;
            break;
            

        }
    }
    
    // $Estudiantes = $EstudianteCTR->ConsultarEstudiantes();
    // $Acudientes = $AcudienteCTR->ConsultarAcudientes(); 
    
    include('./views/vistaGeneral.php');