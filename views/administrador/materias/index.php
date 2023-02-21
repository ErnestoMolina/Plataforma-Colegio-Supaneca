<?php
    include_once '../../../controller/admin/materias.php';
    $MateriaCTR = new Materia();

    $Titulo = 'Materias';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearMateria':
                $response = $MateriaCTR->ProcesarMateria($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'validarDocentesAsociados':
                $response = $MateriaCTR->validarDocentesAsociados($dataRequest['idMateria']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'eliminarMateria':
                $response = $MateriaCTR->EliminarMateria($dataRequest['idMateria']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'editarMateria':
                $response = $MateriaCTR->EditarMateria($_POST);
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

    $Materias = $MateriaCTR->ConsultarMaterias();

    include('./views/vistaGeneral.php');