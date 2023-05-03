<div class="col-10 containerSection">
    <h1>Slider</h1>
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
                    }, 3000);
                </script>
            <?php
                }
            ?>
        </div>
    </div>

    
    <div class="container mt-3 mb-3">
        <p>Se recomienda utilizar imagenes o fotografias con una calidad de 1280 x 720 o superior</p>
        <div class="table-responsive">
            <table id="tabla" class="table table-light mt-3 pt-2">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $cont = 0;
                        foreach ($Imagenes as $Imagen){
                            $cont++;
                            echo '<tr id="fila'.$cont.'">'
                    ?>
                                <td><?php echo $cont; ?></td>
                                <td>
                                    <img src="<?php echo $Imagen['Direccion'];?>" style="width: 150px;">
                                </td>
                                <td><?php echo 'Imagen '.$cont;?></td>
                                <td>
                                    <form action="/proyecto/views/administrador/slider/index.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="idImagen" id="idImagen" value="<?php echo $Imagen['id'];?>">
                                        <input type="hidden" name="accion" value="EditarImagen">
                                        <input type="file" name="Archivo" class="btn btn-secondary mt-2" style="width: 250px">
                                        <button 
                                            type="submit" 
                                            class="btn btn-outline-success p-2 mt-2"
                                        >
                                            Guardar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        if($cont == 4){
                            break;
                        }
                        }
                    ?>
                </tbody>
            </table>
        </div>
   </div>
</div>
<script>
    const url = window.location.pathname;
        
    async function Eliminar (item, IdAcudiente) {
        const EstudiantesAcudiente = await validarEstudiantesAsociados(IdAcudiente);
        // console.log(EstudiantesAcudiente);
        if(EstudiantesAcudiente.length > 0){
            $('#listEstudiantes').html('');
            const listEstudiantes = $('#listEstudiantes');
            EstudiantesAcudiente.map((Estudiante, index) => {
                const liEstudiante = `<li>${Estudiante}</li>`;
                listEstudiantes.append(liEstudiante);
            });

            $('#EstrudiantesAcudiente').modal('show')
        }else{
            if(confirm('¿Seguro que desea eliminar este campo?'))
                EliminarDB(IdAcudiente, item);
            }
    }

    function EliminarDB(IdAcudiente, item) {
        const DataParam = {
            'accion': 'eliminarAcudiente',
            'IdAcudiente': IdAcudiente
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
    
    function validarEstudiantesAsociados(IdAcudiente) {
        const DataParam = {
            'accion': 'validarEstudiantesAsociados',
            'IdAcudiente': IdAcudiente
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
            const Estudiantes = result;
            const NombreEstudiantes = Estudiantes.map((Estudiante, index) => {
                return `${Estudiante.NombresEstudiante} ${Estudiante.ApellidosEstudiante}`;
            })

            return NombreEstudiantes;
        })
    
    }

    $('.editarAcudiente').on('click', function(){
        const nombreAcudiente = $(this).data('nombre')
        const apellidoAcudiente = $(this).data('apellido')
        const tipoDocumento = $(this).data('tipo_documento')
        const documento = $(this).data('documento')
        const fechaNacimiento = $(this).data('fecha_nacimiento')
        const IdAcudiente = $(this).data('id_acudiente')
        const contraseña = $(this).data('contraseña')
        const telefono = $(this).data('telefono')
        const email = $(this).data('email')
        console.log(nombreAcudiente, apellidoAcudiente, tipoDocumento, documento, fechaNacimiento, IdAcudiente, telefono, email);
        
        // Asignar valores a los campos del form
        $('#formEditarAcudiente').find('#nombreA').val(nombreAcudiente)
        $('#formEditarAcudiente').find('#apellidoA').val(apellidoAcudiente)
        $('#formEditarAcudiente').find('#listaDocumentosA').val(tipoDocumento)
        $('#formEditarAcudiente').find('#documentoA').val(documento)
        $('#formEditarAcudiente').find('#fechaNA').val(fechaNacimiento)
        $('#formEditarAcudiente').find('#idAcudiente').val(IdAcudiente)
        $('#formEditarAcudiente').find('#contraseñaA').val(contraseña)
        $('#formEditarAcudiente').find('#telefonoA').val(telefono)
        $('#formEditarAcudiente').find('#emailA').val(email)

        // mostrar modal
        $('#ModalEditarAcudiente').modal('show')
    })

    function VerificacionTextos(){
        if(!((event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32))){
            event.preventDefault()
        }
    }
</script>