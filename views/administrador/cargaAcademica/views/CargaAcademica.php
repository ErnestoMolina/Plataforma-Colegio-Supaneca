<div class="col-10 containerSection">
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
                                    echo '<th>#</th>';
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
                                <td><?php echo $cont; ?></td>
                                <?php
                                    foreach($Materias as $Materia){
                                        $valor = $Materia['Field'];
                                        if($valor == "IdGrado"){
                                            
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
                                                if($valor == "IdGrado" || $valor == "NombreGrado" || $valor == "DirectorGrado"){
                                                ?>
                                                data-<?php echo $valor?> ="<?php echo $grado[$valor];?>"
                                        <?php
                                                }else{

                                                }
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
                            <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal Estudiantes del acudiente -->
<!-- <div class="modal fade" id="EstrudiantesAcudiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mt-2 text-center">
                        <span>Para eliminar el acudiente debe eliminar primero los siguientes estudiantes, ya que pertenece al acudiente</h1>    
                    </div>
                    <div class="col-12 mt-2">
                        <ul id="listEstudiantes"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script>
    const url = window.location.pathname;
        
    $('.editarAcudiente').on('click', function(){
        const IdGrado = $(this).data('idgrado')
        const NombreGrado = $(this).data('nombregrado')
        const DirectorGrado = $(this).data('directorgrado')
        console.log(IdGrado, NombreGrado, DirectorGrado);
        
        // Asignar valores a los campos del form
        $('#formEditarAcudiente').find('#IdGrado').val(IdGrado)
        $('#formEditarAcudiente').find('#NombreGrado').val(NombreGrado)
        $('#formEditarAcudiente').find('#DirectorGrado').val(DirectorGrado)
        // mostrar modal
        $('#ModalEditarAcudiente').modal('show')
    })
</script>