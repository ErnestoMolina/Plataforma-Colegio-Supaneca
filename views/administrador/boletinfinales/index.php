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

                $NombreAcudiente = $dataRequest['NombreAcudiente'];
                $NombreEstudiante = $dataRequest['NombreEstudiante'];
                $grado = $dataRequest['grado'];
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
                $pdf->Cell(17, 5, utf8_decode('Estudiante:'), 1);
                $pdf->SetXY(23.5, 40);
                $pdf->Cell(63, 5, utf8_decode($NombreEstudiante), 1);
                $pdf->SetXY(86.5, 40);
                $pdf->Cell(14, 5, utf8_decode('Curso:'), 1);
                $pdf->SetXY(100.5, 40);
                $pdf->Cell(20, 5, utf8_decode($grado), 1);
                $pdf->SetXY(120.5, 40);
                $pdf->Cell(17, 5, utf8_decode('Formacion:'), 1);
                $pdf->SetXY(137.5, 40);
                $pdf->Cell(26, 5, utf8_decode('ACADEMICA'), 1);
                $pdf->SetXY(163.5, 40);
                $pdf->Cell(18, 5, utf8_decode('Jornada:'), 1);
                $pdf->SetXY(181.5, 40);
                $pdf->Cell(22, 5, utf8_decode('UNICA'), 1);
                
                $pdf->SetXY(6.5, 45);
                $pdf->Cell(17, 5, utf8_decode('Acudiente:'), 1);
                $pdf->SetXY(23.5, 45);
                $pdf->Cell(63, 5, utf8_decode($NombreAcudiente), 1);
                $pdf->SetXY(86.5, 45);
                $pdf->Cell(14, 5, utf8_decode('Periodo:'), 1);
                $pdf->SetXY(100.5, 45);
                $pdf->Cell(20, 5, utf8_decode($periodo), 1);
                $pdf->SetXY(120.5, 45);
                $pdf->Cell(17, 5, utf8_decode('Modalidad:'), 1);
                $pdf->SetXY(137.5, 45);
                $pdf->Cell(26, 5, utf8_decode('PRESENCIAL'), 1);
                $pdf->SetXY(163.5, 45);
                $pdf->Cell(18, 5, utf8_decode('Vigencia:'), 1);
                $pdf->SetXY(181.5, 45);
                $pdf->Cell(22, 5, utf8_decode($vigencia), 1);
                
                $pdf->SetXY(6.5, 52);
                $pdf->Cell(111, 5, utf8_decode('Nombre del area y/o asignatura'), 1);
                $pdf->SetXY(117.5, 52);
                $pdf->Cell(23, 5, utf8_decode('Def'), 1, 0, 'C');
                $pdf->SetXY(140.5, 52);
                $pdf->Cell(23, 5, utf8_decode('Desempeño'), 1, 0, 'C');
                $pdf->SetXY(163.5, 52);
                $pdf->Cell(40, 5, utf8_decode('Historial Final'), 1, 0, 'C');

                $EjeY = 57;
                $Promedio = 0;
                for($i = 1; $i <= $CantidadMaterias;$i++){
                    $Promedio = $Promedio + $dataRequest[$Calificaciones[$i]];
                    $pdf->SetXY(6.5, $EjeY);
                    $pdf->MultiCell(111, 5, utf8_decode($dataRequest[$Materias[$i]])."\nDocente: ".utf8_decode($dataRequest[$Docentes[$i]]), 1);
                    $y1 = $pdf->GetY(); 
                    $pdf->SetXY(117.5, $EjeY);
                    $pdf->Cell(23, 10, utf8_decode($dataRequest[$Calificaciones[$i]]), 1, 0, 'C');
                    $pdf->SetXY(140.5, $EjeY);
                    $pdf->Cell(23, 10, utf8_decode($dataRequest[$Desempeños[$i]]), 1, 0, 'C');
                    $pdf->SetXY(163.5, $EjeY);
                    $pdf->Cell(40, 10, utf8_decode($dataRequest[$Historial[$i]]), 1, 0, 'C');
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