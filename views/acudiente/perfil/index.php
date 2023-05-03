<?php
    include_once '../../../controller/admin/acudientes.php';
    $AcudienteCTR = new Acudiente();

    $Titulo = 'Mi Perfil';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'editarDatos':
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
    include('../layauts/plantillaInicio.php');

    // $Administradores = [];
    // $Administradores = $AdministradorCTR->ConsultarAdministrador($nombre);
    // print_r($Administradores);
    include('./views/vistaGeneral.php');