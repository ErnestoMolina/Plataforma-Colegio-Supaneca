<div class="col-10 containerSection">
    <h1>Materias</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertMateria" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertMateria').slideUp(100)
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirMateria">
                <i class="bi bi-plus-lg"></i> Materia
            </button>
        </div>
    </div>

    
   <div class="container mt-3 mb-3">
        <div class="table-responsive">
            <table style="width:500px;" id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Materias as $Materia) {
                            $cont++;
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $Materia['NombreMateria'];?></td>
                                <td>
                                    <input type="hidden" name="idMateria" id="idMateria" value="<?php echo $Materia['IdMateria'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,'<?= $Materia['IdMateria']; ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarMateria"
                                        data-nombre="<?php echo $Materia['NombreMateria'];?>"
                                        data-id_materia="<?php echo $Materia['IdMateria'];?>"

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

<!-- Modal crear Materia -->
<div class="modal fade" id="ModalAñadirMateria" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Materia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proyecto/views/administrador/Materias/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreM" class="text-start">&nbsp;Materia: </label>
                            <input type="text" class="form-control" name="nombreM" id="nombreM" required>
                        </div>
                        <input type="hidden" name="accion" value="crearMateria">
                        <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Materia -->
<div class="modal fade" id="ModalEditarMateria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Materia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarMateria" action="/proyecto/views/administrador/Materias/index.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="nombreM" class="text-start">&nbsp;Nombre: </label>
                            <input type="text" class="form-control" name="nombreM" id="nombreM" required>
                        </div>
                        <input type="hidden" name="accion" value="editarMateria">
                        <input type="hidden" name="idMateria" id="idMateria" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modla docentes de la materia -->
<div class="modal fade" id="DocentesMateria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 mt-2 text-center">
                        <span>Para eliminar la materia debe eliminar primero los siguientes <strong>docentes</strong>, ya que pertenece a la materia.</h1>    
                    </div>
                    <div class="col-12 mt-2">
                        <ul id="listDocentes"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   const url = window.location.pathname;
        
    async function Eliminar (item, IdMateria) {
        const DocentesMateria = await validarDocentesAsociados(IdMateria);
        // console.log(DocentesMateria);
        if(DocentesMateria.length > 0){
            $('#listDocentes').html('');
            const listDocentes = $('#listDocentes');
            DocentesMateria.map((Docente, index) => {
                const liDocente = `<li>${Docente}</li>`;
                listDocentes.append(liDocente);
            });

            $('#DocentesMateria').modal('show')
        }else{
            if(confirm('¿Seguro que desea eliminar este campo?'))
                EliminarDB(IdMateria, item);
            }
    }

    function EliminarDB(IdMateria, item) {
        const DataParam = {
            'accion': 'eliminarMateria',
            'idMateria': IdMateria
        };
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
                msg = `<div id="AlertMateria" class="alert alert-danger">${result.error}</div>`
            }else if(result.success){
                $(`#fila${item}`).remove();
                msg = `<div id="AlertMateria" class="alert alert-success">${result.success}</div>`
            }

            $('#containerAlert').html(msg)
            setTimeout(() => {
                $('#AlertMateria').slideUp(100)
                window.location.href = url;
            }, 3000);
        })
    
    }
        
        function validarDocentesAsociados(IdMateria) {
            console.log(IdMateria);
            const DataParam = {
                'accion': 'validarDocentesAsociados',
                'idMateria': IdMateria
            };
            return fetch(url,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(DataParam)
            })
            .then(response => response.json())
            .then(result => {
                const Docentes = result;
                const NombreDocentes = Docentes.map((Docente, index) => {
                    return `${Docente.NombresDocente} ${Docente.ApellidosDocente}`;
                })
                // console.log(NombreDocentes);
                return NombreDocentes;
            })
        
        }
    
    
    $('.editarMateria').on('click', function(){
        const nombreMateria = $(this).data('nombre')
        const IdMateria = $(this).data('id_materia')
        console.log(nombreMateria, IdMateria);
        
        // Asignar valores a los campos del form
        $('#formEditarMateria').find('#nombreM').val(nombreMateria)
        $('#formEditarMateria').find('#idMateria').val(IdMateria)

        // mostrar modal
        $('#ModalEditarMateria').modal('show')
    })
</script>