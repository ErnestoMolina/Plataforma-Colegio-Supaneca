<div class="col-10 containerSection">
    <h1>Acudientes</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertAcudiente" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertAcudiente').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirAcudiente">
                <i class="bi bi-plus-lg"></i> Acudiente
            </button>
        </div>
    </div>

    
   <div class="container mt-3 mb-3">
        <div class="table-responsive">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tipo De Documento</th>
                        <th>Numero Documento</th>
                        <th>Fecha De Nacimiento</th>
                        <th>Telefono</th>
                        <th>Correo Electronico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Acudientes as $Acudiente) {
                            $cont++;
                            $Documento = $Acudiente['NDocumentoAcudiente'];
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $Acudiente['NombresAcudiente'];?></td>
                                <td><?php echo $Acudiente['ApellidosAcudiente'];?></td>
                                <td><?php echo $Acudiente['TipoDocumentoAcudiente'];?></td>
                                <td><?php echo $Documento;?></td>
                                <td><?php echo $Acudiente['FechaNacimientoAcudiente'];?></td>
                                <td><?php echo $Acudiente['TelefonoAcudiente'];?></td>
                                <td><?php echo $Acudiente['CorreoElectronicoAcudiente'];?></td>
                                <td>
                                    <input type="hidden" name="contraseñaA" id="contraseñaA" value="<?php echo $Acudiente['ContraseñaAcudiente'];?>">
                                    <input type="hidden" name="idacudiente" id="idacudiente" value="<?php echo $Acudiente['IdAcudiente'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,<?= $Acudiente['IdAcudiente']; ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarAcudiente"
                                        data-nombre="<?php echo $Acudiente['NombresAcudiente'];?>"
                                        data-apellido="<?php echo $Acudiente['ApellidosAcudiente'];?>"
                                        data-tipo_documento="<?php echo $Acudiente['TipoDocumentoAcudiente'];?>"
                                        data-documento="<?php echo $Documento;?>"
                                        data-fecha_nacimiento="<?php echo $Acudiente['FechaNacimientoAcudiente'];?>"
                                        data-id_acudiente="<?php echo $Acudiente['IdAcudiente'];?>"
                                        data-contraseña="<?php echo $Acudiente['ContraseñaAcudiente'];?>"
                                        data-telefono="<?php echo $Acudiente['TelefonoAcudiente'];?>"
                                        data-email="<?php echo $Acudiente['CorreoElectronicoAcudiente'];?>"

                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
   </div>

</div>

<!-- Modal crear acudiente -->
<div class="modal fade" id="ModalAñadirAcudiente" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Acudiente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proyecto/views/administrador/acudientes/index.php" method="POST">
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
                            Tipo de documento:
                            <select class="form-select" name="listaDocumentosA" id="listaDocumentosA">
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
                            <input type="date" class="form-control" name="fechaNA" id="fechaNA" placeholder="Ingrese fecha de nacimiento" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="telefonoA" class="text-start">&nbsp;Telefono: </label>
                            <input type="number" class="form-control" name="telefonoA" id="telefonoA" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="emailA" class="text-start">&nbsp;Correo electronico: </label>
                            <input type="text" class="form-control" name="emailA" id="emailA" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="contraseñaA" class="text-start">&nbsp;Contraseña: </label>
                            <input type="password" class="form-control" name="contraseñaA" id="contraseñaA" required>
                        </div>
                        <input type="hidden" name="accion" value="crearAcudiente">
                        <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar acudiente -->
<div class="modal fade" id="ModalEditarAcudiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Acudiente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarAcudiente" action="/proyecto/views/administrador/acudientes/index.php" method="POST">
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
                            <input type="number" class="form-control" name="telefonoA" id="telefonoA" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="emailA" class="text-start">&nbsp;Correo electronico: </label>
                            <input type="text" class="form-control" name="emailA" id="emailA" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="contraseñaA" class="text-start">&nbsp;Contraseña: </label>
                            <input type="password" class="form-control" name="contraseñaA" id="contraseñaA" required>
                        </div>
                        <input type="hidden" name="accion" value="editarAcudiente">
                        <input type="hidden" name="idAcudiente" id="idAcudiente" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal Estudiantes del acudiente -->
<div class="modal fade" id="EstrudiantesAcudiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mt-2 text-center">
                        <span>Para eliminar el acudiente debe eliminar primero los siguientes estudiantes, ya que pertenece al acudiente</h1>    
                    </div>
                    <div class="col-12 mt-2">
                        <ul id="listEstudiantes"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const url = window.location.pathname;
        
    async function Eliminar (item, IdAcudiente) {
        const EstudiantesAcudiente = await validarEstudiantesAsociados(IdAcudiente);
        // console.log(EstudiantesAcudiente);
        if(EstudiantesAcudiente.length > 0){
            $('#listEstudiantes').html('');
            const listEstudiantes = $('#listEstudiantes');
            EstudiantesAcudiente.map((Estudiante, index) => {
                const liEstudiante = `<li>${Estudiante}</li>`;
                listEstudiantes.append(liEstudiante);
            });

            $('#EstrudiantesAcudiente').modal('show')
        }else{
            if(confirm('¿Seguro que desea eliminar este campo?'))
                EliminarDB(IdAcudiente, item);
            }
    }

    function EliminarDB(IdAcudiente, item) {
        const DataParam = {
            'accion': 'eliminarAcudiente',
            'IdAcudiente': IdAcudiente
        };
        fetch(url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(DataParam)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result)
            let msg = '';
            if(result.error){
                msg = `<div id="AlertAcudiente" class="alert alert-danger">${result.error}</div>`
            }else if(result.success){
                $(`#fila${item}`).remove();
                msg = `<div id="AlertAcudiente" class="alert alert-success">${result.success}</div>`
            }

            $('#containerAlert').html(msg)
            setTimeout(() => {
                $('#AlertAcudiente').slideUp(100)
                window.location.href = url;
            }, 3000);
        })
    
    }
    
    function validarEstudiantesAsociados(IdAcudiente) {
        const DataParam = {
            'accion': 'validarEstudiantesAsociados',
            'IdAcudiente': IdAcudiente
        };
        return fetch(url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(DataParam)
        })
        .then(response => response.json())
        .then(result => {
            const Estudiantes = result;
            const NombreEstudiantes = Estudiantes.map((Estudiante, index) => {
                return `${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}`;
            })

            return NombreEstudiantes;
        })
    
    }

    $('.editarAcudiente').on('click', function(){
        const nombreAcudiente = $(this).data('nombre')
        const apellidoAcudiente = $(this).data('apellido')
        const tipoDocumento = $(this).data('tipo_documento')
        const documento = $(this).data('documento')
        const fechaNacimiento = $(this).data('fecha_nacimiento')
        const IdAcudiente = $(this).data('id_acudiente')
        const contraseña = $(this).data('contraseña')
        const telefono = $(this).data('telefono')
        const email = $(this).data('email')
        console.log(nombreAcudiente, apellidoAcudiente, tipoDocumento, documento, fechaNacimiento, IdAcudiente, telefono, email);
        
        // Asignar valores a los campos del form
        $('#formEditarAcudiente').find('#nombreA').val(nombreAcudiente)
        $('#formEditarAcudiente').find('#apellidoA').val(apellidoAcudiente)
        $('#formEditarAcudiente').find('#listaDocumentosA').val(tipoDocumento)
        $('#formEditarAcudiente').find('#documentoA').val(documento)
        $('#formEditarAcudiente').find('#fechaNA').val(fechaNacimiento)
        $('#formEditarAcudiente').find('#idAcudiente').val(IdAcudiente)
        $('#formEditarAcudiente').find('#contraseñaA').val(contraseña)
        $('#formEditarAcudiente').find('#telefonoA').val(telefono)
        $('#formEditarAcudiente').find('#emailA').val(email)

        // mostrar modal
        $('#ModalEditarAcudiente').modal('show')
    })

    function VerificacionTextos(){
        if(!((event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32))){
            event.preventDefault()
        }
    }
</script>