<div class="col-10 containerSection">
    <h1>Actividades</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertCalificaciones" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertCalificaciones').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirActividad">
                <i class="bi bi-plus-lg"></i> Actividad
            </button>
        </div>
    </div>
    <div class="table-responsive mt-2">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Grado</th>
                        <th>Materia</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Periodo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Actividades as $Actividad){
                            $cont++;
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td>
                                    <?php
                                        $Grado = $ActividadesCTR->consultarGrado('IdGrado',$Actividad['IdGrado']);
                                        foreach($Grado as $NombreGrado){
                                            echo $NombreGrado['NombreGrado'];
                                        }
                                     ?>
                                </td>
                                <td>
                                    <?php
                                        $Materia = $ActividadesCTR->consultarMateria('IdMateria',$Actividad['IdMateria']);
                                        foreach($Materia as $NombreMateria){
                                            echo $NombreMateria['NombreMateria'];
                                        }
                                     ?>
                                </td>
                                <td><?php echo $Actividad['Nombre'];?></td>
                                <td><?php echo $Actividad['Descripcion'];?></td>
                                <td>
                                    <?php
                                      switch($Actividad['Periodo']){
                                        case '1':
                                            echo 'Primero';
                                        break;
                                        case '2':
                                            echo 'Segundo';
                                        break;
                                        case '3':
                                            echo 'Tercero';
                                        break;
                                        case '4':
                                            echo 'Cuartos';
                                        break;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $Actividad['Fecha'];?></td>
                                <td>
                                    <input type="hidden" name="idActividad" id="idActividad" value="<?php echo $Actividad['Id'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,<?= $Actividad['Id']; ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarActividad"
                                        data-nombre="<?php echo $Actividad['Nombre'];?>"
                                        data-idgrado="<?php echo $Actividad['IdGrado'];?>"
                                        data-idmateria="<?php echo $Actividad['IdMateria'];?>"
                                        data-descripcion="<?php echo $Actividad['Descripcion'];?>"
                                        data-periodo="<?php echo $Actividad['Periodo'];?>"
                                        data-idactividad="<?php echo $Actividad['Id'];?>"
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

<!-- Modal crear actividad -->
<div class="modal fade" id="ModalAñadirActividad" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Actividad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proyecto/views/docente/actividades/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaGrados" class="text-start">&nbsp;Grado: </label>
                            <select class="form-select" name="listaGrados" id="listaGrados" required>
                                <?php
                                    foreach($Grados as $Grado){
                                        echo '<option value="'.$Grado['IdGrado'].'">'.$Grado['NombreGrado'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaMaterias" class="text-start">&nbsp;Materias: </label>
                            <select class="form-select" name="listaMaterias" id="listaMaterias" required>
                                <?php
                                   foreach($Materias as $Materia){
                                    echo '<option value="'.$Materia['IdMateria'].'">'.$Materia['NombreMateria'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="periodo" class="text-start">&nbsp;Periodo: </label>
                            <select class="form-select" name="periodo" id="periodo" required>
                                    <option value="1">Primero</option>
                                    <option value="2">Segundo</option>
                                    <option value="3">Tercero</option>
                                    <option value="4">Cuarto</option>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreA" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreA" id="nombreA" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" style="max-width: 100%; min-width: 100%; max-height: 100px; min-height: 100px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2 text-center">
                            <input type="hidden" name="accion" value="crearActividad">
                            <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                            <button type="button" class="btn btn-danger mt-3 w-25">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar estudiante -->
<div class="modal fade" id="ModalEditarActividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Actividad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarActividad" action="/proyecto/views/docente/actividades/index.php" method="POST">
                    <div class="row justify-content-center">
                    <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaGrados" class="text-start">&nbsp;Grado: </label>
                            <select class="form-select" name="listaGrados" id="listaGrados" required>
                                <?php
                                    foreach($Grados as $Grado){
                                        echo '<option value="'.$Grado['IdGrado'].'">'.$Grado['NombreGrado'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaMaterias" class="text-start">&nbsp;Materias: </label>
                            <select class="form-select" name="listaMaterias" id="listaMaterias" required>
                                <?php
                                   foreach($Materias as $Materia){
                                    echo '<option value="'.$Materia['IdMateria'].'">'.$Materia['NombreMateria'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="periodo" class="text-start">&nbsp;Periodo: </label>
                            <select class="form-select" name="periodo" id="periodo" required>
                                    <option value="1">Primero</option>
                                    <option value="2">Segundo</option>
                                    <option value="3">Tercero</option>
                                    <option value="4">Cuarto</option>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreA" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreA" id="nombreA" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" style="max-width: 100%; min-width: 100%; max-height: 100px; min-height: 100px;" required></textarea>
                        </div>
                        <input type="hidden" name="accion" value="editarActividad">
                        <input type="hidden" name="idActividad" id="idActividad" value="">
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
            'idActividad': valor
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
    
    $('.editarActividad').on('click', function(){
        const nombreActividad = $(this).data('nombre')
        const idgrado = $(this).data('idgrado')
        const idmateria = $(this).data('idmateria')
        const descripcion = $(this).data('descripcion')
        const periodo = $(this).data('periodo')
        const idActividad = $(this).data('idactividad')
        console.log(nombreActividad,idgrado,idmateria,descripcion,periodo,idActividad);
        
        // Asignar valores a los campos del form
        $('#formEditarActividad').find('#nombreA').val(nombreActividad)
        $('#formEditarActividad').find('#listaGrados').val(idgrado)
        $('#formEditarActividad').find('#listaMaterias').val(idmateria)
        $('#formEditarActividad').find('#descripcion').val(descripcion)
        $('#formEditarActividad').find('#periodo').val(periodo)
        $('#formEditarActividad').find('#idActividad').val(idActividad)

        // mostrar modal
        $('#ModalEditarActividad').modal('show')
    })
</script>