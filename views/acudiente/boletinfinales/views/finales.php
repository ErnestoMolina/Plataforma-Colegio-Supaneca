<div class="col-10 containerSection">
    <h1 id="tt">Informe de evaluación</h1>
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
            </div>
            <input type="hidden" name="accion" id="accion" value="ConsultarCalificaciones">
            <input type="hidden" name="IdUser" id="IdUser" value="<?php echo $_SESSION['Id']; ?>">
        </form>
        <hr>
        <div class="table-responsive mt-2" id="tab" style="display: none;">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Estudiantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table_estudiantes">
                    <?php
                        $cont = 1;
                        $Estudiantes = [];
                        $Estudiantes = $EstudianteCTR->ConsultarEstudiantes('E.idAcudiente = '.$_SESSION['Id']);
                        foreach ($Estudiantes as $Estudiante){
                    ?>
                        <tr>
                            <td><?php echo $cont++; ?></td>
                            <td><?php echo $Estudiante['NombresEstudiante'].' '.$Estudiante['ApellidosEstudiante'];?></td>
                            <td>
                                <input type="hidden" name="idEstudiante" id="idEstudiante" value="<?php echo $Estudiante['IdEstudiante'];?>">
                                <button 
                                    type="button" 
                                    class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 VerBoletin"
                                    data-id_estudiante="<?php echo $Estudiante['IdEstudiante'];?>"
                                    data-grado="<?php echo $Estudiante['GradoEstudiante'];?>"
                                >
                                    <abbr title="Ver"><i class="bi bi-eye-fill"></i></abbr>
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
                    <div class="col-12 d-flex justify-content-center m-2">
                        <table id="TableInformacion" class="table table-light mt-3 mb-2">
                        
                        </table>
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

    $('#vigencia').change(function(){
        vigencia = ValorVigencia()
        count = 1
        btnVer = $('.VerBoletin')

        btnVer.attr({
            'data-vigencia' : vigencia
        })
        Datos = $('#tab')
        Datos.attr("style","display: block;")
    })
    
    $(document).on('click', '.VerBoletin', function(){
        const Vigencia = $(this).data('vigencia')
        const IdEstudiante = $(this).data('id_estudiante')
        const grado = $(this).data('grado')
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
                    <th style="border: 1px solid black; padding: 5px;">Nombre del area y/o asignatura</th>
                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Def</th>
                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Desempeño</th>
                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Historial Final</th>
                </tr>
            `
            TablaInformacion.html('')
            TablaBoletin.html('')
            if(result != ''){
                TablaBoletin.append(htmlEncabezado)
            }
            result.map((DatosBoletin,index)=>{
                count++
                if(count <= 1){
                    htmlInfo = `
                        <tr>
                            <th>Estudiante:</th>
                            <input type="hidden" name="NombreEstudiante" id="NombreEstudiante" value="${DatosBoletin.NombresEstudiante} ${DatosBoletin.ApellidosEstudiante}">
                            <td>${DatosBoletin.NombresEstudiante} ${DatosBoletin.ApellidosEstudiante}</td>
                            <th>Curso:</th>
                            <input type="hidden" name="grado" id="grado" value="${DatosBoletin.NombreGrado}">
                            <td>${DatosBoletin.NombreGrado}</td>
                            <th>Jornada:</th>
                            <td>UNICA</td>
                        </tr>
                        <tr>
                            <th>Acudiente:</th>
                            <input type="hidden" name="NombreAcudiente" id="NombreAcudiente" value="${DatosBoletin.NombresAcudiente} ${DatosBoletin.ApellidosAcudiente}">
                            <td>${DatosBoletin.NombresAcudiente} ${DatosBoletin.ApellidosAcudiente}</td>
                            <th>Periodo:</th>
                            <input type="hidden" name="periodo" id="periodo" value="Definitivo">
                            <td>Definitivo</td>
                            <input type="hidden" name="vigencia" id="vigencia" value="${vigencia}">
                            <th>Año:</th>
                            <td>${vigencia}</td>
                        </tr>
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
                                <th style="border: 1px solid black; padding: 5px; width: 400px; ">${DatosBoletin.NombreMateria} <br> <i style="font-weight: normal;">Docente: ${nombresDocente} ${apellidosDocente}</i> </th>
                                <input type="hidden" name="Calificacion${cont}" id="Calificacion${DatosBoletin.NombreMateria}" value="${DatosBoletin.Calificacion}">
                                <th style="border: 1px solid black; padding: 5px; width: 100px; text-align: center;">${DatosBoletin.Calificacion}</th>
                                <input type="hidden" name="Desempeño${cont}" id="Desempeño${DatosBoletin.NombreMateria}" value="${DatosBoletin.Desempeño}">
                                <th style="border: 1px solid black; padding: 5px; width: 50px; text-align: center;">${DatosBoletin.Desempeño}</th>
                                <input type="hidden" name="Historial${cont}" id="Historial${DatosBoletin.NombreMateria}" value="${DatosBoletin.HistorialNotas}">
                                <th style="border: 1px solid black; padding: 5px;  width: 200px; text-align: center;">${DatosBoletin.HistorialNotas}</th>
                            </tr>
                        `
                        TablaBoletin.append(htmlDefinitivas)
                        if(cantidad == cont){
                            promedio = promedio / cont
                            promedio = promedio.toFixed(1)
                            htmlpromedio = `
                                <tr>
                                    <th style="border: 1px solid black; padding: 5px;  width: 200px;">Promedio</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;" colspan="3">${promedio}</th>
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