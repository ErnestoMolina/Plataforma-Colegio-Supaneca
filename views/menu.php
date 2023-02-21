<nav class="navbar navbar-expand-sm navbar-dark sticky-top p-1" id="Menu">
        <div class="container-fluid">
            <a href="#" class="navbar-brand m-0">
                <img src="./img/escudoSinFondo.png" alt="Logo de la institución" class="rounded-circle" width="50px">
            </a>
            <button class="navbar-toggler" type="button" 
            data-bs-toggle="collapse" data-bs-target="#colNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="colNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active ms-1 me-1" aria-current="page">
                        <a href="#inicio" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item text-white ms-1 me-1">
                        <a href="#noticias" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle ms-1 me-1" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nosotros
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropdown" aria-labelledby="navbarDropdown">
                            <li><a href="#" class="dropdown-item">Directiva.</a></li>
                            <li><a href="/proyecto/media/documentos/manual_de_convivencia.pdf" target="_black" hr class="dropdown-item">Manual de convivencia.</a></li>
                        </ul>
                    </li>
                    <li class="nav-item text-white ms-1 me-1">
                        <a href="#" class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#derecho">Login</a>
                    </li>
                </ul>
            </div>
        </div>                                                                                                                                                                                                                                                                              
    </nav>
<!-- sidebar-->    
    <div class="offcanvas offcanvas-end justify-content-center text-center" style="background:rgb(0, 3, 44)" id="derecho">
        <div class="offcanvas-header mt-4">
            <button class="btn-close bg-secondary" type="button" data-bs-dismiss="offcanvas">
            </button>
        </div>
        <div class="offcanvas-body mt-0">
                <form action="http://localhost/proyecto/modules/admin/login.php" method="post" class="mt-5">
                    <h2 class="text-center text-white">Inicio de sesión</h2>
                        <div class="form-floating mt-5">
                            <input type="email" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su Email" required>
                            <label style="color: rgb(0, 3, 44);" for="email">Email  <i class="bi-person-fill"></i></label>
                        </div>
                    <div class="form-floating mt-2">
                        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese su Contraseña" required>
                        <label style="color: rgb(0, 3, 44);" for="password">Password  <i class="bi-shield-lock-fill"></i></label>
                    </div>
                <br>
            <input class="btn btn-outline-secondary text-white" type="submit" name="enviar" value="Iniciar sesión.">
            </form><br><br>
        </div>
    </div>