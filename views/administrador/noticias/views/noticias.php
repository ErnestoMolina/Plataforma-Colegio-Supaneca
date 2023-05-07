<div class="col-lg-10 col-md-9 containerSection">
    <h1>Noticias</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertAcudiente" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge;?>
                </div>
                <script>
                    setTimeout(() => {
                        $('#AlertAcudiente').slideUp(100)
                    }, 4000);
                </script>
            <?php
                }
            ?>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 text-end">
            <!-- Boton del modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAñadirNoticia">
                <i class="bi bi-plus-lg"></i> Noticia
            </button>
        </div>
    </div>

    
   <div class="container mt-3 mb-3">
        <div class="table-responsive">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Titulo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        if(isset($Noticias)){
                            // $Noticias = array_reverse($Noticias, true);
                            foreach ($Noticias as $Noticia){
                                $cont++;
                                echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td>
                                    <img src="<?php echo $Noticia['Imagen'];?>" style="width: 150px;">
                                </td>
                                <td><?php echo $Noticia['Titulo'];?></td>
                                <td><?php echo $Noticia['Fecha'];?></td>
                                <td>
                                    <input type="hidden" name="idNoticia" id="idNoticia" value="<?php echo $Noticia['Id'];?>">
                                    <button type="button" class="btn btn-outline-danger p-1 pt-0 pb-0"
                                    onclick="Eliminar(<?= $cont;?>,'<?= $Noticia['Id']; ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary p-1 p-1 pt-0 pb-0 editarNoticia"
                                        data-id_noticia="<?php echo $Noticia['Id'];?>"
                                        data-titulo="<?php echo $Noticia['Titulo'];?>"
                                        data-descripcion="<?php echo $Noticia['Descripcion'];?>"
                                        data-imagen="<?php echo $Noticia['Imagen'];?>"
                                        data-fecha="<?php echo $Noticia['Fecha'];?>"

                                    >
                                        <i class="bi bi-pencil-square"></i>
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
   <!-- Modal crear Noticia -->
<div class="modal fade" id="ModalAñadirNoticia" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar una nueva noticia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/proyecto/views/administrador/noticias/index.php" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="titulo" class="text-start">&nbsp;Titulo: </label>
                            <input type="text" class="form-control" name="titulo" id="titulo" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion"
                            style="max-width: 100%; min-width: 100%; max-height: 90px; min-height: 90px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="imagen" class="text-start">&nbsp;Imagen: </label>
                            <input type="file" class="btn btn-secondary form-control" name="imagen" id="imagen" required>
                        </div>
                        <input type="hidden" name="accion" value="crearNoticia">
                        <button type="submit" class="btn btn-success mt-3 w-25">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Noticia -->
<div class="modal fade" id="ModalEditarNoticia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Noticia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formEditarNoticia" action="/proyecto/views/administrador/noticias/index.php" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="titulo" class="text-start">&nbsp;Titulo: </label>
                            <input type="text" class="form-control" name="titulo" id="titulo" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="descripcion" class="text-start">&nbsp;Descripcion: </label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion"
                            style="max-width: 100%; min-width: 100%; max-height: 90px; min-height: 90px;" required></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <label style="color: rgb(0, 3, 44);" for="imagen" class="text-start">&nbsp;Imagen: </label>
                            <input type="file" class="btn btn-secondary form-control" name="imagen" id="imagen">
                        </div>
                        <input type="hidden" name="accion" value="EditarNoticia">
                        <input type="hidden" name="idNoticia" id="idNoticia" value="">
                        <input type="hidden" name="direccion" id="direccion" value="">
                        <button type="submit" class="btn btn-success mt-3 w-25">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    const url = window.location.pathname;
        
    function Eliminar (item, IdNoticia) {
        if(confirm('¿Seguro que desea eliminar este campo?')){
            EliminarDB(IdNoticia, item);
        }
    }

    function EliminarDB(IdNoticia, item) {
        const DataParam = {
            'accion': 'eliminarNoticia',
            'IdNoticia': IdNoticia
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
                msg = `<div id="AlertAcudiente" class="alert alert-danger">${result.error}</div>`
            }else if(result.success){
                $(`#fila${item}`).remove();
                msg = `<div id="AlertAcudiente" class="alert alert-success">${result.success}</div>`
            }

            $('#containerAlert').html(msg)
            setTimeout(() => {
                $('#AlertAcudiente').slideUp(100)
                window.location.href = url;
            }, 3000);
        })
    
    }
    
    $('.editarNoticia').on('click', function(){
        const idNoticia = $(this).data('id_noticia')
        const titulo = $(this).data('titulo')
        const descripcion = $(this).data('descripcion')
        const imagen = $(this).data('imagen')
        const fecha = $(this).data('fecha')
        console.log(idNoticia,titulo,descripcion,imagen,fecha);
        
        // Asignar valores a los campos del form
        $('#formEditarNoticia').find('#idNoticia').val(idNoticia)
        $('#formEditarNoticia').find('#titulo').val(titulo)
        $('#formEditarNoticia').find('#descripcion').val(descripcion)
        $('#formEditarNoticia').find('#direccion').val(imagen)
        $('#formEditarNoticia').find('#fecha').val(fecha)

        // mostrar modal
        $('#ModalEditarNoticia').modal('show')
    })

    function VerificacionTextos(){
        if(!((event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32))){
            event.preventDefault()
        }
    }
</script>