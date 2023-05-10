<?php
    session_start();
    include 'modules/admin/logicaPaginaWeb.php';
    $WebModel = new logica;
    $Imagenes = $WebModel->ConsultarImagenes();
    $Noticias = $WebModel->ConsultarNoticias();
    $TotalNoticias = count($Noticias);
    $limit = 6; // número de registros por página
    $total_pages = ceil($TotalNoticias / $limit); // número total de páginas
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // página actual
    $offset = ($current_page - 1) * $limit; // valor OFFSET para la consulta
    $MostrarNoticias = $WebModel->NoticiasPaginacion($limit,$offset);
    // print_r($MostrarNoticias);
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institución Educativa Supaneca</title>
    <meta name="description" content="plataforma informativa dedicada a la institucion educatica supaneca del municipiio de Tibaná del departamento de Boyaca.">
    <meta name="keywords" content="colegio,institución,supaneca,tibana">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="./libs/bootstrap-icons/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan&family=Merriweather:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan&family=Merriweather:ital,wght@1,300&family=Ubuntu:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</head>
<body style="font-family: 'League Spartan', sans-serif; font-family: 'Merriweather', serif;"
data-bs-spy="scroll" data-bs-offset="50" dat-bs-target="navbar">
<?php
     if(isset($_SESSION["Error"])){
        echo '<div class="alert alert-danger m-0">
        <strong> Error: </strong>    ';
            echo $_SESSION["Error"].'';
        echo '</div>'; 
        session_unset();
        session_destroy();
    }
    if(isset($_SESSION["usuario"])){
        echo '<div class="alert alert-success m-0">
            <strong>Exito: </strong>Se ha establecido la conexión.
        </div>';
        session_unset();
        session_destroy();
    }
?>
    <!--Navegador-->
    <?php
        include_once './views/menu.php';
    ?>
    <div class="container">
        <div class="row text-center mt-3 mb-2">
            <div class="col-lg-6 col-md-12">
                <img src="/proyecto/img/historia/reunion.jpg" class="mt-4" style="border-radius: 100%; width: 450px;">
            </div>
            <div class="col-lg-6 col-md-12 mt-4 ps-4 pe-4">
                <h3 style="font-family: fantasy;">Historia</h3>
                <p class="text-start">Hace 24 años, un grupo de líderes comunitarios de la vereda Supaneca,
                ubicada en el municipio de Tibana, se reunieron para discutir sobre la necesidad
                de brindar una educación de calidad a los niños y jóvenes de la zona rural. En
                ese entonces, los niños tenían que caminar largas distancias para asistir a la escuela
                más cercana y muchos padres no podían costear la educación privada para sus hijos.</p>
                <p  class="text-start">Fue así como, con el apoyo de la comunidad, se decidió fundar una institución
                educativa que brindara una educación integral y de calidad a los estudiantes de la
                zona. Se realizaron varias reuniones y se logró conseguir un terreno en el centro
                de la vereda para construir la escuela.</p>
            </div>
            <div class="col-lg-4 col-md-12 mt-2 ps-4">
                <p  class="text-start">Con mucho esfuerzo y trabajo comunitario, se construyeron las primeras aulas y
                se equipó la escuela con los materiales necesarios para el aprendizaje. Además, se contrataron
                docentes comprometidos y capacitados para brindar una educación de calidad a los estudiantes.</p>
            </div>
            <div class="col-lg-4 col-md-12 mt-2 ps-4">
                <p class="text-start">La institución educativa Supaneca comenzó a funcionar como una escuela primaria y
                secundaria, con el objetivo de brindar una educación integral y formar ciudadanos comprometidos con
                su comunidad y su país. A lo largo de los años, la institución ha ido creciendo y mejorando, gracias
                al apoyo de la comunidad y el compromiso de los docentes y directivos.</p>
            </div>
            <div class="col-lg-4 col-md-12 mt-2 ps-4">
                <p class="text-start">Actualmente, la institución educativa Supaneca cuenta con una amplia oferta
                académica, incluyendo programas técnicos y tecnológicos, y ha graduado a cientos de estudiantes que
                han logrado destacarse en diferentes campos y contribuir al desarrollo de su comunidad y su región.</p>
            </div>
            <div class="col-lg-1 col-md-0"></div>
            
        </div>
    </div>



 <!--Footer-->
<?php
    include './views/footer.php';
?>
<script>
    urlParams = new URLSearchParams(window.location.search);
    page = urlParams.get('page');
    console.log(page);
    setTimeout(() => {
        $(".paginacion").removeClass("active");
        $("#page"+page).addClass("active");
    }, 1000);
</script>
</body>
</html>