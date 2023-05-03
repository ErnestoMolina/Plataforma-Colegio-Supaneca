<?php
    include_once '../../../controller/admin/web.php';
    $WebCTR = new Web();

    $Titulo = 'Pagina Web: Noticias';
    $mensagge = '';
    $tipoAlert = '';

    $dataRequest = json_decode(file_get_contents("php://input"), true);
    if(isset($_POST['accion']) || isset($dataRequest['accion'])){
        $accion = $_POST['accion'] ?? $dataRequest['accion'];
        switch($accion){
            case 'eliminarNoticia':
                $DatosNoticia = $WebCTR->ConsultarNoticias('Id = '.$dataRequest['IdNoticia']);
                foreach($DatosNoticia as $DatoNoticia){
                    $imagen = $DatoNoticia['Imagen'];
                }
                if(file_exists('C:/MAMP/htdocs'.$imagen)) {
                    // Intentamos eliminar el archivo
                    if(unlink('C:/MAMP/htdocs'.$imagen)) {
                        // echo 'El archivo ha sido eliminado correctamente.';
                    }else {
                        // echo 'No se pudo eliminar el archivo.';
                    }
                }else {
                    // echo 'El archivo no existe en la ruta especificada.';
                }
                $response = $WebCTR->EliminarNoticia($dataRequest['IdNoticia']);
                echo $response = json_encode($response);
                return false;
            break;
            case 'EditarNoticia':
                if($_FILES['imagen']['name'] != ''){
                    $response = [];
                    $archivo = $_FILES['imagen'];
                    // print_r($archivo);
                    
                    $nombre = 'Noticia';
                    $nombre = 'Noticia'.time();
                    $ruta_temporal = $archivo['tmp_name'];
                    $Tipo = $archivo['type'];
                    
                    // Obtén la información de la ruta del archivo usando pathinfo()
                    $info_archivo = pathinfo($Tipo);
                    
                    // Obtén la extensión del archivo
                    $extension = $info_archivo['filename'];
                    $DatosNoticia = $WebCTR->ConsultarNoticias('Id = '.$_POST['idNoticia']);
                    foreach($DatosNoticia as $DatoNoticia){
                        $imagen = $DatoNoticia['Imagen'];
                    }
                    // Valida la extensión del archivo para asegurarse de que sea una imagen permitida
                    if($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png') {
                        if (file_exists('C:/MAMP/htdocs'.$imagen)) {
                            // Intentamos eliminar el archivo
                            if (unlink('C:/MAMP/htdocs'.$imagen)) {
                                // echo 'El archivo ha sido eliminado correctamente.';
                            } else {
                                // echo 'No se pudo eliminar el archivo.';
                            }
                        } else {
                            // echo 'El archivo no existe en la ruta especificada.';
                        }
                        // Mueve el archivo de la ruta temporal a una ubicación permanente en el servidor
                        $ruta_destino = 'C:/MAMP/htdocs/proyecto/img/noticias/' . $nombre.'.'.$extension;
                        if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
                            $direccion = str_replace('C:/MAMP/htdocs',"",$ruta_destino);
                            $respuesta = $WebCTR->EditarNoticia($direccion,$_POST);
                            if(isset($respuesta['success'])){
                                $response =  $respuesta;
                            }elseif(isset($respuesta['Error'])){
                                $response =  $respuesta;
                            }
                        } else {
                            $response = ['Error' => 'Error al guardar el archivo.'];
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
                }else{
                    $response = $WebCTR->EditarNoticia($_POST['direccion'],$_POST);
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
            case 'crearNoticia':
                // echo 'hola';
                if(isset($_FILES['imagen'])){
                    $response = [];
                    $archivo = $_FILES['imagen'];
                    // print_r($archivo);
                    
                    $nombre = 'Noticia';
                    $nombre = 'Noticia'.time();
                    $ruta_temporal = $archivo['tmp_name'];
                    $Tipo = $archivo['type'];
                                    
                    // Obtén la información de la ruta del archivo usando pathinfo()
                    $info_archivo = pathinfo($Tipo);

                    // Obtén la extensión del archivo
                    $extension = $info_archivo['filename'];
                    // Valida la extensión del archivo para asegurarse de que sea una imagen permitida
                    if($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png') {
                        // Mueve el archivo de la ruta temporal a una ubicación permanente en el servidor
                        $ruta_destino = 'C:/MAMP/htdocs/proyecto/img/noticias/' . $nombre.'.'.$extension;
                        if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
                            $direccion = str_replace('C:/MAMP/htdocs',"",$ruta_destino);
                            $respuesta = $WebCTR->ProcesarNoticia($direccion,$_POST);
                            if(isset($respuesta['success'])){
                                $response =  $respuesta;
                            }elseif(isset($respuesta['Error'])){
                                $response =  $respuesta;
                            }
                        } else {
                            $response = ['Error' => 'Error al guardar el archivo.'];
                        }
                    }else{
                        $response = ['Error' => 'El archivo seleccionado no es una imagen válida. Por favor, selecciona una imagen en formato JPEG, PNG o GIF.'];
                    }
                    if(isset($response['Error'])){
                        $mensagge = $response['Error'];
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

    $Noticias = $WebCTR->ConsultarNoticias('');
    include('./views/vistaGeneral.php');