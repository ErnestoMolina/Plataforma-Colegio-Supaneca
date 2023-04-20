<?php
    include_once '../../../controller/admin/matricula.php';
    include_once '../../../controller/admin/acudientes.php';
    include_once '../../../controller/admin/CargaAcademica.php';
    include_once '../../../controller/docente/actividades.php';
    include_once '../../../controller/docente/observaciones.php';
    $CargaAcademicaCTR = new CargaAcademica();
    $ActividadesCTR = new Actividades();
    $ObservacionesCTR = new Observaciones();
    $EstudianteCTR = new Estudiante();
    $AcudienteCTR = new Acudiente();

    $Titulo = 'Observaciones';
    $mensagge = '';
    $tipoAlert = '';
    $Estudiantes = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'añadirObservacion':
                $response = $ObservacionesCTR->ProcesarObservaciones($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'eliminarObservacion':
                $response = $ObservacionesCTR->EliminarObservacion($dataRequest['idObservacion']);
                echo $response = json_encode($response);
                return $response;
            break;
            case 'EditarObservacion':
                $response = $ObservacionesCTR->EditarObservacion($dataRequest);
                echo $response = json_encode($response);
                return false; 
            break;
            case 'ConsultarObservacionesEstudiante':
                $ObservacionesEstudiante = $ObservacionesCTR->ConsultarObservacionesEstudiante($dataRequest['IdEstudiante']);
                echo $ObservacionesEstudiante = json_encode($ObservacionesEstudiante);
                return false;
            break;
            case 'ConsultarGrado':
                $Grado = $ActividadesCTR->consultarGrado('IdGrado',$dataRequest['IdGrado']);
                echo $Grado = json_encode($Grado);
                return false;
            break;
            case 'ConsultarDocente':
                $Docente = $CargaAcademicaCTR->ConsultaDocentesID($dataRequest['IdDocente']);
                echo $Docente = json_encode($Docente);
                return false;
            break;

        }
    }

    // $Estudiantes = $EstudianteCTR->ConsultarEstudiantes();
    $Acudientes = $AcudienteCTR->ConsultarAcudientes();
    $Grados = $ActividadesCTR->consultarGrado('','');

    include('./views/vistaGeneral.php');