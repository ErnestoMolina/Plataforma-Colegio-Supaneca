<div class="col-10 containerSection">
    <h1 id="tituloObservaciones">Observaciones</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertObservaciones" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertObservaciones').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="container mt-3 mb-3">
        <form action="/proyecto/views/docente/observaciones/index.php" method="POST">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12 mt-2">
                    Grado:
                    <select class="form-select" name="grado" id="grado">
                        <?php
                            foreach($Grados as $Grado){
                                echo '<option value="'.$Grado['IdGrado'].'">'.$Grado['NombreGrado'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <input type="hidden" name="accion" id="accion" value="ConsultarEstudiantesGrado">
                    <button type="submit" class="btn btn-success" style="margin-top: 31px;">Cargar</button>
                </div>
            </div>
        </form>
    </div>

    
   <div class="container mt-3 mb-3">
        <div class="table-responsive">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="listaE">
                    <?php
                        $cont = 0;
                        if($Estudiantes){
                            foreach ($Estudiantes as $Estudiante) {
                                $cont++;
                                $Documento = $Estudiante['NDocumentoEstudiante'];
                                echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $Estudiante['NombresEstudiante'];?></td>
                                <td><?php echo $Estudiante['ApellidosEstudiante'];?></td>
                                <td>
                                    <input type="hidden" name="idEstudiante" id="idEstudiante" value="<?php echo $Estudiante['IdEstudiante'];?>">
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 ConsultarObservacionesEstudiante"
                                        data-id_estudiante="<?php echo $Estudiante['IdEstudiante'];?>"
                                        data-nombre_estudiante="<?php echo $Estudiante['NombresEstudiante'].' '.$Estudiante['ApellidosEstudiante'];?>"
                                        data-tipo_documento="<?php echo $Estudiante['TipoDocumentoEstudiante'];?>"
                                        data-documento="<?php echo $Estudiante['NDocumentoEstudiante'];?>"
                                        data-grado="<?php echo $Estudiante['GradoEstudiante'];?>"
                                    >
                                        <abbr title="Ver"><i class="bi bi-eye-fill"></i></abbr>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-success p-1 p-1 pt-0 pb-0 AñadirObservacionesEstudiante"
                                        data-nombreestudiante="<?php echo $Estudiante['NombresEstudiante']." ".$Estudiante['ApellidosEstudiante'];?>"
                                        data-id_estudiante="<?php echo $Estudiante['IdEstudiante'];?>"
                                    >
                                        <abbr title="Agregar"><i class="bi bi-plus-lg"></i></abbr>
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

<!-- Modal crear observacion -->
<div class="modal fade" id="ModalAñadirObservacion" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar observación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="FormAñadirObservacionesEstudiante" action="/proyecto/views/docente/observaciones/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="NombreEstudiante" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="NombreEstudiante" id="NombreEstudiante" disabled>
                        </div>
                        <div class="col-6 mt-2">
                            Tipo:
                            <select class="form-select" name="tipo" id="tipo" required>
                                <option value="Disciplinaria">Disciplinaria</option>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            Seguimiento:
                            <input class="form-control" name="seguimiento" id="seguimiento" value="<?php echo $_SESSION['Usuario'];?>" disabled>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="observacion" class="text-start">&nbsp;Observacion: </label>
                            <textarea type="text" class="form-control" name="observacion" id="observacion" style="max-width: 100%; min-width: 100%; max-height: 70px; min-height: 70px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="versionEstudiante" class="text-start">&nbsp;Version del estudiante: </label>
                            <textarea type="text" class="form-control" name="versionEstudiante" id="versionEstudiante" style="max-width: 100%; min-width: 100%; max-height: 70px; min-height: 70px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="compromiso" class="text-start">&nbsp;Compromiso: </label>
                            <textarea type="text" class="form-control" name="compromiso" id="compromiso" style="max-width: 100%; min-width: 100%; max-height: 70px; min-height: 70px;" required></textarea>
                        </div>
                        <input type="hidden" name="IdDocente" value="<?php echo $_SESSION['Id'];?>">
                        <input type="hidden" name="accion" value="añadirObservacion">
                        <input type="hidden" name="idEstudiante" id="idEstudiante" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Modificar observacion -->
<div class="modal fade" id="ModalEditarObservacion" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar observación</h1>
                <button type="button" class="btn-close" onclick="AbrirModalConsulta()"></button>
            </div>
            <div class="modal-body">
                <form id="FormEditarObservacionEstudiante" action="/proyecto/views/docente/observaciones/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="NombreEstudiante" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="NombreEstudiante" id="NombreEstudianteEdit" disabled>
                        </div>
                        <div class="col-6 mt-2">
                            Tipo:
                            <select class="form-select" name="tipoEdit" id="tipoEdit" required>
                                <option value="Disciplinaria">Disciplinaria</option>
                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            Seguimiento:
                            <input class="form-control" name="seguimientoEdit" id="seguimientoEdit" value="<?php echo $_SESSION['Usuario'];?>" disabled>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="observacionEdit" class="text-start">&nbsp;Observacion: </label>
                            <textarea type="text" class="form-control" name="observacionEdit" id="observacionEdit" style="max-width: 100%; min-width: 100%; max-height: 70px; min-height: 70px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="versionEstudianteEdit" class="text-start">&nbsp;Version del estudiante: </label>
                            <textarea type="text" class="form-control" name="versionEstudianteEdit" id="versionEstudianteEdit" style="max-width: 100%; min-width: 100%; max-height: 70px; min-height: 70px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="compromisoEdit" class="text-start">&nbsp;Compromiso: </label>
                            <textarea type="text" class="form-control" name="compromisoEdit" id="compromisoEdit" style="max-width: 100%; min-width: 100%; max-height: 70px; min-height: 70px;" required></textarea>
                        </div>
                        <input type="hidden" name="IdDocenteEdit" id="IdDocenteEdit" value="<?php echo $_SESSION['Id'];?>">
                        <input type="hidden" name="idObservacionEdit" id="idObservacionEdit" value="">
                        <input type="hidden" name="idEstudianteEdit" id="idEstudianteEdit" value="">
                        <button type="button" class="btn btn-success mt-3 w-25 envioModificacionObservacion">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Consultar observaciones estudiante -->
<div class="modal fade" id="ModalConsultarObservacionesEstudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Observador Estudiante</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ObservadorEstudiante" action="/proyecto/views/administrador/estudiantes/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2" id="datosEstudiante">

                        </div>
                        <div class="col-12 mt-2" style="overflow-x: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Observacion</th>
                                        <th>Version Estudiante</th>
                                        <th>Compromiso</th>
                                        <th>Seguimiento</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="ObservacionesEstudiante">
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="accion" value="editarEstudiante">
                        <input type="hidden" name="idEstudiante" id="idEstudiante" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ListaEstudiantes = $('#listaE')
    ListaObservaciones = $('#ObservacionesEstudiante')


    // $('#listaGrados').change(function(){
    //     grado = $('#listaGrados').val()
    //     const DataParam = {
    //         'accion': 'ConsultarEstudiantesGrado',
    //         'grado': grado
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
    //         cont = 0
    //         ListaEstudiantes.html('')
    //         result.map((Estudiante,index)=>{
    //             const htmloption = `<tr>
    //             <td>${cont = cont + 1}</td>
    //             <td>${Estudiante.NombresEstudiante}</td>
    //             <td>${Estudiante.ApellidosEstudiante}</td>
    //             <td>
    //                 <button class="btn"><i class="bi-eye-fill"></i></button>
    //             </td>
    //             </tr>`
    //             ListaEstudiantes.append(htmloption)
    //         })

    //     })
    // })
    $('.envioModificacionObservacion').on('click', function(){
        const NombreEstudiante = $('#NombreEstudianteEdit').val()
        const tipo = $('#tipoEdit').val()
        const observacion = $('#observacionEdit').val()
        const versionEstudiante = $('#versionEstudianteEdit').val()
        const compromiso = $('#compromisoEdit').val()
        const IdDocente = $('#IdDocenteEdit').val()
        const idEstudiante = $('#idEstudianteEdit').val()
        const idObservacion = $('#idObservacionEdit').val()

        const DataParam = {
            'accion': 'EditarObservacion',
            'idEstudiante': idEstudiante,
            'tipo' : tipo,
            'observacion' : observacion,
            'versionEstudiante' : versionEstudiante,
            'compromiso' : compromiso,
            'seguimiento' : IdDocente,
            'idObservacion' : idObservacion
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
            const DataParam = {
                'accion': 'ConsultarObservacionesEstudiante',
                'IdEstudiante': idEstudiante
            }
            fetch(url,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(DataParam)
            })
            .then(response => response.json())
            .then(result => {
                ListaObservaciones.html('')
                let cont = 0
                result.map((Observacion,index)=>{
                    const DataParam = {
                        'accion': 'ConsultarDocente',
                        'IdDocente': `${Observacion.Seguimiento}`
                    }
                    fetch(url,{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8'
                        },
                        body: JSON.stringify(DataParam)
                    })
                    .then(response => response.json())
                    .then(result => {
                        result.map((Docente,index)=>{
                            cont++
                            const NombreDocente = `${Docente.NombresDocente} ${Docente.ApellidosDocente}`
                            const htmloption = `
                                <tr id="Fila${cont}">
                                    <td style="font-size: 11px;"><b>${Observacion.Tipo}</b></td>
                                    <td style="font-size: 11px;">${Observacion.Observacion}</td>
                                    <td style="font-size: 11px;">${Observacion.VersionEstudiante}</td>
                                    <td style="font-size: 11px;">${Observacion.Compromiso}</td>
                                    <td style="font-size: 12px;">${NombreDocente}</td>
                                    <td>${Observacion.Fecha}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary p-1 pt-0 pb-0"
                                        onclick="editarObservacion('${NombreEstudiante}',${Observacion.id},${Observacion.IdEstudiante},'${Observacion.Tipo}',
                                        '${Observacion.Observacion}','${Observacion.VersionEstudiante}','${Observacion.Compromiso}')">
                                            <abbr title="Editar"><i class="bi bi-pencil-square"></i></abbr>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                        onclick="Eliminar(${cont},${Observacion.id})">
                                                <abbr title="Eliminar"><i class="bi bi-trash"></i></abbr>
                                        </button>
                                    </td>
                                </tr>
                            ` 
                            ListaObservaciones.append(htmloption)
                        })
                    })
                })
            })
            alert(result['success'])
        })
        
        $('#ModalConsultarObservacionesEstudiante').modal('show')
        $('#ModalEditarObservacion').modal('hide')
    })

    $('.ConsultarObservacionesEstudiante').on('click', function(){
        const IdEstudiante = $(this).data('id_estudiante')
        const NombreEstudiante = $(this).data('nombre_estudiante')
        const TipoDocumento = $(this).data('tipo_documento')
        const Documento = $(this).data('documento')
        const Grado = $(this).data('grado')

        const DataParame = {
            'accion': 'ConsultarGrado',
            'IdGrado': Grado
        }
        const url = window.location.pathname
        fetch(url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(DataParame)
        })
        .then(response => response.json())
        .then(result => {
            result.map((Grado,index)=>{
                const grado = `${Grado.NombreGrado}`
                const datos = $('#datosEstudiante')
                datos.html('')
                var html = `<h6>Nombre: ${NombreEstudiante}</h6>
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tipo de documento</th>
                                        <th>Numero documento</th>
                                        <th>Grado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>${TipoDocumento}</td>
                                        <td>${Documento}</td>
                                        <td>${grado}</td>
                                    </tr>
                            
                `
                datos.append(html)
            })
        })

        const DataParam = {
            'accion': 'ConsultarObservacionesEstudiante',
            'IdEstudiante': IdEstudiante
        }
        fetch(url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(DataParam)
        })
        .then(response => response.json())
        .then(result => {
            ListaObservaciones.html('')
            let cont = 0
            result.map((Observacion,index)=>{
                const DataParam = {
                    'accion': 'ConsultarDocente',
                    'IdDocente': `${Observacion.Seguimiento}`
                }
                fetch(url,{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(DataParam)
                })
                .then(response => response.json())
                .then(result => {
                    result.map((Docente,index)=>{
                        cont++
                        const NombreDocente = `${Docente.NombresDocente} ${Docente.ApellidosDocente}`
                        const htmloption = `
                            <tr id="Fila${cont}">
                                <td style="font-size: 11px;"><b>${Observacion.Tipo}</b></td>
                                <td style="font-size: 11px;">${Observacion.Observacion}</td>
                                <td style="font-size: 11px;">${Observacion.VersionEstudiante}</td>
                                <td style="font-size: 11px;">${Observacion.Compromiso}</td>
                                <td style="font-size: 12px;">${NombreDocente}</td>
                                <td>${Observacion.Fecha}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary p-1 pt-0 pb-0"
                                    onclick="editarObservacion('${NombreEstudiante}',${Observacion.id},${Observacion.IdEstudiante},'${Observacion.Tipo}',
                                    '${Observacion.Observacion}','${Observacion.VersionEstudiante}','${Observacion.Compromiso}')">
                                        <abbr title="Editar"><i class="bi bi-pencil-square"></i></abbr>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(${cont},${Observacion.id})">
                                            <abbr title="Eliminar"><i class="bi bi-trash"></i></abbr>
                                    </button>
                                </td>
                            </tr>
                        ` 
                        ListaObservaciones.append(htmloption)
                    })
                })
            })
        })
          // mostrar modal
          $('#ModalConsultarObservacionesEstudiante').modal('show')
    })
    
    $('.AñadirObservacionesEstudiante').on('click', function(){
        const IdEstudiante = $(this).data('id_estudiante')
        const NombreEstudiante = $(this).data('nombreestudiante')
        
        // Asignar valores a los campos del form
        $('#FormAñadirObservacionesEstudiante').find('#idEstudiante').val(IdEstudiante)
        $('#FormAñadirObservacionesEstudiante').find('#NombreEstudiante').val(NombreEstudiante)

        // mostrar modal
        $('#ModalAñadirObservacion').modal('show')
    })

    function Eliminar(item, valor) {
        if (confirm("Seguro que desea eliminar este campo")) {
            $(`#Fila${item}`).remove();
            EliminarDB(valor);
        } else {
        }
    }

    function EliminarDB(valor) {
        const DataParam = {
            'accion': 'eliminarObservacion',
            'idObservacion': valor
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
            alert(result['success'])
            
        })
    
    }
    
    function editarObservacion(NombreEstudiante,idObservacion,idEstudiante,tipo,observacion,version,compromiso){
        
        // Asignar valores a los campos del form
        $('#FormEditarObservacionEstudiante').find('#NombreEstudianteEdit').val(NombreEstudiante)
        $('#FormEditarObservacionEstudiante').find('#tipoEdit').val(tipo)
        $('#FormEditarObservacionEstudiante').find('#observacionEdit').val(observacion)
        $('#FormEditarObservacionEstudiante').find('#versionEstudianteEdit').val(version)
        $('#FormEditarObservacionEstudiante').find('#compromisoEdit').val(compromiso)
        $('#FormEditarObservacionEstudiante').find('#idObservacionEdit').val(idObservacion)
        $('#FormEditarObservacionEstudiante').find('#idEstudianteEdit').val(idEstudiante)

        // mostrar modal
        $('#ModalEditarObservacion').modal('show')
        $('#ModalConsultarObservacionesEstudiante').modal('hide')
    }
    function AbrirModalConsulta(){
        $('#ModalConsultarObservacionesEstudiante').modal('show')
        $('#ModalEditarObservacion').modal('hide')
    }
</script>