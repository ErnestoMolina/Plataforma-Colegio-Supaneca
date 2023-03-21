<?php
    session_start();
    if(!isset($_SESSION["Usuario"]) || (isset($_SESSION['typeUser']) && $_SESSION['typeUser'] != 'Admin')){
        header('location: http://localhost/proyecto/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $Titulo ?? 'inicio';?></title>
    <meta name="description" content="Pagina administrativa controlada por un administrador de la pagina.">
    <link rel="stylesheet" href="/proyecto/css/bootstrap.min.css">
    <link rel="stylesheet" href="/proyecto/index.css">
    <link rel="stylesheet" href="/proyecto/libs/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/proyecto/libs/select2/dist/css/select2.min.css">
    
    <script src="/proyecto/js/jquery-3.6.1.min.js"></script>
    <script src="/proyecto/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="/proyecto/libs/select2/dist/js/select2.min.js"></script>

    <script>
        $(function(){
            $("#tabla").DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>

</head>
<body>
    <div class="row m-0">
        <?php
            include_once 'menuAdmin.php';
        ?>