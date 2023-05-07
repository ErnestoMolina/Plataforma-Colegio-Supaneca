<div class="col-lg-10 col-md-9 containerSection">
    <h1>Carga Académica</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertCargaAcademica" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertCargaAcademica').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>

    
   <div class="container mt-3 mb-3">
        <div class="table-responsive">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <?php
                            foreach ($Materias as $Materia) {
                                $valor = $Materia['Field'];
                                if($valor == "IdGrado"){
                                    echo '
                                    <th>#</th>
                                    <th>Cantidad Estudiantes</th>
                                    ';
                                }elseif($valor == "NombreGrado"){
                                    echo '<th>Grado</th>';
                                }elseif($valor == "DirectorGrado"){
                                    echo '<th>Director</th>';
                                }else{

                                
                        ?>
                        <th><?php echo $valor; ?></th>
                        <?php
                                }
                            }
                        ?>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($grados as $grado){
                            $cont++;
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><strong><?php echo $cont; ?></strong></td>
                                <?php
                                    foreach($Materias as $Materia){
                                        $valor = $Materia['Field'];
                                        if($valor == "IdGrado"){
                                            $Estudiantes = $EstudiantesCTR->ConsultarEstudiantes("GradoEstudiante = {$grado[$valor]} AND Estado = 'Vinculado'");
                                            // $Cantidad = $Estudiantes->num_rows;
                                            $Cantidad = 0;
                                            foreach($Estudiantes as $Estudiante){
                                                $Cantidad++;
                                            }
                                            echo '<td class="text-center"><div class="tagMateria">'.$Cantidad.'</div></td>';
                                        }elseif($valor == "NombreGrado"){
                                ?>          
                                        <td><?php echo $grado[$valor];?></td>
                                        <?php
                                        }else{
                                            $consultaDocentes = $CargaAcademicaCTR->ConsultaDocentesID($grado[$valor]);
                                            if($consultaDocentes){
                                                foreach($consultaDocentes as $Docentes){
                                                    $nombres = $Docentes['NombresDocente'];
                                                    $apellidos = $Docentes['ApellidosDocente'];
                                                }
                                                echo '<td value="'.$grado[$valor].'">'.$nombres.' '.$apellidos.'</td>';
                                            }else{
                                                echo '<td value=""></td>';
                                            }
                                        
                                        }
                                    }
                                ?>
                                <td>
                                    
                                    <input type="hidden" name="idgrado" id="idgrado" value="<?php echo $grado['IdGrado'];?>">
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarAcudiente"
                                        <?php
                                            foreach($Materias as $Materia){
                                                $valor = $Materia['Field'];
                                                ?>
                                                data-<?php echo $valor?> ="<?php echo $grado[$valor];?>"
                                        <?php
                                                
                                            }
                                        ?>
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

<!-- Modal Editar acudiente -->
<div class="modal fade" id="ModalEditarAcudiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Asignar Carga Académica</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarAcudiente" action="/proyecto/views/administrador/cargaAcademica/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="NombreGrado" class="text-start">&nbsp;Grado: </label>
                            <input type="text" class="form-control" name="NombreGrado" id="NombreGrado" disabled required>
                        </div>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="DirectorGrado" class="text-start">&nbsp;Director de grado: </label>
                            <select class="form-select" name="DirectorGrado" id="DirectorGrado" required>
                                <?php
                                    $valor = '';
                                    $consultaDirectores = $CargaAcademicaCTR->ConsultaDocentes($valor);
                                    foreach($consultaDirectores as $Directores){
                                ?>
                                <option value="<?php echo $Directores['IdDocente']; ?>"><?php echo $Directores['NombresDocente']." ".$Directores['ApellidosDocente']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                            foreach($Materias as $Materia){
                                $valor = $Materia['Field'];
                                if($valor == "IdGrado"){

                                }elseif($valor == "NombreGrado"){

                                }elseif($valor == "DirectorGrado"){

                                }else{  
                                
                        ?>
                        <div class="col-6 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="<?php echo $valor?>" class="text-start">&nbsp;<?php echo $valor; ?>: </label>
                            <select class="form-select" name="<?php echo $valor?>" id="<?php echo $valor?>" required>
                                <option value="100">Sin Asignacion</option>
                                <option value="99">No ven esta materia.</option>
                                <?php
                                    $consultaDocentes = $CargaAcademicaCTR->ConsultaDocentes($valor);
                                    foreach($consultaDocentes as $Docentes){
                                ?>
                                <option value="<?php echo $Docentes['IdDocente']; ?>"><?php echo $Docentes['NombresDocente']." ".$Docentes['ApellidosDocente']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <?php
                                }
                            }
                        ?>
                        <input type="hidden" name="accion" value="editarAcudiente">
                        <input type="hidden" name="IdGrado" id="IdGrado" value="">
                        <div class="col-12 mt-2 text-center">
                            <button type="submit" class="btn btn-success mt-3 w-25" id="btnEditarCargaAcademica" disabled>Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const url = window.location.pathname;

    $('.editarAcudiente').on('click', function(){
        const IdGrado = $(this).data('idgrado')
        const NombreGrado = $(this).data('nombregrado')
        const DirectorGrado = $(this).data('directorgrado')
        const Matematicas = $(this).data('matematicas')
        const Religion = $(this).data('religion')
        const Fisica = $(this).data('fisica')
        const Naturales = $(this).data('naturales')
        const Español = $(this).data('español')
        const Ciencias_Sociales = $(this).data('ciencias_sociales')
        const Ingles = $(this).data('ingles')
        const Etica = $(this).data('etica')
        const Quimica = $(this).data('química')
        console.log(IdGrado, NombreGrado, DirectorGrado,Etica);


        
        // Asignar valores a los campos del form
        $('#formEditarAcudiente').find('#IdGrado').val(IdGrado)
        $('#formEditarAcudiente').find('#NombreGrado').val(NombreGrado)
        $('#formEditarAcudiente').find('#DirectorGrado').val(DirectorGrado)
        $('#formEditarAcudiente').find('#Matematicas').val(Matematicas)
        $('#formEditarAcudiente').find('#Religion').val(Religion)
        $('#formEditarAcudiente').find('#Fisica').val(Fisica)
        $('#formEditarAcudiente').find('#Naturales').val(Naturales)
        $('#formEditarAcudiente').find('#Español').val(Español)
        $('#formEditarAcudiente').find('#Ciencias_Sociales').val(Ciencias_Sociales)
        $('#formEditarAcudiente').find('#Ingles').val(Ingles)
        $('#formEditarAcudiente').find('#Etica').val(Etica)
        $('#formEditarAcudiente').find('#Química').val(Quimica)
        // mostrar modal
        $('#ModalEditarAcudiente').modal('show')
    })

    $('#Matematicas, #Religion, #Fisica, #Naturales, #Español, #Ciencias_Sociales, #Ingles, #Etica, #Química').change(function(){
        $('#btnEditarCargaAcademica').removeAttr("disabled")
    })
    
    $('#DirectorGrado').change(function(){
        const DirectorGrado = $('#DirectorGrado').val()
        const NombreGrado = $('#NombreGrado').val()
        console.log(DirectorGrado,NombreGrado);
        const DataParam = {
            'accion' : 'ConsultarDirectores',
            'NombreGrado' : NombreGrado,
            'IdDirector' : DirectorGrado
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
            console.log(result)
            if(result.success){
                alert(result.success)
                $('#btnEditarCargaAcademica').removeAttr("disabled")
            }else if(result.error){
                alert(result.error)
                $('#btnEditarCargaAcademica').prop("disabled",true)
            }else if(result.permitir){
                alert(result.permitir)
                $('#btnEditarCargaAcademica').removeAttr("disabled")
            }
        })
    })
</script>