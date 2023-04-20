<?php
    include_once '../../../controller/admin/acudientes.php';
    $AcudienteCTR = new Acudiente();

    $Titulo = 'Acudientes';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearAcudiente':
                $response = $AcudienteCTR->ProcesarAcudiente($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                    if($_POST){
                        $_POST = '';
                    }
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                    if($_POST){
                        $_POST = '';
                    }
                }
            break;
            case 'validarEstudiantesAsociados':
                $response = $AcudienteCTR->validarEstudiantesAsociados($dataRequest['IdAcudiente']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'eliminarAcudiente':
                $response = $AcudienteCTR->EliminarAcudiente($dataRequest['IdAcudiente']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'editarAcudiente':
                $response = $AcudienteCTR->EditarAcudiente($_POST);
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

    $Acudientes = $AcudienteCTR->ConsultarAcudientes();

    include('./views/vistaGeneral.php');