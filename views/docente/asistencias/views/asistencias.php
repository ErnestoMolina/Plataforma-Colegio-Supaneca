<div class="col-10 containerSection">
    <h1>Asistencias</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertEstudiante" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertEstudiante').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirEstudiante">
                <i class="bi bi-plus-lg"></i> Estudiante
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
                        <th>Grado</th>
                        <th>Acudiente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Estudiantes as $Estudiante) {
                            $cont++;
                            $Documento = $Estudiante['NDocumentoEstudiante'];
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $Estudiante['NombresEstudiante'];?></td>
                                <td><?php echo $Estudiante['ApellidosEstudiante'];?></td>
                                <td><?php echo $Estudiante['TipoDocumentoEstudiante'];?></td>
                                <td><?php echo $Documento;?></td>
                                <td><?php echo $Estudiante['FechaNacimientoEstudiante'];?></td>
                                <td><?php echo $Estudiante['GradoEstudiante'];?></td>
                                <td><?php echo $Estudiante['NombresAcudiente'].' '.$Estudiante['ApellidosAcudiente'];?></td>
                                <td>
                                    <input type="hidden" name="idEstudiante" id="idEstudiante" value="<?php echo $Estudiante['IdEstudiante'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,<?= $Documento; ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarEstudiante"
                                        data-nombre="<?php echo $Estudiante['NombresEstudiante'];?>"
                                        data-apellido="<?php echo $Estudiante['ApellidosEstudiante'];?>"
                                        data-tipo_documento="<?php echo $Estudiante['TipoDocumentoEstudiante'];?>"
                                        data-documento="<?php echo $Documento;?>"
                                        data-fecha_nacimiento="<?php echo $Estudiante['FechaNacimientoEstudiante'];?>"
                                        data-grado="<?php echo $Estudiante['GradoEstudiante'];?>"
                                        data-id_estudiante="<?php echo $Estudiante['IdEstudiante'];?>"
                                        data-id_acudiente="<?php echo $Estudiante['idAcudiente'];?>"

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

<!-- Modal crear estudiante -->
<div class="modal fade" id="ModalAñadirEstudiante" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Matricular Estudiante</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proyecto/views/administrador/estudiantes/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreE" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreE" id="nombreE" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="apellidoE" class="text-start">&nbsp;Apellido: </label>
                            <input type="text" class="form-control" name="apellidoE" id="apellidoE" required>
                        </div>
                        <div class="col-6 mt-2">
                            Tipo de documento:
                            <select class="form-select" name="listaDocumentosE" id="listaDocumentosE">
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                <option value="Cedula Extranjera">Cedula Extranjera</option>
                                <option value="Pasaporte">Pasaporte</option>
                        </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="documentoE" class="text-start">&nbsp;Numero de documento: </label>
                            <input type="number" class="form-control" name="documentoE" id="documentoE" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="fechaNE" class="text-start">&nbsp;Fecha de nacimiento: </label>
                            <input type="date" class="form-control" name="fechaNE" id="fechaNE" placeholder="Ingrese fecha de nacimiento" required>
                        </div>
                        <div class="col-6 mt-2">
                        <label style="color: rgb(0, 3, 44);" for="listaGrados" class="text-start">&nbsp;Grado: </label>
                            <select class="form-select" name="listaGrados" id="listaGrados">
                                <option value="Peescolar">  Peescolar</option>
                                <option value="Primero">Primero</option>
                                <option value="Segundo">Segundo</option>
                                <option value="Tercero">Tercero</option>
                                <option value="Cuarto">Cuarto</option>
                                <option value="Quinto">Quinto</option>
                                <option value="Sexto">Sexto</option>
                                <option value="Septimo">Septimo</option>
                                <option value="Octavo">Octavo</option>
                                <option value="Noveno">Noveno</option>
                                <option value="Decimo">Decimo</option>
                                <option value="Once">Once</option>
                        </select>
                        </div>
                        <div class="col-12 mt-2">
                        <label style="color: rgb(0, 3, 44);" for="listaAcudientes" class="text-start">&nbsp;Acudiente: </label>
                            <select class="form-select" name="listaAcudientes" id="listaAcudientes">
                                <?php
                                    foreach($Acudientes as $Acudiente){
                                ?>
                                <option value="<?php echo $Acudiente['IdAcudiente']; ?>"><?php echo $Acudiente['NombresAcudiente']." ".$Acudiente['ApellidosAcudiente']; ?></option>
                                <?php
                                    }
                                ?>
                        </select>
                        </div>
                        <input type="hidden" name="accion" value="crearEstudiante">
                        <button type="submit" class="btn btn-success mt-3 w-25">Matricular</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar estudiante -->
<div class="modal fade" id="ModalEditarEstudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Estudiante</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarEstudiante" action="/proyecto/views/administrador/estudiantes/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreE" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreE" id="nombreE" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="apellidoE" class="text-start">&nbsp;Apellido: </label>
                            <input type="text" class="form-control" name="apellidoE" id="apellidoE" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaDocumentosE" class="text-start">&nbsp;Tipo de documento: </label>
                            <select class="form-select" name="listaDocumentosE" id="listaDocumentosE">
                                <option value="">--Seleccionar--</option>
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                <option value="Cedula Extranjera">Cedula Extranjera</option>
                                <option value="Pasaporte">Pasaporte</option>
                        </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="documentoE" class="text-start">&nbsp;Numero de documento: </label>
                            <input type="number" class="form-control" name="documentoE" id="documentoE" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="fechaNE" class="text-start">&nbsp;Fecha de nacimiento: </label>
                            <input type="date" class="form-control" name="fechaNE" id="fechaNE" required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaGrados" class="text-start">&nbsp;Grado: </label>
                            <select class="form-select" name="listaGrados" id="listaGrados">
                                <option value="">--seleccionar--</option>
                                <option value="Peescolar">Peescolar</option>
                                <option value="Primero">Primero</option>
                                <option value="Segundo">Segundo</option>
                                <option value="Tercero">Tercero</option>
                                <option value="Cuarto">Cuarto</option>
                                <option value="Quinto">Quinto</option>
                                <option value="Sexto">Sexto</option>
                                <option value="Septimo">Septimo</option>
                                <option value="Octavo">Octavo</option>
                                <option value="Noveno">Noveno</option>
                                <option value="Decimo">Decimo</option>
                                <option value="Once">Once</option>
                        </select>
                        </div>
                        <div class="col-12 mt-2">
                        <label style="color: rgb(0, 3, 44);" for="listaAcudientes" class="text-start">&nbsp;Acudiente: </label>
                            <select class="form-select" name="listaAcudientes" id="listaAcudientes">
                                <?php
                                    foreach($Acudientes as $Acudiente){
                                ?>
                                <option value="<?php echo $Acudiente['IdAcudiente']; ?>"><?php echo $Acudiente['NombresAcudiente']." ".$Acudiente['ApellidosAcudiente']; ?></option>
                                <?php
                                    }
                                ?>
                        </select>
                        </div>
                        <input type="hidden" name="accion" value="editarEstudiante">
                        <input type="hidden" name="idEstudiante" id="idEstudiante" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  function Eliminar(item, valor) {
        $(`#fila${item}`).remove();
        if (confirm("Seguro que desea eliminar este campo")) {
            EliminarDB(valor);
        } else {
            window.location.href = url;
        }
    }

    function EliminarDB(valor) {
        const DataParam = {
            'accion': 'eliminar',
            'documentoEstudiante': valor
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
                msg = `<div id="AlertEstudiante" class="alert alert-danger">${result.error}</div>`
            }else if(result.success){
                msg = `<div id="AlertEstudiante" class="alert alert-success">${result.success}</div>`
            }

            $('#containerAlert').html(msg)
            setTimeout(() => {
                $('#AlertEstudiante').slideUp(100)
                location.reload();
            }, 3000);
        })
    
    }
    
    $('.editarEstudiante').on('click', function(){
        const nombreEstudiante = $(this).data('nombre')
        const apellidoEstudiante = $(this).data('apellido')
        const tipoDocumento = $(this).data('tipo_documento')
        const documento = $(this).data('documento')
        const fechaNacimiento = $(this).data('fecha_nacimiento')
        const grado = $(this).data('grado')
        const IdEstudiante = $(this).data('id_estudiante')
        const IdAcudiente = $(this).data('id_acudiente')
        console.log(nombreEstudiante, apellidoEstudiante, tipoDocumento, documento, fechaNacimiento, grado, IdEstudiante, IdAcudiente);
        
        // Asignar valores a los campos del form
        $('#formEditarEstudiante').find('#nombreE').val(nombreEstudiante)
        $('#formEditarEstudiante').find('#apellidoE').val(apellidoEstudiante)
        $('#formEditarEstudiante').find('#listaDocumentosE').val(tipoDocumento)
        $('#formEditarEstudiante').find('#documentoE').val(documento)
        $('#formEditarEstudiante').find('#fechaNE').val(fechaNacimiento)
        $('#formEditarEstudiante').find('#listaGrados').val(grado)
        $('#formEditarEstudiante').find('#idEstudiante').val(IdEstudiante)
        $('#formEditarEstudiante').find('#listaAcudientes').val(IdAcudiente)

        // mostrar modal
        $('#ModalEditarEstudiante').modal('show')
    })
</script>