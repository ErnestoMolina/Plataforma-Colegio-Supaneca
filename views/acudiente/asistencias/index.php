<?php
    include '../../../controller/docente/calificaciones.php';
    include '../../../controller/docente/actividades.php';
    include '../../../controller/docente/asistencias.php';
    include '../../../controller/admin/materias.php';
    include '../../../controller/admin/matricula.php';
    $EstudianteCTR = new Estudiante();
    $MateriasCTR = new Materia();
    $ActividadesCTR = new Actividades();
    $DocenteCTR = new Calificaciones();
    $AsistenciasCTR = new Asistencias();

    $Titulo = 'Inasistencias';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'consultarGradoEstudiante':
                $Grado = $EstudianteCTR->consultarGradoEstudiante($dataRequest);
                echo json_encode($Grado);
                return false;
            break;
            case 'agregarInasistencia':
                $response = $AsistenciasCTR->ProcesarInasistencia($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'eliminar':
                $response = $AsistenciasCTR->EliminarInasistencia($dataRequest['IdInasistencia']);
                echo json_encode($response);
                return false;
            break;
            case 'consultarEstudiantes':
                $response = $AsistenciasCTR->consultarEstudiantes($dataRequest['idGrado']);
                echo json_encode($response);
                return false;
            break;
            case 'editarInasistencia':
                $response = $AsistenciasCTR->EditarInasistencia($_POST);
                if(isset($response['error'])){
                    $mensagge = $response['error'];
                    $tipoAlert = "alert-danger";
                }elseif($response['success']){
                    $mensagge = $response['success'];
                    $tipoAlert = "alert-success";
                }
            break;
            case 'consultarInasistencias':
                $Inasistencias = $AsistenciasCTR->ConsultarInasistensiasAcudiente($dataRequest);
                echo json_encode($Inasistencias);
                return false;
            break;
            case 'consultarGradosMateria':
                $Grados = $DocenteCTR->consultarGradosMateria($dataRequest);
                echo json_encode($Grados);
                return false;
            break;
        }
    }

    $Materias = $ActividadesCTR->consultarMaterias();
    $Grados = $ActividadesCTR->consultarGrados();
    // $Inasistencias = $AsistenciasCTR->ConsultarInasistensias('','','','','','','','','','');
    include('./views/vistaGeneral.php');