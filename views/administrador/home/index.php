<?php
    include_once '../../controller/admin/homePerfil.php';
    $WebCTR = new Web();
    $Imagenes = $WebCTR->ConsultarImagenes();
    $Noticias = $WebCTR->ConsultarNoticias('');
    $TotalNoticias = count($Noticias);
    $limit = 6; // número de registros por página
    $total_pages = ceil($TotalNoticias / $limit); // número total de páginas
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // página actual
    $offset = ($current_page - 1) * $limit; // valor OFFSET para la consulta
    $MostrarNoticias = $WebCTR->NoticiasPaginacion($limit,$offset);
    // print_r($MostrarNoticias);
?>
<div class="col-lg-10 col-md-9 containerSection">
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
                        <?php
                            $cont = 0;
                            foreach($Imagenes as $Imagen){
                                $cont++;
                            
                        ?>
                            <div class="carousel-item active">
                                <img src="<?php echo $Imagen['Direccion'];?>" class="d-block w-100" alt="" style="max-height: 65vh">
                            </div>
                        <?php
                                if($cont == 4){
                                    break;
                                }
                            }
                        ?>
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
            <div class="col-md-3 texto_alucivo">
                <i class="bi bi-book"></i>
                <p> Tenemos a los mejores educadores para su hijo, 
                    acérquese a nuestras instalaciones, allí podrá 
                    realizar la matrícula de sus hijos, 
                    !Aprovecha! Todavía tenemos cupos disponibles.</p>
            </div>
            <div class="col-md-3 texto_alucivo">
                <i class="bi bi-bar-chart-fill"></i>
                <p>Les ofrecemos a padres y acudientes un aplicativo
                    web con el cual podrán estar pendientes del
                    desempeño académico de sus hijos.</p>
            </div>  
            <div class="col-md-3 texto_alucivo">
                <i class="bi bi-key-fill"></i>
                <p>La clave para mejorar la educación es trabajar
                    de la mano con padres, docentes y estudiantes,
                    comprometiéndonos para que nos jóvenes tengan
                    acceso a la educación superior.</p>
            </div>
        </div>
    </div>
    <hr id="noticias">
    <!--Noticias-->
    <div class="container">
        <div class="row mb-3 mt-2 justify-content-center ">
            <h2 style="padding-left:7%;">Noticias</h2>
                <div class="row" id="content">
                    <?php
                        foreach($MostrarNoticias as $Noticia){
                    ?>
                    <div class="col-md-6 col-lg-4 mt-2 mb-2 noticia">
                        <div class="card" style="width: 100%;">
                            <div class="card-header">
                                <img src="<?= $Noticia['Imagen'];?>" class="card-img imagenNoticia w-100">
                                <h6 class="mt-1" style="text-decoration: underline rgb(0, 3, 122)  3px;"><strong><?= $Noticia['Titulo'];?></strong></h6>
                                <div class="descripcionNoticia">
                                    <p><?= $Noticia['Descripcion'];?></p>
                                </div>
                                <p class="fechaNoticia" style="font-size: 12px;"><strong>Publicado: <?= $Noticia['Fecha'];?></strong></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="d-flex justify-content-center mb-2 mt-3" id="pagination">
                    <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<a type="button" id="page'.$i.'" class="btn btn-dark m-1 paginacion"
                            href="?page=' . $i . '#noticias">' . $i . '</a>';
                        }
                    ?>
                </div>
        </div>    
    </div>
</div>
<script>
    urlParams = new URLSearchParams(window.location.search);
    page = urlParams.get('page');
    console.log(page);
    setTimeout(() => {
        $(".paginacion").removeClass("active");
        $("#page"+page).addClass("active");
    }, 1000);
</script>
