<div class="col-lg-10 col-md-9 containerSection">
    <h1>Inasistencias</h1>
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
    </div>
    <div class="container mt-3 mb-3">
        <form action="/proyecto/views/docente/calificaciones/index.php" id="FormConsultaNotas" method="POST">
            <div class="row">
                <div class="col-lg-3 col-sm-12 col-md-12">
                    <label style="color: rgb(0, 3, 44);" for="estudiantes" class="text-start">&nbsp;Estudiantes: </label>
                    <select class="form-select mt-2" name="estudiantes" id="listaEstudiantes" required>
                        <option value="">Seleccione una opcion</option>
                        <?php
                            $Estudiantes = [];
                            $Estudiantes = $EstudianteCTR->ConsultarEstudiantes('E.idAcudiente = '.$_SESSION['Id']);
                            // print_r($Materias);
                            foreach($Estudiantes as $Estudiante){
                                echo '<option value="'.$Estudiante['IdEstudiante'].'">'.$Estudiante['NombresEstudiante'].' '.$Estudiante['ApellidosEstudiante']."</option> ";
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
                    <label style="color: rgb(0, 3, 44);" for="materias" class="text-start">&nbsp;Materias: </label>
                    <select class="form-select mt-2" name="materias" id="Listamaterias" required>
                        <option value="">Seleccione una opcion</option>
                        <?php
                            $Materias = [];
                            $Materias = $MateriasCTR->ConsultarMaterias();
                            foreach($Materias as $Materia){
                                echo '<option value="'.$Materia['IdMateria'].'">'.$Materia['NombreMateria']."</option> ";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-12 d-none">
                    <label style="color: rgb(0, 3, 44);" for="ListaGrados" class="text-start">&nbsp;Grado: </label>
                    <select class="form-select mt-2" name="ListaGrados" id="ListaGrados" required>

                    </select>
                </div>
            </div>
            <input type="hidden" name="accion" id="accion" value="ConsultarCalificaciones">
            <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $_SESSION['Id']; ?>">
        </form>
        <hr>
    </div>  
    <!-- <form action="/proyecto/views/docente/asistencias/index.php" method="POST">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-12">
                <label style="color: rgb(0, 3, 44);" for="materia" class="text-start">&nbsp;Materia: </label>
                <select class="form-select mt-2" name="materia" id="listamateria" required>
                    <option value="">Seleccione una opcion</option>
                    <?php
                        // $Materias = [];
                        // $Materias = $DocenteCTR->consultarMaterias($_SESSION['Id']);
                        // // print_r($Materias);
                        // foreach($Materias as $Materia){
                        //     echo '<option value="'.$Materia['IdMateria'].'">'.$Materia['NombreMateria']."</option> ";
                        // }
                        
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
                <select class="form-select mt-2" name="ListaGrados" id="ListaGrado" required>
                    
                </select>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-success" style="margin-top: 31px;">Cargar</button>
            </div>
        </div>
        <input type="hidden" name="accion" id="accion" value="consultarInasistencias">
        <input type="hidden" name="IdUser" id="IdUser" value="<?php // echo $_SESSION['Id']; ?>">
    </form>
    <hr> -->
    
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
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
   </div>

</div>

<script>
    const selectGrados = $('#ListaGrados')

    $('#listaEstudiantes').change(function(){
        estudiante = $('#listaEstudiantes').val()

        const DataParam = {
            'accion': 'consultarGradoEstudiante',
            'IdEstudiante' : estudiante
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
            selectGrados.html('')

            result.map((Estudiante,index)=>{
                const htmloption = `<option value="${Estudiante.GradoEstudiante}">${Estudiante.GradoEstudiante}</option>` 
                selectGrados.append(htmloption)
            })
        })
    })
    
    $('#Listamaterias').change(function(){
        materia = $('#Listamaterias').val()
        estudiante = $('#listaEstudiantes').val()
        grado = $('#ListaGrados').val()
        periodo = $('#periodo').val()
        TablaContenido = $('#tabla').DataTable()
        cont = 0

        const DataParam = {
            'accion': 'consultarInasistencias',
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
            TablaContenido.clear().draw()

            result.map((DatosInasistecias,index)=>{
                cont++
                periodo = `${DatosInasistecias.Periodo}`
                switch(periodo){
                    case '1':
                        Periodo = 'Primero';
                    break;
                    case '2':
                        Periodo = 'Segundo';
                    break;
                    case '3':
                        Periodo = 'Tercero';
                    break;
                    case '4':
                        Periodo = 'Cuarto';
                    break;
                }
                TablaContenido.row.add([
                    `<td>${cont}</td>`,  
                    `<td>${DatosInasistecias.NombresEstudiante} ${DatosInasistecias.ApellidosEstudiante}</td>`,
                    `<td>${DatosInasistecias.NombreGrado}</td>`,
                    `<td>${DatosInasistecias.NombreMateria}</td>`,
                    `<td>${Periodo}</td>`,
                    `<td>${DatosInasistecias.Descripcion}</td>`,
                    `<td>${DatosInasistecias.Fecha}</td>`
                ]).draw()
            })
        })
    })

    // $('#listaGrados').change(function(){
    //     valor = $('#listaGrados').val()
    //     console.log(valor);
    //     const DataParam = {
    //         'accion': 'consultarEstudiantes',
    //         'idGrado': valor
    //     };
    //     const url = window.location.pathname
    //     fetch(url,{
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json;charset=utf-8'
    //         },
    //         body: JSON.stringify(DataParam)
    //     })
    //     .then(response => response.json())
    //     .then(result => {
    //         selectEstudiantes.html('<option value="">Seleccione una opcion</option>')

    //         result.map((Estudiante,index)=>{
    //             const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
    //             selectEstudiantes.append(htmloption)
    //         })
    //     })
    // })

    // $('#listaGradosE').change(function(){
    //     valor = $('#listaGradosE').val()
    //     const DataParam = {
    //         'accion': 'consultarEstudiantes',
    //         'idGrado': valor
    //     };
    //     const url = window.location.pathname
    //     fetch(url,{
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json;charset=utf-8'
    //         },
    //         body: JSON.stringify(DataParam)
    //     })
    //     .then(response => response.json())
    //     .then(result => {
    //         selectEstudiantesE.html('<option value="">Seleccione una opcion</option>')

    //         result.map((Estudiante,index)=>{
    //             const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
    //             selectEstudiantesE.append(htmloption)
    //         })
    //     })
    // })

    // function Eliminar(item, valor) {
    //     if (confirm("Seguro que desea eliminar este campo")) {
    //         $(`#fila${item}`).remove();
    //         EliminarDB(valor);
    //     }
    // }

    // function EliminarDB(valor) {
    //     const DataParam = {
    //         'accion': 'eliminar',
    //         'IdInasistencia': valor
    //     };
    //     console.log(valor);
    //     const url = window.location.pathname
    //     fetch(url,{
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json;charset=utf-8'
    //         },
    //         body: JSON.stringify(DataParam)
    //     })
    //     .then(response => response.json())
    //     .then(result => {
    //         console.log(result)
    //         let msg = '';
    //         if(result.error){
    //             msg = `<div id="AlertAsistencias" class="alert alert-danger">${result.error}</div>`
    //         }else if(result.success){
    //             msg = `<div id="AlertAsistencias" class="alert alert-success">${result.success}</div>`
    //         }

    //         $('#containerAlert').html(msg)
    //         setTimeout(() => {
    //             $('#AlertAsistencias').slideUp(100)
    //             location.reload();
    //         }, 3000);
    //     })
    
    // }
    
    // $('.editarInasistencia').on('click', async function(){
    //     const id_estudiante = $(this).data('id_estudiante')
    //     const grado = $(this).data('grado')
    //     const materia = $(this).data('materia')
    //     const periodo = $(this).data('periodo')
    //     const descripcion = $(this).data('descripcion')
    //     const fecha = $(this).data('fecha')
    //     const id_inasistencia = $(this).data('id_inasistencia')
    //     console.log(id_estudiante,grado,materia,periodo,descripcion,fecha,id_inasistencia);
        
    //     const DataParam = {
    //         'accion': 'consultarEstudiantes',
    //         'idGrado': grado
    //     };
    //     const url = window.location.pathname
    //     await fetch(url,{
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json;charset=utf-8'
    //         },
    //         body: JSON.stringify(DataParam)
    //     })
    //     .then(response => response.json())
    //     .then(result => {
    //         selectEstudiantesE.html('<option value="">Seleccione una opcion</option>')

    //         result.map((Estudiante,index)=>{
    //             const htmloption = `<option value="${Estudiante.IdEstudiante}">${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</option>` 
    //             selectEstudiantesE.append(htmloption)
    //         })
    //     })
        

    //     // Asignar valores a los campos del form
    //     $('#formEditarInasistencia').find('#listaGradosE').val(grado)
    //     $('#formEditarInasistencia').find('#listaMaterias').val(materia)
    //     $('#formEditarInasistencia').find('#periodo').val(periodo)
    //     $('#formEditarInasistencia').find('#descripcion').val(descripcion)
    //     $('#formEditarInasistencia').find('#fecha').val(fecha)
    //         $('#formEditarInasistencia').find('#idEstudiantE').val(id_estudiante)
    //     $('#formEditarInasistencia').find('#idInasistencia').val(id_inasistencia)

    //     // mostrar modal
    //     $('#ModalEditarInasistencias').modal('show')
    // })

    // $('#listamateria').change(function(){
    //     materia = $('#listamateria').val()
    //     IdUsuario = $('#IdUser').val()

    //     const DataParam = {
    //         'accion': 'consultarGradosMateria',
    //         'IdUser': IdUsuario,
    //         'materia': materia
    //     }
    //     const url = window.location.pathname
    //     fetch(url,{
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json;charset=utf-8'
    //         },
    //         body: JSON.stringify(DataParam)
    //     })
    //     .then(response => response.json())
    //     .then(result => {
    //         seleccionGrados.html('<option value="">Seleccione una opcion</option>')

    //         result.map((Grado,index)=>{
    //             const htmloptio = `<option value="${Grado.IdGrado}">${Grado.NombreGrado}</option>` 
    //             seleccionGrados.append(htmloptio)
    //         })
    //     })
    // })
</script>