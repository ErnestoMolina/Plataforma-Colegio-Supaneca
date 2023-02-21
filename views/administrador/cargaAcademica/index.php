<?php
    include_once '../../../controller/admin/CargaAcademica.php';
    $CargaAcademicaCTR = new CargaAcademica();

    $Titulo = 'Carga Academica';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'crearAcudiente':
                $response = $CargaAcademicaCTR->ProcesarAcudiente($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
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
                $response = $CargaAcademicaCTR->EditarCargaAcademica($_POST);
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

    $Materias = $CargaAcademicaCTR->ConsultarMaterias();
    $grados = $CargaAcademicaCTR->ConsultaGrados();
    include('./views/vistaGeneral.php');