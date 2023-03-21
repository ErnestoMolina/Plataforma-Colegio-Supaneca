<?php
    include_once '../../../controller/admin/docentes.php';
    $DocenteCTR = new Docente();
    include_once '../../../controller/admin/materias.php';
    $MateriaCTR = new Materia();

    $Titulo = 'Docentes';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearDocente':
                $response = $DocenteCTR->ProcesarDocente($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'eliminarDocente':
                $response = $DocenteCTR->EliminarDocente($dataRequest['IdDocente']);

                echo $response = json_encode($response);
                return $response;
            break;
            case 'editarDocente':
                $response = $DocenteCTR->EditarDocente($_POST);
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

    $Docentes = $DocenteCTR->ConsultarDocentes('','D.*');
    $Materias = $MateriaCTR->ConsultarMaterias();

    include('./views/vistaGeneral.php');