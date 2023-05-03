<?php
    include_once '../../../controller/docente/calificaciones.php';
    include_once '../../../controller/docente/Actividades.php';
    $CalificacionesCTR = new Calificaciones();
    $ActividadesCTR = new Actividades();

    $Titulo = 'Acudientes';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'DepurarCalificaciones':
                $response = $CalificacionesCTR->DepurarCalificaciones($dataRequest);
                echo $response = json_encode($response);
                return false;
            break;
            case 'DepurarActividades':
                $response = $ActividadesCTR->DepurarActividades($dataRequest);
                echo $response = json_encode($response);
                return false;
            break;

        }
    }

    include('./views/vistaGeneral.php');