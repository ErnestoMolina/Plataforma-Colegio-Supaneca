<div class="col-10 containerSection">
    <h1>Docentes</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertDocente" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertDocente').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirDocente">
                <i class="bi bi-plus-lg"></i> Docente
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
                        <th>Materia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Docentes as $Docente) {
                            $cont++;
                            $Documento = $Docente['NDocumentoDocente'];
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $Docente['NombresDocente'];?></td>
                                <td><?php echo $Docente['ApellidosDocente'];?></td>
                                <td><?php echo $Docente['TipoDocumentoDocente'];?></td>
                                <td><?php echo $Documento;?></td>
                                <td><?php echo $Docente['FechaNacimientoDocente'];?></td>
                                <td><?php echo $Docente['TelefonoDocente'];?></td>
                                <td><?php echo $Docente['CorreoElectronicoDocente'];?></td>
                                <td>
                                    <div class="col-12 d-flex">
                                        <?php
                                            $IdMaterias = [];
                                            if ($Docente['idMateria'] != '') {
                                                foreach ($Docente['idMateria'] as $Materia) {
                                                    array_push($IdMaterias, $Materia['IdMateria']);
                                                    echo "<div class='tagMateria'>{$Materia['NombreMateria']}</div>";
                                                };
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="idDocente" id="idDocente" value="<?php echo $Docente['IdDocente'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,<?= $Docente['IdDocente']; ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarDocente"
                                        data-nombre="<?php echo $Docente['NombresDocente'];?>"
                                        data-apellido="<?php echo $Docente['ApellidosDocente'];?>"
                                        data-tipo_documento="<?php echo $Docente['TipoDocumentoDocente'];?>"
                                        data-documento="<?php echo $Documento;?>"
                                        data-fecha_nacimiento="<?php echo $Docente['FechaNacimientoDocente'];?>"
                                        data-telefono="<?php echo $Docente['TelefonoDocente'];?>"
                                        data-email="<?php echo $Docente['CorreoElectronicoDocente'];?>"
                                        data-contraseña="<?php echo $Docente['ContraseñaDocente'];?>"
                                        data-id_docente="<?php echo $Docente['IdDocente'];?>"
                                        data-materia="<?php echo str_replace('"','',json_encode($IdMaterias));?>"

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

<!-- Modal crear Docente -->
<div class="modal fade" id="ModalAñadirDocente" role="dialog" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Docente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proyecto/views/administrador/docentes/index.php" method="POST">
                    
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreD" class="text-start">&nbsp;Nombres: </label>
                            <input type="text" class="form-control" name="nombreD" id="nombreD" placeholder ="Ingrese nombres" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="apellidoD" class="text-start">&nbsp;Apellidos: </label>
                            <input type="text" class="form-control" name="apellidoD" id="apellidoD" placeholder ="Ingrese apellidos" required>
                        </div>
                        <div class="col-6 mt-2">
                            Tipo de documento:
                            <select class="form-select" name="listaDocumentosD" id="listaDocumentosD">
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                <option value="Cedula Extranjera">Cedula Extranjera</option>
                                <option value="Pasaporte">Pasaporte</option>
                        </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="documentoD" class="text-start">&nbsp;Numero de documento: </label>
                            <input type="number" class="form-control" name="documentoD" id="documentoD" placeholder="Ingrese N° documento " required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="fechaND" class="text-start">&nbsp;Fecha de nacimiento: </label>
                            <input type="date" class="form-control" name="fechaND" id="fechaND" placeholder="Ingrese fecha de nacimiento" required>
                        </div>                        
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="telefonoD" class="text-start">&nbsp;Telefono: </label>
                            <input type="number" class="form-control" name="telefonoD" id="telefonoD" placeholder="Ingrese telefeono" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="emailD" class="text-start">&nbsp;Correo Electronico: </label>
                            <input type="email" class="form-control" name="emailD" id="emailD" placeholder="Ingrese correo electronico" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="contraseñaD" class="text-start">&nbsp;Contraseña: </label>
                            <input type="password" class="form-control" name="contraseñaD" id="contraseñaD" placeholder="Ingrese contraseña" required>
                        </div>
                        <div class="col-12 mt-2 mb-2">
                            <label style="color: rgb(0, 3, 44);" for="listaMaterias" class="text-start">&nbsp;Materias: </label>
                            <select name="listaMaterias[]" id="listaMaterias" style="width: 100%;" multiple required>
                                <?php
                                    foreach($Materias as $Materia){
                                ?>
                                    <option value="<?php echo $Materia['IdMateria']; ?>"><?php echo $Materia['NombreMateria']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="accion" value="crearDocente">
                        <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Docente -->
<div class="modal fade" id="ModalEditarDocente" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Docente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarDocente" action="/proyecto/views/administrador/docentes/index.php" method="POST">
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
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="emailD" class="text-start">&nbsp;Correo Electronico: </label>
                            <input type="email" class="form-control" name="emailD" id="emailD" placeholder="Ingrese telefeono" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="contraseñaD" class="text-start">&nbsp;Contraseña: </label>
                            <input type="password" class="form-control" name="contraseñaD" id="contraseñaD" placeholder="Ingrese contraseña" required>
                        </div>
                        <div class="col-12 mt-2 mb-2">
                            <label style="color: rgb(0, 3, 44);" for="listaMaterias" class="text-start">&nbsp;Materias: </label>
                            <select name="listaMaterias[]" id="listaMateriasE" style="width: 100%;" multiple required>
                                <?php
                                    foreach($Materias as $Materia){
                                ?>
                                    <option value="<?php echo $Materia['IdMateria']; ?>"><?php echo $Materia['NombreMateria']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="accion" value="editarDocente">
                        <input type="hidden" name="idDocente" id="idDocente" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script> 
    $(document).ready(function() {
        $('#ModalAñadirDocente').on('show.bs.modal', function(){
            $('#listaMaterias').select2({
                dropdownParent: $('#ModalAñadirDocente .modal-body')
            });
        })
    });

    $(document).ready(function() {
        $('#ModalEditarDocente').on('show.bs.modal', function(){
            $('#listaMateriasE').select2({
                dropdownParent: $('#ModalEditarDocente .modal-body')
            });
        })
    });

    function Eliminar(item, IdDocente) {
        $(`#fila${item}`).remove();
        if (confirm("Seguro que desea eliminar este campo")) {
            EliminarDB(IdDocente);
        } else {
            location.reload();
        }
    }

    function EliminarDB(IdDocente) {
        const DataParam = {
            'accion': 'eliminarDocente',
            'IdDocente': IdDocente
        };
        const url = window.location.pathname
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
                msg = `<div id="AlertDocente" class="alert alert-danger">${result.error}</div>`
            }else if(result.success){
                msg = `<div id="AlertDocente" class="alert alert-success">${result.success}</div>`
            }

            $('#containerAlert').html(msg)
            setTimeout(() => {
                $('#AlertDocente').slideUp(100)
                location.reload();
            }, 3000);
        })
    
    }
    
    $('.editarDocente').on('click', function(){
        const nombreDocente = $(this).data('nombre')
        const apellidoDocente = $(this).data('apellido')
        const tipoDocumento = $(this).data('tipo_documento')
        const documento = $(this).data('documento')
        const fechaNacimiento = $(this).data('fecha_nacimiento')
        const telefono = $(this).data('telefono')
        const email = $(this).data('email')
        const contraseñaD = $(this).data('contraseña')
        const IdDocente = $(this).data('id_docente')
        const IdMateria = $(this).data('materia')
        console.log(nombreDocente, apellidoDocente, tipoDocumento, documento, fechaNacimiento,
        telefono, email, IdDocente, IdMateria);
               
        // Asignar valores a los campos del form
        $('#formEditarDocente').find('#nombreD').val(nombreDocente)
        $('#formEditarDocente').find('#apellidoD').val(apellidoDocente)
        $('#formEditarDocente').find('#listaDocumentosD').val(tipoDocumento)
        $('#formEditarDocente').find('#documentoD').val(documento)
        $('#formEditarDocente').find('#fechaND').val(fechaNacimiento)
        $('#formEditarDocente').find('#telefonoD').val(telefono)
        $('#formEditarDocente').find('#emailD').val(email)
        $('#formEditarDocente').find('#contraseñaD').val(contraseñaD)
        $('#formEditarDocente').find('#idDocente').val(IdDocente)

        const optionMaterias = $('#formEditarDocente').find('#listaMateriasE option')
        optionMaterias.map((index, Option) => {
            const valOption = $(Option).val()
            
            if(IdMateria.includes(parseInt(valOption))){
                $(Option).prop('selected', true)
            }else{
                $(Option).prop('selected', false)
            }
        })

        // mostrar modal
        $('#ModalEditarDocente').modal('show')
    })
</script>