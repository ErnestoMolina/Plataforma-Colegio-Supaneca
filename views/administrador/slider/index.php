<?php
    include_once '../../../controller/admin/web.php';
    $WebCTR = new Web();

    $Titulo = 'Pagina Web: slider';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'EditarImagen':
                if(isset($_FILES['Archivo'])){
                    $response = [];
                    $archivo = $_FILES['Archivo'];
                    // print_r($archivo);
                    
                    $nombre = $archivo['name'];
                    $ruta_temporal = $archivo['tmp_name'];
                    $Tipo = $archivo['type'];
                                    
                    // Obtén la información de la ruta del archivo usando pathinfo()
                    $info_archivo = pathinfo($Tipo);

                    // Obtén la extensión del archivo
                    $extension = $info_archivo['filename'];
                    $result = $WebCTR->ConsultarDireccion($_POST['idImagen']);
                    
                    switch($_POST['idImagen']){
                        case '1':
                            $nombre = '1';
                        break;
                        case '2':
                            $nombre = '3';
                        break;
                        case '3':
                            $nombre = '5';
                        break;
                        case '4':
                            $nombre = '0';
                        break;
                        default:
                            $nombre = 'default';
                    }
                    // Valida la extensión del archivo para asegurarse de que sea una imagen permitida
                    if($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png') {
                        if (file_exists('C:/MAMP/htdocs'.$result)) {
                            // Intentamos eliminar el archivo
                            if (unlink('C:/MAMP/htdocs'.$result)) {
                                // echo 'El archivo ha sido eliminado correctamente.';
                            } else {
                                // echo 'No se pudo eliminar el archivo.';
                            }
                        } else {
                            // echo 'El archivo no existe en la ruta especificada.';
                        }
                        // Mueve el archivo de la ruta temporal a una ubicación permanente en el servidor
                        $ruta_destino = 'C:/MAMP/htdocs/proyecto/img/' . $nombre.'.'.$extension;
                        if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
                            $direccion = str_replace('C:/MAMP/htdocs',"",$ruta_destino);
                            $respuesta = $WebCTR->ProcesarDireccion($direccion,$_POST['idImagen']);
                            if($respuesta['success']){
                                $response =  [ 'success' => 'El archivo se ha guardado exitosamente.'];
                            }elseif($respuesta['Error']){
                                $response =  [ 'success' => 'Error al guardar el archivo en la base de datos.'];
                            }
                        } else {
                            $response = ['error' => 'Error al guardar el archivo.'];
                        }
                    }else{
                        $response = ['error' => 'El archivo seleccionado no es una imagen válida. Por favor, selecciona una imagen en formato JPEG, PNG o GIF.'];
                    }
                    if(isset($response['error'])){
                        $mensagge = $response['error'];
                        $tipoAlert = "alert-danger";
                        if($_POST){
                            $_POST = '';
                        }
                    }elseif(isset($response['success'])){
                        $mensagge = $response['success'];
                        $tipoAlert = "alert-success";
                        if($_POST){
                            $_POST = '';
                        }
                    }
                }
            break;
        }
    }

    $Imagenes = $WebCTR->ConsultarImagenes();
    include('./views/vistaGeneral.php');