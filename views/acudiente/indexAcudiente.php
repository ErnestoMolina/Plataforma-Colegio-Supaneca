<?php
    session_start();
    if(!isset($_SESSION["Usuario"]))
        header('location: ../../index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acudiente</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="../../libs/bootstrap-icons/bootstrap-icons.css">
</head>
<body>
    <h2>Bienvenido acudiente <?php echo $_SESSION['Usuario'] ?></h2>
    <a href="../../modules/admin/cerrarSession.php" type="button" class="btn btn-danger">Cerrar Session</a>
</body>
</html>