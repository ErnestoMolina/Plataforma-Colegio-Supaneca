<?php
    include_once '../../../controller/admin/docentes.php';
    $DocenteCTR = new Docente();

    $Titulo = 'Mi Perfil';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearAdmin':
                $response = $DocenteCTR->ProcesarAdmin($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            // case 'eliminarMateria':
            //     $response = $MateriaCTR->EliminarMateria($dataRequest['NombreMateria']);

            //     echo $response = json_encode($response);
            //     return $response;
            // break;
            case 'editarDatos':
                $response = $DocenteCTR->EditarDocentePerfil($_POST);
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