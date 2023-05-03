<div class="col-10 containerSection">
    <h1 id="tt">Acta de Calificaciones Finales</h1>
    <div class="container mt-3 mb-3">
        <form action="/proyecto/views/docente/calificaciones/index.php" id="FormConsultaNotas" method="POST">
            <div class="row">
                <div class="col-lg-3 col-sm-12 col-md-12">
                    <label style="color: rgb(0, 3, 44);" for="vigencia" class="text-start">&nbsp;Vigencia: </label>
                    <select class="form-select mt-2" name="vigencia" id="vigencia" change="ValorVigencia()" required>
                        <option value="">Seleccione una opción</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-12">
                    <label style="color: rgb(0, 3, 44);" for="ListaGrados" class="text-start">&nbsp;Grado: </label>
                    <select class="form-select mt-2" name="ListaGrados" id="ListaGrados" required>
                        <option value="">Seleccione una opción</option>
                        <?php
                            foreach($Grados as $Grado){
                                echo '<option value="'.$Grado['IdGrado'].'">'.$Grado['NombreGrado'].'</option>';
                            }
                        ?>
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
                        <th>Estudiantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table_estudiantes">
                    
                </tbody>
            </table>
        </div>
   </div>
</div>

<!-- Modal boletin -->
<div class="modal fade" id="ModalBoletin" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Informe de evaluación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="DatosPDF">
                    <div class="row">
                        <div class="col-3" style="align-self: center; margin-left: 20px;">
                            <img src="/proyecto/img/EscudoSinFondo.png" style="width:36%;" alt="Escudo Institucional colegio Institucin Educativa Supaneca">
                        </div>
                        <div class="col-5 text-center">
                            <p style="font-size:12px; margin:0px; margin-left:20px;"><b>REPUBLICA DE COLOMBIA</b></p>
                            <p style="font-size:12px; margin:0px; margin-left:20px;"><b>SECRETARIA DE EDUCACIÓN DEPARTAMENTAL</b></p>
                            <p style="font-size:12px; margin:0px; margin-left:20px;"><b>INSTITUCIÓN EDUCATIVA SUPANECA</b></p>
                            <p style="font-size:12px; margin:0px; margin-left:20px;"><b>CONSTRUIMOS FUTURO</b></p>
                            <p style="font-size:12px; margin:0px; margin-left:20px;"><b>TIBANÁ - BOYACA</b></p>
                            <p style="font-size:12px; margin:0px; margin-left:20px;"><b>INFORME DE EVALUACIÓN</b></p>
                        </div>
                        <div class="col-3 text-end" style="align-self: center; margin-rigth: 20px;">
                            <img src="/proyecto/img/EscudoSinFondoColombia.png" style="width:36%;" alt="Escudo Institucional colegio Institucin Educativa Supaneca">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <div id="TableInformacion" class="table table-light mt-1 mb-1">
                        
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <table id="TableBoletin">
                        
                        </table>
                    </div>
                    <input type="hidden" name="accion" value="ImprimirPdf">
                </form>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-success mt-3 DescargarPdf">Descargar PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script> 
    const ListaEstudiantes = $('#table_estudiantes')
    const TablaBoletin = $('#TableBoletin')
    const TablaInformacion = $('#TableInformacion')

    function ValorVigencia(){
        vigencia = $('#vigencia').val()
        return vigencia
    }

    $('#ListaGrados').change(function(){
        const grado = $('#ListaGrados').val()
        vigencia = ValorVigencia()
        count = 1
        console.log(grado);
        const DataParam = {
            'accion' : 'ConsultarEstudiantes',
            'grado' : grado
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

            ListaEstudiantes.html('')
            result.map((Estudiante,index)=>{
                html = `
                <tr>
                    <td>${count++}</td>
                    <td>${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}</td>
                    <td>
                        <button class="btn btn-outline-primary verBoletin" title="Ver"
                        data-id_estudiante="${Estudiante.IdEstudiante}"
                        data-vigencia="${vigencia}"
                        >
                            <i class="bi-eye-fill"></i>
                        </button>
                    </td>
                </tr>
                `
                ListaEstudiantes.append(html)
            })
        })
    })
    
    $(document).on('click', '.verBoletin', function(){
        const Vigencia = $(this).data('vigencia')
        const IdEstudiante = $(this).data('id_estudiante')
        const grado = $('#ListaGrados').val()
        console.log(IdEstudiante,grado,Vigencia);
        cont = 0
        count = 0
        const DataParam = {
            'accion' : 'ConsultarBoletinFinal',
            'grado' : grado,
            'vigencia' : Vigencia,
            'IdEstudiante' : IdEstudiante
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
            cantidad = result.length
            promedio = 0
            console.log(result);
            htmlEncabezado = `
                <tr style="border: 1px solid black; padding: 5px;">
                    <td><strong style="margin-left: 2px;">Año:</strong> ${vigencia}        <strong style="margin-left: 1rem;">Periodo:</strong> DEFINITIVO     <strong style="margin-left: 1rem;">Especialidad:</strong> ACADEMICA</td> 
                    <input type="hidden" name="vigencia" id="vigencia" value="${vigencia}">
                    <input type="hidden" name="periodo" id="periodo" value="Definitivo">
                </tr>
                <tr style="border: 1px solid black; padding: 5px;">
                    <th style="border: 1px solid black; padding: 5px;">Nombre del area y/o asignatura</th>
                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Valoración</th>
                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Desempeño Final</th>
                </tr>
            `
            TablaInformacion.html('')
            TablaBoletin.html('')
            if(result != ''){
                TablaBoletin.append(htmlEncabezado)
                $('.DescargarPdf').removeAttr('disabled',true)
            }else{
                $('.DescargarPdf').attr('disabled',true)
            }
            result.map((DatosBoletin,index)=>{
                count++
                if(count <= 1){
                    switch(`${DatosBoletin.TipoDocumentoEstudiante}`){
                        case "Cedula de ciudadania":
                            Documento = 'C.C'
                        break
                        case "Tarjeta de identidad":
                            Documento = 'T.I'
                        break
                        case "Cedula Extranjera":
                            Documento = 'C.E'
                        break
                    }
                    htmlInfo = `
                        <hr>
                        <h5 class="text-center m-0">Certifican</h5>
                        <p style="font-size: 12px;"><b>Que el(la) Estudiante ${DatosBoletin.NombresEstudiante} ${DatosBoletin.ApellidosEstudiante}.</b></p>
                        <p style="font-size: 12px; margin-right: 1rem; margin-left: 1rem;">Identificado con ${Documento} No ${DatosBoletin.NDocumentoEstudiante} curso en 
                        esta institución educativa el GRADO ${DatosBoletin.NombreGrado} del nivel MEDIA ACADEMICA jornada UNICA durante el Año Lectivo ${vigencia},
                        obteniendo el siguiente informe final sobre procesos de desarrollo:</p>
                        <hr>
                        <input type="hidden" name="NombreEstudiante" id="NombreEstudiante" value="${DatosBoletin.NombresEstudiante} ${DatosBoletin.ApellidosEstudiante}">
                        <input type="hidden" name="grado" id="grado" value="${DatosBoletin.NombreGrado}">
                        <input type="hidden" name="documento" id="documento" value="${Documento}">
                        <input type="hidden" name="Ndocumento" id="Ndocumento" value="${DatosBoletin.NDocumentoEstudiante}">
                    `
                    TablaInformacion.append(htmlInfo)
                }
                materia = `${DatosBoletin.NombreMateria}`
                DataPara = {
                    'accion' : 'ConsultarDocente',
                    'grado' : grado,
                    'materia' : materia
                }
                fetch(url,{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(DataPara)
                })
                .then(response => response.json())
                .then(result => {
                    DataParame = {
                        'accion' : 'ConsultarNombreDocente',
                        'id' : result
                    }
                    fetch(url,{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8'
                        },
                        body: JSON.stringify(DataParame)
                    })
                    .then(response => response.json())
                    .then(result => {
                        cont++
                        console.log(cantidad);
                        result.map((DatosDocente,index)=>{
                            nombresDocente = `${DatosDocente.NombresDocente}`
                            apellidosDocente = `${DatosDocente.ApellidosDocente}`
                        })
                        promedio = promedio + parseFloat(`${DatosBoletin.Calificacion}` )
                        htmlDefinitivas = `
                            <tr style="border: 1px solid black; padding: 5px;">
                                <input type="hidden" name="CantidadMaterias" id="CantidadMaterias" value="${cont}">
                                <input type="hidden" name="Materia${cont}" id="Materia${DatosBoletin.NombreMateria}" value="${DatosBoletin.NombreMateria}">
                                <input type="hidden" name="NombreDocente${cont}" id="NombreDocente" value="${nombresDocente} ${apellidosDocente}">
                                <th style="border: 1px solid black; padding: 5px; width: 600px; ">${DatosBoletin.NombreMateria} <br> <i style="font-weight: normal;">Docente: ${nombresDocente} ${apellidosDocente}</i> </th>
                                <input type="hidden" name="Calificacion${cont}" id="Calificacion${DatosBoletin.NombreMateria}" value="${DatosBoletin.Calificacion}">
                                <th style="border: 1px solid black; padding: 5px; width: 100px; text-align: center;">${DatosBoletin.Calificacion}</th>
                                <input type="hidden" name="Desempeño${cont}" id="Desempeño${DatosBoletin.NombreMateria}" value="${DatosBoletin.Desempeño}">
                                <th style="border: 1px solid black; padding: 5px; width: 200px; text-align: center;">${DatosBoletin.Desempeño}</th>
                                <input type="hidden" name="Historial${cont}" id="Historial${DatosBoletin.NombreMateria}" value="${DatosBoletin.HistorialNotas}">
                            </tr>
                        `
                        TablaBoletin.append(htmlDefinitivas)
                        if(cantidad == cont){
                            promedio = promedio / cont
                            promedio = promedio.toFixed(1)
                            htmlpromedio = `
                                <tr>
                                    <th style="border: 1px solid black; padding: 5px;  width: 200px;">Promedio</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;" colspan="2">${promedio}</th>
                                </tr>
                            `
                            TablaBoletin.append(htmlpromedio)
                        }
                    })
                })
                
            })

        })
        // mostrar modal
        $('#ModalBoletin').modal('show')
    })

    $('.DescargarPdf').on('click', function(){
        const formulario = $('#DatosPDF')
        const DataParam = getFormData(formulario)
        console.log(DataParam);

        const url = window.location.pathname
        fetch(url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(DataParam)
        })
        .then(response => response.blob())
        .then(blob => {
            // Crear una URL a partir del blob recibido
            const url = URL.createObjectURL(blob);

            // Abrir una nueva pestaña del navegador para mostrar el PDF
            window.open(url);
        });
    })

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        unindexed_array.map((campo, index)=>{
            indexed_array[campo['name']] = campo['value'];
        });

        return indexed_array;
    }
</script>