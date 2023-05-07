<div class="col-lg-10 col-md-9 containerSection">
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
    <!-- <div class="container mt-3 mb-3">
        <form action="/proyecto/views/acudiente/observaciones/index.php" method="POST">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12 mt-2">
                    Grado:
                    <select class="form-select" name="grado" id="grado">
                        <?php
                            // foreach($Grados as $Grado){
                            //     echo '<option value="'.$Grado['IdGrado'].'">'.$Grado['NombreGrado'].'</option>';
                            // }
                        ?>
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <input type="hidden" name="accion" id="accion" value="ConsultarEstudiantesGrado">
                    <button type="submit" class="btn btn-success" style="margin-top: 31px;">Cargar</button>
                </div>
            </div>
        </form>
    </div> -->

    
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
                        $Estudiantes = [];
                        $Estudiantes = $EstudianteCTR->ConsultarEstudiantes('E.idAcudiente = '.$_SESSION['Id']);
                        // print_r($Materias);
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
    
    function AbrirModalConsulta(){
        $('#ModalConsultarObservacionesEstudiante').modal('show')
        $('#ModalEditarObservacion').modal('hide')
    }
</script>