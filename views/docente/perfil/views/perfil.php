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
            <form action="/proyecto/views/administrador/perfil/index.php" method="POST">
                <div class="row">
                <?php
                    $IdDocente = $_SESSION['Id'];
                    $DatosDocente = $DocenteCTR->ConsultarDocentes('IdDocente = '.$IdDocente,'D.*');
                    foreach($DatosDocente as $Dato){
                ?>
                    <div class="col text-end">
                        <!-- Boton del modal -->
                        <button type="button" id="btnEditarAdmin" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditarDatos"
                        data-nombre="<?php echo $Dato['NombresDocente']; ?>"
                        data-apellido="<?php echo $Dato['ApellidosDocente']; ?>"
                        data-tipo_documento="<?php echo $Dato['TipoDocumentoDocente']; ?>"
                        data-documento="<?php echo $Dato['NDocumentoDocente']; ?>"
                        data-fecha="<?php echo $Dato['FechaNacimientoDocente']; ?>"
                        data-telefono="<?php echo $Dato['TelefonoDocente']; ?>"
                        data-email="<?php echo $Dato['CorreoElectronicoDocente']; ?>"
                        data-id_admin="<?php echo $Dato['IdDocente']; ?>">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </button>
                    </div>
                </div>
                <input type="hidden" name="idAdmin" value="<?php echo $Dato['IdDocente']; ?>">
                <p style="font-size: 18px;"><strong>Nombres:</strong> <i> <?php echo $Dato['NombresDocente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Apellidos:</strong> <i><?php echo $Dato['ApellidosDocente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Tipo de documento:</strong><i> <?php echo $Dato['TipoDocumentoDocente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Numero de documento:</strong> <i><?php echo $Dato['NDocumentoDocente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Fecha de nacimiento:</strong> <i><?php echo $Dato['FechaNacimientoDocente']; ?></i></p>
                <p style="font-size: 18px;"><strong>Telefono:</strong> <i><?php echo $Dato['TelefonoDocente']; ?></p>
                <p style="font-size: 18px;"><strong>Correo Electronico:</strong><i> <?php echo $Dato['CorreoElectronicoDocente']; ?></i></p>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Materia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarAdmin" action="/proyecto/views/docente/perfil/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreD" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreD" id="nombreD" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="apellidoD" class="text-start">&nbsp;Apellido: </label>
                            <input type="text" class="form-control" name="apellidoD" id="apellidoD" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaDocumentosD" class="text-start">&nbsp;Tipo de documento: </label>
                            <select class="form-select" name="listaDocumentosD" id="listaDocumentosD">
                                <option value="">--Seleccionar--</option>
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                <option value="Cedula Extranjera">Cedula Extranjera</option>
                                <option value="Pasaporte">Pasaporte</option>
                        </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="documentoD" class="text-start">&nbsp;Numero de documento: </label>
                            <input type="number" class="form-control" name="documentoD" id="documentoD" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="fechaND" class="text-start">&nbsp;Fecha de nacimiento: </label>
                            <input type="date" class="form-control" name="fechaND" id="fechaND" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="telefonoD" class="text-start">&nbsp;Telefono: </label>
                            <input type="number" class="form-control" name="telefonoD" id="telefonoD" placeholder="Ingrese telefeono" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="emailD" class="text-start">&nbsp;Correo Electronico: </label>
                            <input type="email" class="form-control" name="emailD" id="emailD" placeholder="Ingrese telefeono" required>
                        </div>
                        <!-- <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="contraseñaD" class="text-start">&nbsp;Contraseña: </label>
                            <input type="password" class="form-control" name="contraseñaD" id="contraseñaD" placeholder="Ingrese contraseña" required>
                        </div> -->
                        <input type="hidden" name="accion" value="editarDatos">
                        <input type="hidden" name="idDocente" id="idDocente" value="">
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
        const IdAdmin = $(this).data('id_admin')
        console.log(nombreAdmin,apellidoAdmin,TipoDocumento,documento,fecha,telefono,email,IdAdmin);
        
        // Asignar valores a los campos del form
        $('#ModalEditarDatos').find('#nombreD').val(nombreAdmin)
        $('#ModalEditarDatos').find('#apellidoD').val(apellidoAdmin)
        $('#ModalEditarDatos').find('#listaDocumentosD').val(TipoDocumento)
        $('#ModalEditarDatos').find('#documentoD').val(documento)
        $('#ModalEditarDatos').find('#fechaND').val(fecha)
        $('#ModalEditarDatos').find('#telefonoD').val(telefono)
        $('#ModalEditarDatos').find('#emailD').val(email)
        $('#ModalEditarDatos').find('#idDocente').val(IdAdmin)

    })
</script>