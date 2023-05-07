<div class="col-lg-10 col-md-9 containerSection">
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

    <form action="/proyecto/views/docente/actividades/index.php" method="POST">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-12">
                <label style="color: rgb(0, 3, 44);" for="materia" class="text-start">&nbsp;Materia: </label>
                <select class="form-select mt-2" name="materia" id="listamateria" required>
                    <option value="">Seleccione una opcion</option>
                    <?php
                        $Materias = [];
                        $Materias = $DocenteCTR->consultarMaterias($_SESSION['Id']);
                        // print_r($Materias);
                        foreach($Materias as $Materia){
                            echo '<option value="'.$Materia['IdMateria'].'">'.$Materia['NombreMateria']."</option> ";
                        }
                        
                    ?>
                </select>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12">
                <label style="color: rgb(0, 3, 44);" for="ListaGrados" class="text-start">&nbsp;Periodo: </label>
                <select class="form-select mt-2" name="periodo" id="periodo" required>
                    <option value="1">Primero</option>
                    <option value="2">Segundo</option>
                    <option value="3">Tercero</option>
                    <option value="4">Cuarto</option>
                </select>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12">
                <label style="color: rgb(0, 3, 44);" for="ListaGrados" class="text-start">&nbsp;Grado: </label>
                <select class="form-select mt-2" name="ListaGrados" id="ListaGrados" required>
                    
                </select>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-success" style="margin-top: 31px;">Cargar</button>
            </div>
        </div>
        <input type="hidden" name="accion" id="accion" value="consultarActividades">
        <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $_SESSION['Id']; ?>">
    </form>
    <hr>
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
                        <th>Tipo Actividad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       
                       if(isset($_POST['materia']) && $_POST['materia'] != ''){
                            // $Actividades = $ActividadesCTR->ConsultarActividades();
                            
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
                                <td><?php echo $Actividad['TipoActividad'];?></td>
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
                                        data-tipo_actividad="<?php echo $Actividad['TipoActividad'];?>"
                                        data-idactividad="<?php echo $Actividad['Id'];?>"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
</div>

<!-- Modal crear actividad -->
<div class="modal fade" id="ModalAñadirActividad" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <select class="form-select" name="listaGrados" id="listaGradosCrear" required>
                                
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaMaterias" class="text-start">&nbsp;Materias: </label>
                            <select class="form-select" name="listaMaterias" id="listaMateriaCrear" required>
                                <option value="">Seleccione una opción</option>
                                <?php
                                    $Materias = [];
                                    $Materias = $DocenteCTR->consultarMaterias($_SESSION['Id']);
                                    // print_r($Materias);
                                    foreach($Materias as $Materia){
                                        echo '<option value="'.$Materia['IdMateria'].'">'.$Materia['NombreMateria']."</option> ";
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
                            <label style="color: rgb(0, 3, 44);" for="tipoActividad" class="text-start">&nbsp;Tipo Actividad: </label>
                            <select class="form-select" name="tipoActividad" id="tipoActividad" required>
                                <option value="Tarea">Tarea</option>
                                <option value="Taller">Taller</option>
                                <option value="Evaluación">Evaluación</option>
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" style="max-width: 100%; min-width: 100%; max-height: 100px; min-height: 100px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2 text-center">
                            <input type="hidden" name="accion" value="crearActividad">
                            <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $_SESSION['Id'];?>">
                            <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                            <button type="button" class="btn btn-danger mt-3 w-25" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
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
                            <select class="form-select" name="listaGrados" id="listaGrado" required>
                                <?php
                                    $Grados = $ActividadesCTR->consultarGrados();
                                    foreach($Grados as $Grado){
                                        echo '<option value="'.$Grado['IdGrado'].'">'.$Grado['NombreGrado'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="listaMaterias" class="text-start">&nbsp;Materias: </label>
                            <select class="form-select" name="listaMaterias" id="listaMaterias" required>
                                <option value="">Seleccione una opción</option>
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
                            <label style="color: rgb(0, 3, 44);" for="tipoActividad" class="text-start">&nbsp;Tipo Actividad: </label>
                            <select class="form-select" name="tipoActividad" id="tipoActividad" required>
                                <option value="Tarea">Tarea</option>
                                <option value="Taller">Taller</option>
                                <option value="Evaluación">Evaluación</option>
                            </select>
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

    const selectGrados = $('#listaGradosCrear')
    const seleccionGrados = $('#ListaGrados')
    
    function Eliminar(item, valor) {
        if (confirm("Seguro que desea eliminar este campo")) {
            $(`#fila${item}`).remove();
            EliminarDB(valor);
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
        const TipoActividad = $(this).data('tipo_actividad')
        const idActividad = $(this).data('idactividad')
        console.log(nombreActividad,idgrado,idmateria,descripcion,periodo,idActividad,TipoActividad);
        
        // Asignar valores a los campos del form
        $('#formEditarActividad').find('#nombreA').val(nombreActividad)
        $('#formEditarActividad').find('#listaGrado').val(idgrado)
        $('#formEditarActividad').find('#listaMaterias').val(idmateria)
        $('#formEditarActividad').find('#descripcion').val(descripcion)
        $('#formEditarActividad').find('#periodo').val(periodo)
        $('#formEditarActividad').find('#tipoActividad').val(TipoActividad)
        $('#formEditarActividad').find('#idActividad').val(idActividad)

        // mostrar modal
        $('#ModalEditarActividad').modal('show')
    })

    $('#listaMateriaCrear').change(function(){
        materia = $('#listaMateriaCrear').val()
        IdUsuario = $('#IdUser').val()

        const DataParam = {
            'accion': 'consultarGradosMateria',
            'IdUser': IdUsuario,
            'materia': materia
        }
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
            selectGrados.html('<option value="">Seleccione una opcion</option>')

            result.map((Grado,index)=>{
                const htmloption = `<option value="${Grado.IdGrado}">${Grado.NombreGrado}</option>` 
                selectGrados.append(htmloption)
            })
        })
    })

    $('#listamateria').change(function(){
        materia = $('#listamateria').val()
        IdUsuario = $('#IdUser').val()

        const DataParam = {
            'accion': 'consultarGradosMateria',
            'IdUser': IdUsuario,
            'materia': materia
        }
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
            seleccionGrados.html('<option value="">Seleccione una opcion</option>')

            result.map((Grado,index)=>{
                const htmloptio = `<option value="${Grado.IdGrado}">${Grado.NombreGrado}</option>` 
                console.log(htmloptio);
                seleccionGrados.append(htmloptio)
            })
        })
    })
</script>