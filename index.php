<?php
    session_start();

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
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="./libs/bootstrap-icons/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan&family=Merriweather:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan&family=Merriweather:ital,wght@1,300&family=Ubuntu:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
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
<!--carusel-->
    <div id="inicio" class="row justify-content-center">
        <div class="col-12">
            <div id="slider" class="carousel slider" data-bs-ride="carousel">
                <!--Indicadores del carrusel-->
                <div class="carousel-indicators">
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#slider" data-bs-slide-to="3"></button>
                    </div>
                 
                        <!--las imagenes del carrusel/slider/sliderShow-->
                        
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./img/1.jpg" class="d-block w-100" alt="" style="max-height: 65vh">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/3.jpg" class="d-block w-100" alt="" style="max-height: 65vh">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/5.jpg" class="d-block w-100" alt="" style="max-height: 65vh">
                    </div>
                    <di class="carousel-item">
                        <img src="./img/0.jpg" class="d-block w-100" alt="" style="max-height: 65vh">
                    </di>
                    <!-- <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./img/slider2/0.jpg" class="d-block w-100" alt="" style="border-radius:10%;">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/slider2/1.jpg" class="d-block w-100" alt="" style="border-radius:10%;">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/slider2/2.jpg" class="d-block w-100" alt="" style="border-radius:10%;">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/slider2/books-4158244__340.webp" class="d-block w-100" style="border-radius:10%;" alt="">
                        </div> -->
                <!-- imagenes carrusel --> 
                </div>
                <!-- Controladores izquierda derecha -->
                <button class="carousel-control-prev" type="button"
                data-bs-target="#slider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button"
                data-bs-target="#slider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>
<!--Contenido alucivo al proyecto-->
<div id="texto_alucivo" class="conteiner mt-5">
    <div class="row justify-content-center text-center g-4">
        <div class="col-md-3 ">
            <i class="bi bi-book"></i>
            <p> Tenemos a los mejores educadores para su hijo, 
                acérquese a nuestras instalaciones, allí podrá 
                realizar la matrícula de sus hijos, 
                !Aprovecha! Todavía tenemos cupos disponibles.</p>
        </div>
        <div class="col-md-3">
            <i class="bi bi-bar-chart-fill"></i>
            <p>Les ofrecemos a padres y acudientes un aplicativo
                web con el cual podrán estar pendientes del
                desempeño académico de sus hijos.</p>
        </div>  
        <div id="noticias" class="col-md-3">
            <i class="bi bi-key-fill"></i>
            <p>La clave para mejorar la educación es trabajar
                de la mano con padres, docentes y estudiantes,
                comprometiéndonos para que nos jóvenes tengan
                acceso a la educación superior.</p>
        </div>
    </div>
</div>
<!--Noticias-->
    <div class="container">
        <div class="row mb-3 mt-2 justify-content-center ">
            <h2 style="padding-left:3%;">Noticias</h2>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <div class="card" style="width: 100%; ">
                            <div class="card-header">
                                <img src="./img/0.jpg" alt="" class="card-img">
                                <h5 class="mt-1" style="text-decoration: underline rgb(0, 3, 122)  3px;"><strong>Este es el titulo</strong></h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque pariatur 
                                repellendus placeat tempore provident dolores in fugit.</p>
                                <a href="#" style="text-decoration: none;"><strong>Leer mas</strong> <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="card" style="width: 100%; ">
                            <div class="card-header">
                                <img src="./img/1.jpg" alt="" class="card-img">
                                <h5 class="mt-1" style="    "><strong>Este es el titulo</strong></h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque pariatur 
                                repellendus placeat tempore provident dolores in fugit.</p>
                                <a href="#" style="text-decoration: none;"><strong>Leer mas</strong> <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <div class="card" style="width: 100%; ">
                            <div class="card-header">
                                <img src="./img/5.jpg" alt="" class="card-img">
                                <h5 class="mt-1" style="text-decoration: underline rgb(0, 3, 122) 3px;"><strong>Este es el titulo</strong></h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque pariatur 
                                repellendus placeat tempore provident dolores in fugit.</p>
                                <a href="#" style="text-decoration: none;"><strong>Leer mas</strong> <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>    

    </div>



 <!--Footer-->
<?php
    include './views/footer.php';
?>
</body>
</html>