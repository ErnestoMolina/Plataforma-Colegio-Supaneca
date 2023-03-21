<div class="col-10 containerSection">
    <h1>Calificaciones</h1>
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
            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirEstudiante">
                <i class="bi bi-plus-lg"></i> Estudiante
            </button> -->
        </div>
    </div>

    <?php
        
    ?>
    <div class="container mt-3 mb-3">
        <p class="parrafo">Se le han asignado las siguientes materias:</p>
        <form action="/proyecto/views/docente/calificaciones/index.php" method="POST">
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
                        <th>Actividades</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_POST['materia']) && $_POST['materia'] != ''){

                            $cont = 0;
                            foreach ($Actividades as $Actividad){
                                $cont++;
                                echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $Actividad['Nombre'];?></td>
                                <td><?php echo $Actividad['Descripcion'];?></td>
                                <td><?php echo $Actividad['Fecha'];?></td>
                                <td>
                                    <button class="btn text-info calificar" data-bs-toggle="modal" data-bs-target="#Modalcalificaciones"
                                        data-idmateria="<?php echo $Actividad['IdMateria'];?>"
                                        data-idgrado="<?php echo $Actividad['IdGrado'];?>"
                                        data-idactividad="<?php echo $Actividad['Id'];?>"
                                        data-nombre="<?php echo $Actividad['Nombre'];?>"
                                        data-descripcion="<?php echo $Actividad['Descripcion'];?>"
                                    >
                                        <i class="bi-pencil-fill"></i>
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
</div>

<!-- Modal calificaciones -->
<div class="modal fade" id="Modalcalificaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Calificar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCalificar" action="/proyecto/views/administrador/estudiantes/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreActividad" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreActividad" id="nombreActividad" disabled>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" name="descripcion" id="descripcion" class="form-control" style="max-width: 100%; min-width: 100%; max-height: 100px; min-height: 100px;" disabled></textarea>
                        </div>
                        <h5 class="mt-1">Estudiantes</h5>
                        <div class="ps-2 pe-2">
                            <div class="col-12">
                                <table class="table table-light mt-3 pt-2">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Calificacion</th>
                                            <th>Observacion</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ListadoEstudiantes">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="accion" value="Calificar">
                        <input type="hidden" name="IdMateria" id="IdMateria" value="">
                        <input type="hidden" name="IdGrado" id="IdGrado" value="">
                        <input type="hidden" name="IdActividad" id="IdActividad" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Guardar</button>
                        <button type="button" class="btn btn-danger mt-3 w-25">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const selectGrados = $('#ListaGrados')
    const ListEstudiantes = $('.ListadoEstudiantes')

    $('.calificar').on('click', function(){
        const IdMateria = $(this).data('idmateria')
        const IdGrado = $(this).data('idgrado')
        const IdActividad = $(this).data('idactividad')
        const nombre = $(this).data('nombre')
        const descripcion = $(this).data('descripcion')
        console.log(IdMateria,IdGrado,IdActividad,nombre,descripcion);

        // Asignar valores a los campos 
        $('#formCalificar').find('#IdMateria').val(IdMateria)
        $('#formCalificar').find('#IdGrado').val(IdGrado)
        $('#formCalificar').find('#IdActividad').val(IdActividad)
        $('#formCalificar').find('#nombreActividad').val(nombre)
        $('#formCalificar').find('#descripcion').val(descripcion)

        const DataParam = {
            'accion': 'CargarEstudiantes',
            'grado': IdGrado
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
            ListEstudiantes.html('')
            result.map((Estudiante,index)=>{
                const htmloption = `<tr>
                <td>${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</td>
                <td class="col-2"><div class="col-8"><input type="number" class="w-100 form-control"></div></td>
                <td><textarea class="form-control" style="max-width: 100%; min-width: 100%; max-height: 38px; min-height: 38px;" type="text"></textarea></td>
                </tr>` 
                ListEstudiantes.append(htmloption)
            })
        })
    })

    $('#listamateria').change(function(){
        materia = $('#listamateria').val()
        IdUsuario = $('#IdUser').val()
        console.log(materia,IdUsuario)
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
            console.log(result);
            selectGrados.html('<option value="">Seleccione una opcion</option>')

            result.map((Grado,index)=>{
                const htmloption = `<option value="${Grado.IdGrado}">${Grado.NombreGrado}</option>` 
                selectGrados.append(htmloption)
            })
        })
    })
                            
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
</script>