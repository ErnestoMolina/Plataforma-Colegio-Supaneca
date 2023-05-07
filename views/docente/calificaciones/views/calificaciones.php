<div class="col-lg-10 col-md-9 containerSection">
    <h1>Consultar calificaciones</h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-3 text-center mt-2">
            <!-- Boton del modal definitiva final año -->
            <button type="button" class="btn w-75 text-white" id="btnDefinitivaAño" style="display: none;" data-bs-toggle="modal" data-bs-target="#ModalDefinitivaAño">
                <i class="bi bi-pencil-square"></i> Definitiva Año
            </button>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-3 text-center mt-2">
            <!-- Boton del modal definitiva -->
            <button type="button" class="btn w-75 text-white" id="btnDefinitiva" style="display: none;" data-bs-toggle="modal" data-bs-target="#ModalDefinitiva">
                <i class="bi bi-pencil-square"></i> Definitiva
            </button>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-3 text-center mt-2">
            <!-- Boton del modal observaciones -->
            <button type="button" class="btn w-75" id="btnObservaciones" style="display: none;" data-bs-toggle="modal" data-bs-target="#ModalObservaciones">
                <i class="bi bi-pencil-square"></i> Observaciones
            </button>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-3 text-center mt-2">
            <!-- Boton del modal porcentajes -->
            <button type="button" class="btn w-75" id="ModalPorcentaje" style="display: none;" data-bs-toggle="modal" data-bs-target="#ModalPorcentajes">
                <i class="bi bi-pencil-square"></i> Porcentaje
            </button>
        </div>
    </div>

    <?php
        
    ?>
    <div class="container mt-3 mb-3">
        <form action="/proyecto/views/docente/calificaciones/index.php" id="FormConsultaNotas" method="POST">
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
                    <label style="color: rgb(0, 3, 44);" for="periodo" class="text-start">&nbsp;Periodo: </label>
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
                    <label style="color: rgb(0, 3, 44);" for="estudiantes" class="text-start">&nbsp;Estudiante: </label>
                    <select class="form-select mt-2" name="estudiantes" id="estudiantes" required>
                        
                    </select>
                </div>
            </div>
            <input type="hidden" name="accion" id="accion" value="ConsultarCalificaciones">
            <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $_SESSION['Id']; ?>">
        </form>
        <hr>
        <div class="table-responsive mt-2">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Actividades</th>
                        <th>Tipo actividad</th>
                        <th>Calificacion</th>
                    </tr>
                </thead>
                <tbody id="table_actividades">
                    
                </tbody>
            </table>
        </div>
   </div>
</div>

<!-- Modal porcentajes -->
<div class="modal fade" id="ModalPorcentajes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Porcentaje de las actividades</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPorcentaje" action="/proyecto/views/docente/calificaciones/index.php" method="POST">
                    <div class="row justify-content-center" id="CamposPorcentajes">

                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="hidden" name="accion" id="accion" value="ConsultarPorcentajeActividades">
                            <input type="hidden" name="IdMateria" id="IdMateria" value="">
                            <input type="hidden" name="IdGrado" id="IdGrado" value="">
                            <button type="button" class="btn btn-success mt-3 w-50" id="EnvioModalPorcentaje">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Observaciones -->
<div class="modal fade" id="ModalObservaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Observaciones Desempeño</h1>
                <button type="button" class="btn-close" id="cerrarModalObservaciones" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formObservaciones" action="/proyecto/views/docente/calificaciones/index.php" method="POST">
                    <div class="row justify-content-center" id="CamposDesempeño">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="grado" class="text-start">&nbsp;Grado: </label>
                            <input type="text" class="form-control" name="grado" id="grado" disabled>
                        </div>
                        <div class="col-12 mt-2">
                                <label style="color: rgb(0, 3, 44);" for="desempeño" class="text-start">&nbsp;Desempeño: </label>
                                <select class="form-control" name="desempeño" id="desempeño" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Bajo">Bajo</option>
                                    <option value="Basico">Basico</option>
                                    <option value="Alto">Alto</option>
                                    <option value="Superior">Superior</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2" id="DatosObservaciones">
                                
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="hidden" name="accion" id="accion" value="procesarObservaciones">
                            <input type="hidden" name="IdMateria" id="IdMateria" value="">
                            <input type="hidden" name="IdGrado" id="IdGrado" value="">
                            <button type="button" class="btn btn-success mt-3 w-50" id="EnvioModalObservaciones">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Definitiva -->
<div class="modal fade" id="ModalDefinitiva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Notas Definitiva</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDefinitiva" action="/proyecto/views/docente/calificaciones/index.php" method="POST">
                    <div class="row justify-content-center" id="CamposDesempeño">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="grado" class="text-start">&nbsp;Grado: </label>
                            <input type="text" class="form-control" name="grado" id="grado" disabled>
                        </div>
                        <div class="col-4 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="verTareas" class="text-start">&nbsp;Tareas: </label>
                            <input type="text" class="form-control" name="verTareas" id="verTareas" disabled>
                        </div>
                        <div class="col-4 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="verTalleres" class="text-start">&nbsp;Talleres: </label>
                            <input type="text" class="form-control" name="verTalleres" id="verTalleres" disabled>
                        </div>
                        <div class="col-4 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="verEvaluaciones" class="text-start">&nbsp;Evaluaciones: </label>
                            <input type="text" class="form-control" name="verEvaluaciones" id="verEvaluaciones" disabled>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="verDefinitiva" class="text-start">&nbsp;Definitiva Materia: </label>
                            <input type="text" class="form-control" name="verDefinitiva" id="verDefinitiva" disabled>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="desempeñoDefinitiva" class="text-start">&nbsp;Desempeño: </label>
                            <select class="form-control" name="desempeñoDefinitiva" id="desempeñoDefinitiva" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Bajo">Bajo</option>
                                <option value="Basico">Basico</option>
                                <option value="Alto">Alto</option>
                                <option value="Superior">Superior</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="hidden" name="accion" id="accion" value="procesarDefinitiva">
                            <input type="hidden" name="IdGrado" id="IdGrado" value="">
                            <input type="hidden" name="IdMateria" id="IdMateria" value="">
                            <input type="hidden" name="periodo" id="periodo" value="">
                            <input type="hidden" name="IdEstudiante" id="IdEstudiante" value="">
                            <input type="hidden" name="definitiva" id="definitiva" value="">
                            <button type="button" class="btn btn-success mt-3 w-50" id="EnvioModalDefinitiva">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Definitiva Año-->
<div class="modal fade" id="ModalDefinitivaAño" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Definitivas periodos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDefinitivaAño" action="/proyecto/views/docente/calificaciones/index.php" method="POST">
                    <div class="row justify-content-center" id="CamposDesempeño">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="grado" class="text-start">&nbsp;Grado: </label>
                            <input type="text" class="form-control" name="grado" id="grado" disabled>
                        </div>
                        <div id="periodos" class="row">

                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="verDefinitiva" class="text-start">&nbsp;Definitiva Materia: </label>
                            <input type="text" class="form-control" name="verDefinitiva" id="verDefinitiva" disabled>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="desempeñoDefinitiva" class="text-start">&nbsp;Desempeño: </label>
                            <select class="form-control" name="desempeñoDefinitiva" id="desempeñoDefinitiva" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Bajo">Bajo</option>
                                <option value="Basico">Basico</option>
                                <option value="Alto">Alto</option>
                                <option value="Superior">Superior</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="hidden" name="accion" id="accion" value="procesarDefinitivaAño">
                            <input type="hidden" name="IdGrado" id="IdGrado" value="">
                            <input type="hidden" name="IdMateria" id="IdMateria" value="">
                            <input type="hidden" name="IdEstudiante" id="IdEstudiante" value="">
                            <input type="hidden" name="definitiva" id="definitiva" value="">
                            <button type="button" class="btn btn-success mt-3 w-50" id="EnvioModalDefinitivaAño">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const selectGrados = $('#ListaGrados')
    const ListEstudiantes = $('.ListadoEstudiantes')
    const Estudiantes = $('#estudiantes')
    const ListaActividades = $('#table_actividades')
    const CamposPorcentajes = $('#CamposPorcentajes')
    const DatosObservaciones = $('#DatosObservaciones')
    const DatosDefinitivaAño = $('#periodos')

    // function Calificar(){
    //     var formulario = $('#formCalificar')

    //     const DataParam = formulario.serialize() 
    //     const url = window.location.pathname
    //     $.post(url, DataParam, function(data){
    //         var JsonData = $.parseJSON(data)
    //         console.log(JsonData);
    //         if(JsonData.success){
    //             alert(JsonData.success)
    //         }else{
    //             alert(JsonData.error)
    //         }
    //     })
    // }

    // funciones Observaciones 
    $('#btnObservaciones').on('click', function(){
        IdMateria = $('#listamateria').val()
        IdGrado = $('#ListaGrados').val()
        switch(IdGrado){
            case '1':
                grado = 'Prescolar'
            break;
            case '2':
                grado = 'Primero'
            break;
            case '3':
                grado = 'Segundo'
            break;
            case '4':
                grado = 'Tercero'
            break;
            case '5':
                grado = 'Cuarto'
            break;
            case '6':
                grado = 'Quinto'
            break;
            case '7':
                grado = 'Sexto'
            break;
            case '8':
                grado = 'Septimo'
            break;
            case '9':
                grado = 'Octavo'
            break;
            case '10':
                grado = 'Noveno'
            break;
            case '11':
                grado = 'Decimo'
            break;
            case '12':
                grado = 'Once'
            break;
        }

        // Asignar valores a los campos 
        $('#formObservaciones').find('#IdMateria').val(IdMateria)
        $('#formObservaciones').find('#IdGrado').val(IdGrado)
        $('#formObservaciones').find('#grado').val(grado)
        
        $('#desempeño').val(null)
        DatosObservaciones.html('')

        $('#desempeño').change(function(){
            const Desempeño = $('#desempeño').val()
            const DataParam = {
                'accion' : 'ConsultarObservaciones',
                'IdGrado' : IdGrado, 
                'desempeño' : Desempeño, 
                'IdMateria' : IdMateria 
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
                
                DatosObservaciones.html('')
                if(result != ''){
                    result.map((Observaciones,index )=>{
                        html = `
                            <label style="color: rgb(0, 3, 44);" for="observaciones" class="text-start">&nbsp;Observaciones: </label>
                            <textarea type="text" name="observaciones" id="observaciones" class="form-control"
                            style="max-width: 100%; min-width: 100%; max-height: 150px; min-height: 150px;" required>${Observaciones.Observaciones}</textarea>
                        `
                        DatosObservaciones.append(html)
                    })
                }else{
                    DatosObservaciones.html('')
                        html = `
                            <label style="color: rgb(0, 3, 44);" for="observaciones" class="text-start">&nbsp;Observaciones: </label>
                            <textarea type="text" name="observaciones" id="observaciones" class="form-control"
                            style="max-width: 100%; min-width: 100%; max-height: 150px; min-height: 150px;" required></textarea>
                        `
                    DatosObservaciones.append(html)
                }
                
            })
        })
    })

    $('#EnvioModalObservaciones').on('click', function(){
        const formulario = $('#formObservaciones')
        const DataParam = getFormData(formulario)
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
            if(result.success){
                alert(result.success)
            }else{
                alert(result.error)
            }
        })
    })
    
    // funciones Porcentajes Activiades
    $('#ModalPorcentaje').on('click', function(){
        const IdMateria = $('#listamateria').val()
        const IdGrado = $('#ListaGrados').val()

        // Asignar valores a los campos 
        $('#formPorcentaje').find('#IdMateria').val(IdMateria)
        $('#formPorcentaje').find('#IdGrado').val(IdGrado)

        const DataParam = {
            'accion' : 'ConsultarPorcentaje',
            'IdGrado' : IdGrado, 
            'IdMateria' : IdMateria 
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
            
            if(result != ''){
                result.map((DatosPorcentajes,index)=>{
                    Tareas = `${DatosPorcentajes.Tareas}`
                    Talleres = `${DatosPorcentajes.Talleres}`
                    Evaluaciones = `${DatosPorcentajes.Evaluaciones}`

                    CamposPorcentajes.html('')
                    html = `
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="tareas" class="text-start">&nbsp;Tareas: </label>
                            <input type="text" class="form-control" name="tareas" id="tareas" value="${Tareas}" maxlength="4"  onKeypress="VerificacionNumeros()" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="talleres" class="text-start">&nbsp;Talleres: </label>
                            <input type="text" name="talleres" id="talleres" class="form-control" value="${Talleres}" maxlength="4" onKeypress="VerificacionNumeros()"  required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="evaluaciones" class="text-start">&nbsp;Evaluaciones: </label>
                            <input type="text" name="evaluaciones" id="evaluaciones" class="form-control" value="${Evaluaciones}" maxlength="4" onKeypress="VerificacionNumeros()"  required>
                        </div>
                    `
                    CamposPorcentajes.append(html)
                })
            }else{
                Tareas = ''
                Talleres = ''
                Evaluaciones = ''

                CamposPorcentajes.html('')
                html = `
                    <div class="col-12 mt-2">
                        <label style="color: rgb(0, 3, 44);" for="tareas" class="text-start">&nbsp;Tareas: </label>
                        <input type="text" class="form-control" name="tareas" id="tareas" value="${Tareas}" maxlength="4"  onKeypress="VerificacionNumeros()" required>
                    </div>
                    <div class="col-12 mt-2">
                        <label style="color: rgb(0, 3, 44);" for="talleres" class="text-start">&nbsp;Talleres: </label>
                        <input type="text" name="talleres" id="talleres" class="form-control" value="${Talleres}" maxlength="4" onKeypress="VerificacionNumeros()"  required>
                    </div>
                    <div class="col-12 mt-2">
                        <label style="color: rgb(0, 3, 44);" for="evaluaciones" class="text-start">&nbsp;Evaluaciones: </label>
                        <input type="text" name="evaluaciones" id="evaluaciones" class="form-control" value="${Evaluaciones}" maxlength="4" onKeypress="VerificacionNumeros()"  required>
                    </div>
                `
                CamposPorcentajes.append(html)
            }
        })
    })
    
    
    $('#EnvioModalPorcentaje').on('click', function(){
        const Formulario = $('#formPorcentaje')
        // Asignar valores a los campos 
        const DataParam = getFormData(Formulario)
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
            if(result.success){
                alert(result.success)
            }else{
                alert(result.error)
            }
        })
    })

    $('#estudiantes').change(function(){
        grado = $('#ListaGrados').val()
        materia = $('#listamateria').val()
        estudiante = $('#estudiantes').val()
        periodo = $('#periodo').val()
        var tabla = $('#tabla').DataTable()
        count = 1
        Tareas = 0
        Talleres = 0
        Evaluaciones = 0 
        DefinitivaTarea = 0
        DefinitivaTaller = 0
        DefinitivaEvaluacion = 0
        Tarea = 0
        Taller = 0
        Evaluacion = 0
        promedioTareas = 0
        promedioTalleres = 0
        promedioEvaluaciones = 0

        btnDefinitiva = $('#btnDefinitiva')
        btnDefinitiva.css({
            "display": "initial",
            "background-color": "slategrey",
            "border-color": "slategrey",
            "color": "white"
        })

        btnDefinitivaAño = $('#btnDefinitivaAño')
        btnDefinitivaAño.css({
            "display": "initial",
            "background-color": "teal",
            "border-color": "teal",
            "color": "white"
        })
        
        const DataParam = {
            'accion': 'ConsultarCalificaciones',
            'ListaGrados': grado,
            'materia' : materia,
            'estudiantes' : estudiante,
            'periodo' : periodo
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
            ListaActividades.html('')
            tabla.clear().draw()
            result.map((Actividad,index)=>{
            // otra forma de hacerlo pero no se puede integrar DataTable 
                // const htmloption = `
                //     <tr>
                //         <td>
                //             ${count++}
                //         </td>
                //         <td>
                //             ${Actividad.Nombre}
                //         </td>
                //         <td>
                //             ${Actividad.TipoActividad}
                //         </td>
                //         <td>
                //             ${Actividad.Calificacion}
                //         </td>
                //     </tr>` 
                    // ListaActividades.append(htmloption)
                    tabla.row.add([
                        `<td>
                            ${count++}
                        </td>`,
                        `<td>
                            ${Actividad.Nombre}
                        </td>`,
                        `<td>
                            ${Actividad.TipoActividad}
                        </td>`,
                        `<td>
                            ${Actividad.Calificacion}
                        </td>`
                    ]).draw()
                    switch(`${Actividad.TipoActividad}`){
                        case 'Tarea':
                            Tarea = parseFloat(`${Actividad.Calificacion}`)
                            DefinitivaTarea = DefinitivaTarea + Tarea
                            Tareas++
                        break;
                        case 'Taller':
                            Taller = parseFloat(`${Actividad.Calificacion}`)
                            DefinitivaTaller = DefinitivaTaller + Taller
                            Talleres++
                        break;
                        case 'Evaluación':
                            Evaluacion = parseFloat(`${Actividad.Calificacion}`)
                            DefinitivaEvaluacion = DefinitivaEvaluacion + Evaluacion
                            Evaluaciones++
                        break;
                    }
                })
            if(Tareas == 0){
                promedioTareas = 1.0
            }else{
                promedioTareas = DefinitivaTarea / Tareas
            }
            if(Talleres == 0){
                promedioTalleres = 1.0
            }else{
                promedioTalleres = DefinitivaTaller / Talleres
            }
            if(Evaluaciones == 0){
                promedioEvaluaciones = 1.0
            }else{
                promedioEvaluaciones = DefinitivaEvaluacion / Evaluaciones
            }
        })
    })

    // funciones Definitivas materia
    $('#btnDefinitiva').on('click', function(){
        IdGrado = $('#ListaGrados').val()
        IdMateria = $('#listamateria').val()
        Periodo = $('#periodo').val()
        IdEstudiante = $('#estudiantes').val()
        switch(IdGrado){
            case '1':
                grado = 'Prescolar'
            break;
            case '2':
                grado = 'Primero'
            break;
            case '3':
                grado = 'Segundo'
            break;
            case '4':
                grado = 'Tercero'
            break;
            case '5':
                grado = 'Cuarto'
            break;
            case '6':
                grado = 'Quinto'
            break;
            case '7':
                grado = 'Sexto'
            break;
            case '8':
                grado = 'Septimo'
            break;
            case '9':
                grado = 'Octavo'
            break;
            case '10':
                grado = 'Noveno'
            break;
            case '11':
                grado = 'Decimo'
            break;
            case '12':
                grado = 'Once'
            break;
        }
        const DataParam = {
            'accion' : 'ConsultarPorcentaje',
            'IdGrado' : IdGrado, 
            'IdMateria' : IdMateria 
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
            
            if(result != ''){
                result.map((DatosPorcentajes,index)=>{
                    Tareas = `${DatosPorcentajes.Tareas}`
                    Talleres = `${DatosPorcentajes.Talleres}`
                    Evaluaciones = `${DatosPorcentajes.Evaluaciones}`
                })
            }
            definitivaTareas = (promedioTareas*Tareas)/100;
            definitivaTalleres = (promedioTalleres*Talleres)/100;
            definitivaEvaluaciones = (promedioEvaluaciones*Evaluaciones)/100;
            DefinitivaMateria = definitivaTareas + definitivaTalleres + definitivaEvaluaciones;
            DefinitivaMateriaDosDecimales = DefinitivaMateria.toFixed(1);
            Desempeño = ''

            if(DefinitivaMateriaDosDecimales < 3){
                Desempeño = 'Bajo';
            }else if(DefinitivaMateriaDosDecimales >= 3 && DefinitivaMateriaDosDecimales <= 3.7){
                Desempeño = 'Basico';
            }else if(DefinitivaMateriaDosDecimales >= 3.8 && DefinitivaMateriaDosDecimales <= 4.5){
                Desempeño = 'Alto';
            }else if(DefinitivaMateriaDosDecimales >= 4.6 && DefinitivaMateriaDosDecimales <= 5){
                Desempeño = 'Superior';
            }

            $('#formDefinitiva').find('#IdGrado').val(IdGrado)
            $('#formDefinitiva').find('#IdMateria').val(IdMateria)
            $('#formDefinitiva').find('#periodo').val(Periodo)
            $('#formDefinitiva').find('#IdEstudiante').val(IdEstudiante)
            $('#formDefinitiva').find('#grado').val(grado)
            $('#formDefinitiva').find('#verTareas').val(definitivaTareas)
            $('#formDefinitiva').find('#verTalleres').val(definitivaTalleres)
            $('#formDefinitiva').find('#verEvaluaciones').val(definitivaEvaluaciones)
            $('#formDefinitiva').find('#definitiva').val(DefinitivaMateriaDosDecimales)
            $('#formDefinitiva').find('#verDefinitiva').val(DefinitivaMateriaDosDecimales)
            $('#formDefinitiva').find('#desempeñoDefinitiva').val(Desempeño)
        })
    })
    
    // funciones Definitivas materia Año
    $('#btnDefinitivaAño').on('click', function(){
        IdGrado = $('#ListaGrados').val()
        IdMateria = $('#listamateria').val()
        Periodo = $('#periodo').val()
        IdEstudiante = $('#estudiantes').val()
        switch(IdGrado){
            case '1':
                grado = 'Preescolar'
            break;
            case '2':
                grado = 'Primero'
            break;
            case '3':
                grado = 'Segundo'
            break;
            case '4':
                grado = 'Tercero'
            break;
            case '5':
                grado = 'Cuarto'
            break;
            case '6':
                grado = 'Quinto'
            break;
            case '7':
                grado = 'Sexto'
            break;
            case '8':
                grado = 'Septimo'
            break;
            case '9':
                grado = 'Octavo'
            break;
            case '10':
                grado = 'Noveno'
            break;
            case '11':
                grado = 'Decimo'
            break;
            case '12':
                grado = 'Once'
            break;
        }
        const DataParam = {
            'accion' : 'ConsultarDefinitivasPeriodos',
            'IdGrado' : IdGrado, 
            'IdEstudiante' : IdEstudiante, 
            'IdMateria' : IdMateria 
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
            if(result != ''){
                sumaNotas = 0
                count = 0
                HistorialNotas = []
                DatosDefinitivaAño.html('')
                result.map((DatosDefinitivasPeriodo,index)=>{
                    count++
                    Cantidad = `${DatosDefinitivasPeriodo.Periodo}`
                    Nota = `${DatosDefinitivasPeriodo.Calificacion}`
                    Nota = parseFloat(Nota)
                    HistorialNotas[count] = Nota 
                    sumaNotas = sumaNotas + Nota 
                    htmlperiodo = `
                        <div class="col-6 mt-2 ps-0 ">
                            <label style="color: rgb(0, 3, 44);" for="verTareas" class="text-start">&nbsp;Periodo ${count}: </label>
                            <input type="text" class="form-control" value="${Nota}" disabled>
                            <input type="hidden" name="HistorialNotas" id="HistorialNotas" value="${HistorialNotas}">
                        </div>
                    `
                    DatosDefinitivaAño.append(htmlperiodo)
                })
            }
            // console.log(HistorialNotas);
            promedio = sumaNotas/Cantidad;
            promedio = promedio.toFixed(1)

            if(promedio < 3){
                Desempeño = 'Bajo';
            }else if(promedio >= 3 && promedio <= 3.7){
                Desempeño = 'Basico';
            }else if(promedio >= 3.8 && promedio <= 4.5){
                Desempeño = 'Alto';
            }else if(promedio >= 4.6 && promedio <= 5){
                Desempeño = 'Superior';
            }

            $('#formDefinitivaAño').find('#IdGrado').val(IdGrado)
            $('#formDefinitivaAño').find('#IdMateria').val(IdMateria)
            $('#formDefinitivaAño').find('#IdEstudiante').val(IdEstudiante)
            $('#formDefinitivaAño').find('#grado').val(grado)
            $('#formDefinitivaAño').find('#definitiva').val(promedio)
            $('#formDefinitivaAño').find('#verDefinitiva').val(promedio)
            $('#formDefinitivaAño').find('#desempeñoDefinitiva').val(Desempeño)
        })
    })

    $('#EnvioModalDefinitivaAño').on('click', function(){
        const Formulario = $('#formDefinitivaAño')
        DataParam = getFormData(Formulario)
        const fechaActual = new Date();
        const añoActual = fechaActual.getFullYear()
        DataParam['Vigencia'] = añoActual
        // console.log(DataParam);
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
            // console.log(result)
            if(result.success){
                alert(result.success)
            }else{
                alert(result.error)
            }
        })
    })

    $('#EnvioModalDefinitiva').on('click', function(){
        const Formulario = $('#formDefinitiva')
        DataParam = getFormData(Formulario)
        console.log(DataParam);
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
            if(result.success){
                alert(result.success)
            }else{
                alert(result.error)
            }
        })
    })

    $('#ListaGrados').change(function(){
        grado = $('#ListaGrados').val()
        // IdUsuario = $('#IdUser').val()

        btnPorcentejes = $('#ModalPorcentaje')
        btnPorcentejes.css({
            "display": "initial",
            "background-color": "seagreen",
            "border-color": "seagreen",
            "color": "white"
        })
        
        btnObservaciones = $('#btnObservaciones')
        btnObservaciones.css({
            "display": "initial",
            "background-color": "teal",
            "border-color": "teal",
            "color": "white"
        })
        
        const DataParam = {
            'accion': 'CargarEstudiantes',
            'grado': grado
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
            Estudiantes.html('')
            Estudiantes.html('<option value="">Seleccione una opcion</option>')

            result.map((Estudiante,index)=>{
                const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
                Estudiantes.append(htmloption)
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
            selectGrados.html('<option value="">Seleccione una opcion</option>')

            result.map((Grado,index)=>{
                const htmloption = `<option value="${Grado.IdGrado}">${Grado.NombreGrado}</option>` 
                selectGrados.append(htmloption)
            })
        })
    })
                            
    function Eliminar(item, valor) {
        if (confirm("Seguro que desea eliminar este campo")) {
            $(`#fila${item}`).remove();
            EliminarDB(valor);
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

    function VerificacionNumeros(){
        if(!((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46)){
            event.preventDefault()
        }
    }

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        unindexed_array.map((campo, index)=>{
            indexed_array[campo['name']] = campo['value'];
        });

        return indexed_array;
    }
</script>