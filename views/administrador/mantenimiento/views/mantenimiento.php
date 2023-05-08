<div class="col-lg-10 col-md-9 containerSection">
    <h1>Mantenimiento</h1>
    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-12" id="containerAlert">
            <?php
                if($mensagge != ''){
            ?>
                <div id="AlertAcudiente" class="alert <?php echo $tipoAlert; ?>">
                    <?php echo $mensagge; ?>
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
        <p>Este procedimiento se debe  realizar siempre que finalice un año academico para mantener
        un buen uso del software y evitar posibles errores de consistencia de datos.</p>
        <p class="mt-5">1. Eliminar Actividades (Tareas, talleres y evaluaciones.) creadas en el año lectivo.</p>
        <button type="button" class="btn btn-danger" id="DepurarActividades">Depurar</button>
        <p class="mt-5">2. Eliminar Calificaciones (Tareas, talleres y evaluaciones.) creadas en el año lectivo.</p>
        <button type="button" class="btn btn-danger" id="DepurarCalificaciones">Depurar</button>
        <p class="mt-5">2. Eliminar definitivas de los periodos creadas en el año lectivo.</p>
        <button type="button" class="btn btn-danger" id="DepurarDefinitivas">Depurar</button>
    </div>

</div>

<script>
    const url = window.location.pathname;
        
    $('#DepurarDefinitivas').on('click', function(){
        if(confirm('¿Seguro quiere eliminar las definitivas?')){
            DataParam = {
                'accion' : 'DepurarDefinitivas'
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
                let msg = '';
                if(result.error){
                    msg = `<div id="AlertEstudiante" class="alert alert-danger">${result.error}</div>`
                }else if(result.success){
                    msg = `<div id="AlertEstudiante" class="alert alert-success">${result.success}</div>`
                }

                $('#containerAlert').html(msg)
                setTimeout(() => {
                    $('#AlertEstudiante').slideUp(100)
                    location.reload();
                }, 3000);
            })
        }
    })
    $('#DepurarCalificaciones').on('click', function(){
        if(confirm('¿Seguro quiere eliminar las calificaciones?')){
            DataParam = {
                'accion' : 'DepurarCalificaciones'
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
                let msg = '';
                if(result.error){
                    msg = `<div id="AlertEstudiante" class="alert alert-danger">${result.error}</div>`
                }else if(result.success){
                    msg = `<div id="AlertEstudiante" class="alert alert-success">${result.success}</div>`
                }

                $('#containerAlert').html(msg)
                setTimeout(() => {
                    $('#AlertEstudiante').slideUp(100)
                    location.reload();
                }, 3000);
            })
        }
    })

    $('#DepurarActividades').on('click', function(){
        if(confirm('¿Seguro quiere eliminar las actividades?')){
            DataParam = {
                'accion' : 'DepurarActividades'
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
                let msg = '';
                if(result.error){
                    msg = `<div id="AlertEstudiante" class="alert alert-danger">${result.error}</div>`
                }else if(result.success){
                    msg = `<div id="AlertEstudiante" class="alert alert-success">${result.success}</div>`
                }

                $('#containerAlert').html(msg)
                setTimeout(() => {
                    $('#AlertEstudiante').slideUp(100)
                    location.reload();
                }, 3000);
            })
        }
    })

        // const nombreAcudiente = $(this).data('nombre')
</script>