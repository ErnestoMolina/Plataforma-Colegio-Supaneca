<?php
    include_once '../../../controller/admin/CargaAcademica.php';
    include_once '../../../controller/admin/matricula.php';
    $CargaAcademicaCTR = new CargaAcademica();
    $EstudiantesCTR = new Estudiante();

    $Titulo = 'Carga Academica';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'ConsultarDirectores':
                $response = $CargaAcademicaCTR->ConsultarDirectores($dataRequest);
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