<div class="col-10 containerSection">
    <h1>Mi Perfil</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertAdmin" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertAdmin').slideUp(300)
                    }, 5000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            
        </div>
    </div>

    <div class="row">
        <div class="col ms-5">
            <form action="/proyecto/views/Acudiente/perfil/index.php" method="POST">
                <div class="row">
                <?php
                    $IdAcudiente = $_SESSION['Id'];
                    $DatosAcudiente = $AcudienteCTR->ConsultarAcudientePerfil('IdAcudiente = '.$IdAcudiente);
                    foreach($DatosAcudiente as $Dato){
                ?>
                    <div class="col text-end">
                        <!-- Boton del modal -->
                        <button type="button" id="btnEditarAdmin" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditarDatos"
                        data-nombre="<?php echo $Dato['NombresAcudiente']; ?>"
                        data-apellido="<?php echo $Dato['ApellidosAcudiente']; ?>"
                        data-tipo_documento="<?php echo $Dato['TipoDocumentoAcudiente']; ?>"
                        data-documento="<?php echo $Dato['NDocumentoAcudiente']; ?>"
                        data-fecha="<?php echo $Dato['FechaNacimientoAcudiente']; ?>"
                        data-telefono="<?php echo $Dato['TelefonoAcudiente']; ?>"
                        data-email="<?php echo $Dato['CorreoElectronicoAcudiente']; ?>"
                        data-id_admin="<?php echo $Dato['IdAcudiente']; ?>">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </button>
                    </div>
                </div>
                <input type="hidden" name="idAdmin" value="<?php echo $Dato['IdDocente']; ?>">
                <p style="font-size: 18px;"><strong>Nombres:</strong> <i> <?php echo $Dato['NombresAcudiente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Apellidos:</strong> <i><?php echo $Dato['ApellidosAcudiente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Tipo de documento:</strong><i> <?php echo $Dato['TipoDocumentoAcudiente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Numero de documento:</strong> <i><?php echo $Dato['NDocumentoAcudiente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Fecha de nacimiento:</strong> <i><?php echo $Dato['FechaNacimientoAcudiente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Telefono:</strong> <i><?php echo $Dato['TelefonoAcudiente']; ?></p>
                <p style="font-size: 18px;"><strong>Correo Electronico:</strong><i> <?php echo $Dato['CorreoElectronicoAcudiente']; ?></i></p>
                <?php
                    }
                ?>
            </form>
        </div>
    </div>
</div>


<!-- Modal Editar Datos -->
<div class="modal fade" id="ModalEditarDatos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Datos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarAdmin" action="/proyecto/views/acudiente/perfil/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreA" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreA" id="nombreA" onKeypress="VerificacionTextos()" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="apellidoA" class="text-start">&nbsp;Apellido: </label>
                            <input type="text" class="form-control" name="apellidoA" id="apellidoA" onKeypress="VerificacionTextos()" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaDocumentosA" class="text-start">&nbsp;Tipo de documento: </label>
                            <select class="form-select" name="listaDocumentosA" id="listaDocumentosA">
                                <option value="">--Seleccionar--</option>
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                <option value="Cedula Extranjera">Cedula Extranjera</option>
                                <option value="Pasaporte">Pasaporte</option>
                        </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="documentoA" class="text-start">&nbsp;Numero de documento: </label>
                            <input type="number" class="form-control" name="documentoA" id="documentoA" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="fechaNA" class="text-start">&nbsp;Fecha de nacimiento: </label>
                            <input type="date" class="form-control" name="fechaNA" id="fechaNA" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="telefonoA" class="text-start">&nbsp;Telefono: </label>
                            <input type="number" class="form-control" name="telefonoA" id="telefonoA" placeholder="Ingrese telefeono" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="emailA" class="text-start">&nbsp;Correo Electronico: </label>
                            <input type="email" class="form-control" name="emailA" id="emailA" placeholder="Ingrese telefeono" required>
                        </div>
                        <!-- <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="contraseñaD" class="text-start">&nbsp;Contraseña: </label>
                            <input type="password" class="form-control" name="contraseñaD" id="contraseñaD" placeholder="Ingrese contraseña" required>
                        </div> -->
                        <input type="hidden" name="accion" value="editarDatos">
                        <input type="hidden" name="idAcudiente" id="idAcudiente" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   const url = window.location.pathname;
        
   
    $('#btnEditarAdmin').on('click', function(){
        const nombreAdmin = $(this).data('nombre')
        const apellidoAdmin = $(this).data('apellido')
        const TipoDocumento = $(this).data('tipo_documento')
        const documento = $(this).data('documento')
        const fecha = $(this).data('fecha')
        const telefono = $(this).data('telefono')
        const email = $(this).data('email')
        const contraseña = $(this).data('contraseña')
        const materia = $(this).data('materia')
        const IdAcudiente = $(this).data('id_admin')
        console.log(nombreAdmin,apellidoAdmin,TipoDocumento,documento,fecha,telefono,email,IdAcudiente);
        
        // Asignar valores a los campos del form
        $('#ModalEditarDatos').find('#nombreA').val(nombreAdmin)
        $('#ModalEditarDatos').find('#apellidoA').val(apellidoAdmin)
        $('#ModalEditarDatos').find('#listaDocumentosA').val(TipoDocumento)
        $('#ModalEditarDatos').find('#documentoA').val(documento)
        $('#ModalEditarDatos').find('#fechaNA').val(fecha)
        $('#ModalEditarDatos').find('#telefonoA').val(telefono)
        $('#ModalEditarDatos').find('#emailA').val(email)
        $('#ModalEditarDatos').find('#idAcudiente').val(IdAcudiente)

    })

    function VerificacionTextos(){
        if(!((event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32))){
            event.preventDefault()
        }
    }
</script>