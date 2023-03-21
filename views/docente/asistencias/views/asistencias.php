<div class="col-10 containerSection">
    <h1>Asistencias</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertAsistencias" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertAsistencias').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirInasistencia">
                <i class="bi bi-plus-lg"></i> Inasistencia
            </button>
        </div>
    </div>

    
   <div class="container mt-3 mb-3">
        <div class="table-responsive">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Estudiante</th>
                        <th>Grado</th>
                        <th>Materia</th>
                        <th>Periodo</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Inasistencias as $Inasistencia) {
                            $cont++;
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td >
                                    <div class="col-12 d-flex">
                                        <?php
                                            $Estudiant = $AsistenciasCTR->ConsultarEstudiante('IdEstudiante',$Inasistencia['IdEstudiante']);
                                            foreach ($Estudiant as $Nombre) {
                                                echo $Nombre['NombresEstudiante'].' '.$Nombre['ApellidosEstudiante'];
                                            }
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $Grad = $ActividadesCTR->ConsultarGrado('IdGrado',$Inasistencia['IdGrado']);
                                        foreach ($Grad as $Nombre) {
                                            echo $Nombre['NombreGrado'];
                                        };
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $Materia = $MateriasCTR->ConsultarMateria('IdMateria',$Inasistencia['IdMateria']);
                                        foreach ($Materia as $Nombre) {
                                            echo $Nombre['NombreMateria'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        switch($Inasistencia['Periodo']){
                                            case 1:
                                                echo 'Primero';
                                            break;
                                            case 2:
                                                echo 'Segundo';
                                            break;
                                            case 3:
                                                echo 'Tercero';
                                            break;
                                            case 4:
                                                echo 'Cuarto';
                                            break;
                                        }
                                    ?>
                                </td>
                                <td><?php echo $Inasistencia['Descripcion'];?></td>
                                <td><?php echo $Inasistencia['Fecha'];?></td>
                                <td>
                                    <input type="hidden" name="idEstudiante" id="idEstudiante" value="<?php echo $Estudiante['IdEstudiante'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,<?= $Inasistencia['Id']; ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarInasistencia"
                                        data-id_estudiante="<?php echo $Inasistencia['IdEstudiante'];?>"
                                        data-grado="<?php echo $Inasistencia['IdGrado'];?>"
                                        data-materia="<?php echo $Inasistencia['IdMateria'];?>"
                                        data-periodo="<?php echo $Inasistencia['Periodo'];?>"
                                        data-descripcion="<?php echo $Inasistencia['Descripcion'];?>"
                                        data-fecha="<?php echo $Inasistencia['Fecha'];?>"
                                        data-id_inasistencia="<?php echo $Inasistencia['Id'];?>"

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

<!-- Modal crear inasistencia -->
<div class="modal fade" id="ModalAñadirInasistencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Inasistencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarActividad" action="/proyecto/views/docente/asistencias/index.php" method="POST">
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
                            <label style="color: rgb(0, 3, 44);" for="fecha" class="text-start">&nbsp;Fecha: </label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="idEstudiante" class="text-start">&nbsp;Estudiante: </label>
                            <select class="form-select" name="idEstudiante" id="idEstudiant" required>
                                    
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" style="max-width: 100%; min-width: 100%; max-height: 100px; min-height: 100px;" required></textarea>
                        </div>
                        <input type="hidden" name="accion" value="agregarInasistencia">
                        <input type="hidden" name="idActividad" id="idActividad" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar estudiante -->
<div class="modal fade" id="ModalEditarInasistencias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Inasistencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarInasistencia" action="/proyecto/views/docente/asistencias/index.php" method="POST">
                <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaGrados" class="text-start">&nbsp;Grado: </label>
                            <select class="form-select" name="listaGrados" id="listaGradosE" required>
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
                            <label style="color: rgb(0, 3, 44);" for="fecha" class="text-start">&nbsp;Fecha: </label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="idEstudiante" class="text-start">&nbsp;Estudiante: </label>
                            <select class="form-select" name="idEstudiante" id="idEstudiantE" required>

                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" style="max-width: 100%; min-width: 100%; max-height: 100px; min-height: 100px;" required></textarea>
                        </div>
                        <input type="hidden" name="accion" value="editarInasistencia">
                        <input type="hidden" name="idInasistencia" id="idInasistencia" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const selectEstudiantes = $('#idEstudiant')
    const selectEstudiantesE = $('#idEstudiantE')


    $('#listaGrados').change(function(){
        valor = $('#listaGrados').val()
        console.log(valor);
        const DataParam = {
            'accion': 'consultarEstudiantes',
            'idGrado': valor
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
            selectEstudiantes.html('<option value="">Seleccione una opcion</option>')

            result.map((Estudiante,index)=>{
                const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
                selectEstudiantes.append(htmloption)
            })
        })
    })

    $('#listaGradosE').change(function(){
        valor = $('#listaGradosE').val()
        const DataParam = {
            'accion': 'consultarEstudiantes',
            'idGrado': valor
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
            selectEstudiantesE.html('<option value="">Seleccione una opcion</option>')

            result.map((Estudiante,index)=>{
                const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
                selectEstudiantesE.append(htmloption)
            })
        })
    })

    function Eliminar(item, valor) {
        $(`#fila${item}`).remove();
        if (confirm("Seguro que desea eliminar este campo")) {
            EliminarDB(valor);
        } else {
            location.reload()
        }
    }

    function EliminarDB(valor) {
        const DataParam = {
            'accion': 'eliminar',
            'IdInasistencia': valor
        };
        console.log(valor);
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
                msg = `<div id="AlertAsistencias" class="alert alert-danger">${result.error}</div>`
            }else if(result.success){
                msg = `<div id="AlertAsistencias" class="alert alert-success">${result.success}</div>`
            }

            $('#containerAlert').html(msg)
            setTimeout(() => {
                $('#AlertAsistencias').slideUp(100)
                location.reload();
            }, 3000);
        })
    
    }
    
    $('.editarInasistencia').on('click', async function(){
        const id_estudiante = $(this).data('id_estudiante')
        const grado = $(this).data('grado')
        const materia = $(this).data('materia')
        const periodo = $(this).data('periodo')
        const descripcion = $(this).data('descripcion')
        const fecha = $(this).data('fecha')
        const id_inasistencia = $(this).data('id_inasistencia')
        console.log(id_estudiante,grado,materia,periodo,descripcion,fecha,id_inasistencia);
        
        const DataParam = {
            'accion': 'consultarEstudiantes',
            'idGrado': grado
        };
        const url = window.location.pathname
        await fetch(url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(DataParam)
        })
        .then(response => response.json())
        .then(result => {
            selectEstudiantesE.html('<option value="">Seleccione una opcion</option>')

            result.map((Estudiante,index)=>{
                const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
                selectEstudiantesE.append(htmloption)
            })
        })
        

        // Asignar valores a los campos del form
        $('#formEditarInasistencia').find('#listaGradosE').val(grado)
        $('#formEditarInasistencia').find('#listaMaterias').val(materia)
        $('#formEditarInasistencia').find('#periodo').val(periodo)
        $('#formEditarInasistencia').find('#descripcion').val(descripcion)
        $('#formEditarInasistencia').find('#fecha').val(fecha)
            $('#formEditarInasistencia').find('#idEstudiantE').val(id_estudiante)
        $('#formEditarInasistencia').find('#idInasistencia').val(id_inasistencia)

        // mostrar modal
        $('#ModalEditarInasistencias').modal('show')
    })
</script>