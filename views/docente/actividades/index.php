<?php
    include '../../../controller/docente/calificaciones.php';
    $DocenteCTR = new Calificaciones();
    include '../../../controller/docente/actividades.php';
    $ActividadesCTR = new Actividades();

    $Titulo = 'Actividades';
    $mensagge = '';
    $tipoAlert = '';
    $Grados = '';
    $plantilla = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearActividad':
                $response = $ActividadesCTR->ProcesarActividad($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'eliminar':
                $response = $ActividadesCTR->EliminarActividad($dataRequest['idActividad']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'editarActividad':
                $response = $ActividadesCTR->EditarActividad($_POST);
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
    
    // $Estudiantes = $EstudianteCTR->ConsultarEstudiantes();
    // $Acudientes = $AcudienteCTR->ConsultarAcudientes(); 
    $Materias = $ActividadesCTR->consultarMaterias();
    $Grados = $ActividadesCTR->consultarGrados();
    $Actividades = $ActividadesCTR->ConsultarActividades('');
    include('./views/vistaGeneral.php');