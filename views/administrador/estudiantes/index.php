<?php
    include_once '../../../controller/admin/matricula.php';
    include_once '../../../controller/admin/acudientes.php';
    include_once '../../../controller/admin/CargaAcademica.php';
    include_once '../../../controller/docente/actividades.php';
    $EstudianteCTR = new Estudiante();
    $AcudienteCTR = new Acudiente();
    $CargaAcademicaCTR = new CargaAcademica();
    $ActividadesCTR = new Actividades();

    $Titulo = 'Estudiantes';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearEstudiante':
                $response = $EstudianteCTR->ProcesarEstudiante($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'eliminar':
                $response = $EstudianteCTR->EliminarEstudiante($dataRequest['documentoEstudiante']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'editarEstudiante':
                $response = $EstudianteCTR->EditarEstudiante($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }

            break;

        }
    }
    $Grados = $CargaAcademicaCTR->ConsultaGrados();
    $Estudiantes = $EstudianteCTR->ConsultarEstudiantes();
    $Acudientes = $AcudienteCTR->ConsultarAcudientes();
    include('./views/vistaGeneral.php');