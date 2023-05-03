<?php
    include_once '../../../controller/admin/matricula.php';
    include_once '../../../controller/admin/CargaAcademica.php';
    include_once '../../../controller/admin/boletines.php';
    include_once '../../../libs/fpdf/fpdf.php';
    $EstudianteCTR = new Estudiante();
    $BoletinesCTR = new Boletin();
    $CargaAcademicaCTR = new CargaAcademica();
    $pdf = new FPDF();

    $Titulo = 'Actas Finales';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'ConsultarEstudiantes':
                $Estudiante = $EstudianteCTR->ConsultarEstudiantesGrado($dataRequest);
                echo $Estudiante = json_encode($Estudiante);
                return false;
            break;
            case 'ConsultarDocente':
                $Estudiante = $BoletinesCTR->ConsultarDocenteMateriaGrado($dataRequest);
                echo $Estudiante = json_encode($Estudiante);
                return false;
            break;
            case 'ConsultarNombreDocente':
                $Estudiante = $BoletinesCTR->ConsultarDocente($dataRequest);
                echo $Estudiante = json_encode($Estudiante);
                return false;
            break;
            case 'ConsultarBoletinFinal':
                $Boletin = $BoletinesCTR->ConsultarBoletinFinal($dataRequest);
                echo $Boletin = json_encode($Boletin);
                return false;
            break;
            case 'ImprimirPdf':
                $pdf->AddPage();

                // Asignando valores resibidos 
                $Calificaciones = [];
                $CantidadMaterias = $dataRequest['CantidadMaterias'];
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Calificaciones[$i] = 'Calificacion'.$i; 
                }
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Materias[$i] = 'Materia'.$i; 
                }
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Desempeños[$i] = 'Desempeño'.$i; 
                }
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Docentes[$i] = 'NombreDocente'.$i; 
                }
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Historial[$i] = 'Historial'.$i; 
                }
                // print_r($Calificaciones);
                // echo $Calificaciones[1];             
                // $Calificacion1 = $dataRequest[$Calificaciones[1]];
                // $Desempeño1 = $dataRequest[$Desempeños[1]];
                // $Materia1 = $dataRequest[$Materias[1]];
                // $Observaciones1 = $dataRequest[$Observaciones[1]];

                $NombreEstudiante = $dataRequest['NombreEstudiante'];
                $grado = $dataRequest['grado'];
                $documento = $dataRequest['documento'];
                $Ndocumento = $dataRequest['Ndocumento'];
                $periodo = $dataRequest['periodo'];
                $vigencia = $dataRequest['vigencia'];
                
                // Establecer posición inicial de las columnas
                $col1X = 5;
                $col2X = 75;
                $col3X = 145;
                $y = 5;

                // Establecer el ancho y la altura de las columnas
                $colWidth = 140;
                $colHeight = 40;

                // Establecer la fuente y el tamaño
                $pdf->SetFont('Arial', 'B', 8);

                // Columna 1
                $pdf->SetXY($col1X, $y);
                $pdf->Image('C:/MAMP/htdocs/proyecto/img/EscudoSinFondo.png', 8, 10, 15, 15);

                // columna 3
                $pdf->SetXY($col3X, $y);
                $pdf->Image('C:/MAMP/htdocs/proyecto/img/EscudoSinFondoColombia.png', 187, 10, 15, 15);

                // Columna 2
                $pdf->SetXY(35, $y);
                $pdf->Cell($colWidth, 5, utf8_decode('REPUBLICA DE COLOMBIA'), 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->SetXY(35, 10);
                $pdf->Cell($colWidth, 5, utf8_decode('SECRETARIA DE EDUCACIÓN DEPARTAMENTAL'), 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->SetXY(35, 15);
                $pdf->Cell($colWidth, 5, utf8_decode('INSTITUCIÓN EDUCATIVA SUPANECA'), 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->SetXY(35, 20);
                $pdf->Cell($colWidth, 5, utf8_decode('CONSTRUIMOS FUTURO'), 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->SetXY(35, 25);
                $pdf->Cell($colWidth, 5, utf8_decode('TIBANÁ - BOYACA'), 0, 0, 'C');
                $pdf->Ln(5);
                $pdf->SetXY(35, 30);
                $pdf->Cell($colWidth, 5, utf8_decode('INFORME DE EVALUACIÓN'), 0, 0, 'C');

                // Datos Boletin primera parte
                $pdf->Ln(5);
                $pdf->SetXY(6.5, 40);
                $pdf->Cell(197, 0.1,'', 1);
                $pdf->SetXY(6.5, 40);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(197, 5,'Certifican', 0, 0,'C');
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(6.5, 45);
                $pdf->Cell(197, 5,utf8_decode('Que el(la) Estudiante'.$NombreEstudiante), 0, 0,'L');
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(10, 50);
                $pdf->Cell(197, 5,utf8_decode('Identificado con '.$documento.' No '.$Ndocumento.' curso en esta institución educativa el GRADO '.$grado.' del nivel MEDIA ACADEMICA jornada UNICA durante el Año'), 0, 0,'L');
                $pdf->SetXY(10, 55);
                $pdf->Cell(197, 5,utf8_decode('Lectivo '.$vigencia.', obteniendo el siguiente informe final sobre procesos de desarrollo:'), 0, 0,'L');
                $pdf->SetFont('Arial', 'B', 8);

                $pdf->SetXY(6.5, 62);
                $pdf->Cell(197, 5, utf8_decode('Año: '.$vigencia.'   Periodo: Definitivo    Especialidad: Academica'), 1);
                $pdf->SetXY(6.5, 67);
                $pdf->Cell(111, 5, utf8_decode('Nombre del area y/o asignatura'), 1);
                $pdf->SetXY(117.5, 67);
                $pdf->Cell(40, 5, utf8_decode('Valoracion'), 1, 0, 'C');
                $pdf->SetXY(157.5, 67);
                $pdf->Cell(46, 5, utf8_decode('Desempeño Final'), 1, 0, 'C');
                // $pdf->SetXY(163.5, 65);
                // $pdf->Cell(40, 5, utf8_decode('Historial Final'), 1, 0, 'C');
                

                $EjeY = 72;
                $Promedio = 0;
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Promedio = $Promedio + $dataRequest[$Calificaciones[$i]];
                    $pdf->SetXY(6.5, $EjeY);
                    $pdf->MultiCell(111, 5, utf8_decode($dataRequest[$Materias[$i]])."\nDocente: ".utf8_decode($dataRequest[$Docentes[$i]]), 1);
                    $y1 = $pdf->GetY(); 
                    $pdf->SetXY(117.5, $EjeY);
                    $pdf->Cell(40, 10, utf8_decode($dataRequest[$Calificaciones[$i]]), 1, 0, 'C');
                    $pdf->SetXY(157.5, $EjeY);
                    $pdf->Cell(46, 10, utf8_decode($dataRequest[$Desempeños[$i]]), 1, 0, 'C');
                    $EjeY = $EjeY + 10;
                }
                $Promedio = $Promedio/$CantidadMaterias;
                $pdf->SetXY(6.5, $EjeY);
                $pdf->MultiCell(111, 5, utf8_decode('Promedio'), 1);
                $pdf->SetXY(117.5, $EjeY);
                $pdf->Cell(86, 5, utf8_decode(round($Promedio,1)), 1, 0, 'C');
                $EjeY = $EjeY + 15;
                // firma Rector 
                $pdf->SetXY(8, $EjeY);
                $pdf->Cell(86, 0.1,'', 1);
                $pdf->SetXY(8, $EjeY);
                $pdf->Cell(86, 5, utf8_decode('Rector: Julio Ricardo Estupiñan Caceres'), 0, 0, 'L');
                $EjeY = $EjeY + 5;
                $pdf->SetXY(8, $EjeY);
                $pdf->Cell(86, 5, utf8_decode('C.C 13582953'), 0, 0, 'L');


                $pdf->SetFont('Arial', '', 8);
                
                
                $pdf->Output('nombre_del_archivo.pdf', 'I'); 
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

    $Grados = $CargaAcademicaCTR->ConsultaGrados();

    include('./views/vistaGeneral.php');