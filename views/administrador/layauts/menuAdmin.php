<div class="col-12 p-0">
    <nav class="navbar navbar-expand-sm navbar-dark sticky-top" id="Menu">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#izquierda" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#" class="navbar-brand m-0">
                <img src="/proyecto/img/escudoSinFondo.png" alt="Logo de la institución" class="rounded-circle" width="50px">
            </a>
            <a href="#" class="navbar-brand ms-2 nombreInstitucional">
                Institucion Educativa Supaneca
            </a>
            <div class="collapse navbar-collapse" id="colNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle ms-1 me-1" id="navbarDropdown" role="button"  data-bs-toggle="dropdown" aria-expanded="false">
                            Administrador / <?php echo $_SESSION['Usuario'];?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdown" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="/proyecto/views/administrador/perfil/index.php" class="dropdown-item">Mi Perfil</a>
                            </li>
                            <li>
                                <a href="http://localhost/proyecto/modules/admin/cerrarSession.php" class="dropdown-item" style=" padding-top:3px;">
                                    Cerrar Sesion <i class="bi bi-box-arrow-right" style="font-size:20px; padding-top:2px; "></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>                                                                                                                                                                                                                                                                              
    </nav>
</div>
<!-- offcanvas -->
<div class="offcanvas offcanvas-start justify-content-center" style="background:rgb(0, 3, 44)" id="izquierda">
        <div class="offcanvas-header mt-4">
            <button class="btn-close bg-secondary" type="button" data-bs-dismiss="offcanvas">
            </button>
        </div>
        <div class="offcanvas-body mt-0">
          <div class="col-6 p-10 containerSidebar " id="Menu">
                <ul class="col-12 p-0">
                    <li class="col-12">
                        <a href="../index.php" class="mb-1 mt-1">
                            Inicio
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/perfil/index.php" class="dropdown-item">
                            Mi Perfil
                        </a>
                    </li>
                    <li class="col-12 containerSubList">
                        <a href="#" class="mb-1 mt-1 subList collapseTitle">
                            Pagina WEB
                        </a>
                        <ul class="ps-3 mb-1 mt-1 collapseBody" style="display: none;">
                            <li>
                                <a href="/proyecto/views/administrador/slider/index.php" class="">Slider</a>
                            </li>
                            <li>
                                <a href="#" class="">Noticias</a>
                            </li>
                        </ul>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/materias/index.php" class="mb-1 mt-1">
                            Materias
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/docentes/index.php" class="mb-1 mt-1">
                            Docentes
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/acudientes/index.php" class="mb-1 mt-1">
                            Acudientes
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/estudiantes/index.php" class="mb-1 mt-1">
                            Estudiantes
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/cargaAcademica/index.php" class="mb-1 mt-1">
                            Carga Académica
                        </a>
                    </li>
                    <li class="col-12">
                        <a href="/proyecto/views/administrador/mantenimiento/index.php" class="mb-1 mt-1">
                            Mantenimiento
                        </a>
                    </li>
                    <li class="col-12 containerSubList">
                        <a href="#" class="mb-1 mt-1 subList collapseTitle">
                            Documentos
                        </a>
                        <ul class="ps-3 mb-1 mt-1 collapseBody" style="display: none;">
                            <li class="col-12">
                                <a href="/proyecto/views/administrador/boletines/index.php" class="mb-1 mt-1">
                                    Boletines
                                </a>
                            </li>
                            <li class="col-12">
                                <a href="/proyecto/views/administrador/boletinfinales/index.php" class="mb-1 mt-1">
                                    Informe Evaluación
                                </a>
                            </li>
                            <li class="col-12">
                                <a href="/proyecto/views/administrador/Certificados/index.php" class="mb-1 mt-1">
                                    Acta Finales
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="col-12">
                        <a href="http://localhost/proyecto/modules/admin/cerrarSession.php" class="dropdown-item" style=" padding-top:3px;">
                            Cerrar Sesion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Menu lateral -->
<div class="col-lg-2 col-md-3 p-10 containerSidebar d-none d-sm-block"  id="Menu">
    <ul class="col-12 p-0">
        <li class="col-12">
            <a href="../index.php" class="mb-1 mt-1">
                Inicio
            </a>
        </li>
        <li class="col-12 containerSubList">
            <a href="#" class="mb-1 mt-1 subList collapseTitle">
                Pagina WEB
            </a>
            <ul class="ps-3 mb-1 mt-1 collapseBody" style="display: none;">
                <li>
                    <a href="/proyecto/views/administrador/slider/index.php" class="">Slider</a>
                </li>
                <li>
                    <a href="/proyecto/views/administrador/noticias/index.php" class="">Noticias</a>
                </li>
            </ul>
        </li>
        <li class="col-12">
            <a href="/proyecto/views/administrador/materias/index.php" class="mb-1 mt-1">
                Materias
            </a>
        </li>
        <li class="col-12">
            <a href="/proyecto/views/administrador/docentes/index.php" class="mb-1 mt-1">
                Docentes
            </a>
        </li>
        <li class="col-12">
            <a href="/proyecto/views/administrador/acudientes/index.php" class="mb-1 mt-1">
                Acudientes
            </a>
        </li>
        <li class="col-12">
            <a href="/proyecto/views/administrador/estudiantes/index.php" class="mb-1 mt-1">
                Estudiantes
            </a>
        </li>
        <li class="col-12">
            <a href="/proyecto/views/administrador/cargaAcademica/index.php" class="mb-1 mt-1">
                Carga Académica
            </a>
        </li>
        <li class="col-12">
            <a href="/proyecto/views/administrador/mantenimiento/index.php" class="mb-1 mt-1">
                Mantenimiento
            </a>
        </li>
        <li class="col-12 containerSubList">
            <a href="#" class="mb-1 mt-1 subList collapseTitle">
                Documentos
            </a>
            <ul class="ps-3 mb-1 mt-1 collapseBody" style="display: none;">
                <li class="col-12">
                    <a href="/proyecto/views/administrador/boletines/index.php" class="mb-1 mt-1">
                        Boletines
                    </a>
                </li>
                <li class="col-12">
                    <a href="/proyecto/views/administrador/boletinfinales/index.php" class="mb-1 mt-1">
                        Informe Evaluación
                    </a>
                </li>
                <li class="col-12">
                    <a href="/proyecto/views/administrador/Certificados/index.php" class="mb-1 mt-1">
                        Acta Finales
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script>
    $('.collapseTitle').on('click', function(){
        $(this).toggleClass('active')
        $(this).parent().toggleClass('active')
        if($(this).hasClass('active')){
            $(this).next('.collapseBody').slideDown(200)
        }else{
            $(this).next('.collapseBody').slideUp(200)

        }
    })
</script>