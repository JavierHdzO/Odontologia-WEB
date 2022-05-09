<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Editar Paciente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Css styles-->
    <link href="css/editables.css" rel="stylesheet">
</head>

<body>


    <!--Reviar que la sesion sigue activa-->

    <!--Obtener imagen-->
    <div id="alertas">

    </div>

    <div aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content formulario">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar paciente</h5>
                    <a type="button" class="btn-close" href="pacientes.php" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <form action="" id="pacien-form" enctype="multipart/form-data">

                        <div class="mb-3 row">
                            <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombres" name="nombres" required value="">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="calle" class="col-sm-2 col-form-label">Calle</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="calle" name="calle" value="" required>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="colonia" class="col-sm-2 col-form-label">Colonia</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="colonia" name="colonia" value="" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ciudad" class="col-sm-2 col-form-label">Ciudad</label>
                            <select id="ciudad" name="ciudad" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">

                            </select>
                        </div>

                        <div class="mb-3 row">
                            <label for="noc" class="col-sm-2 col-form-label">Numero</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="noc" name="noc" value="" required>
                            </div>

                            <label for="cp" class="col-sm-2 col-form-label">CP</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="cp" name="cp" value="" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nacimiento" class="col-sm-2 col-form-label">Fecha N</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="nacimiento" name="nacimiento" value="" required>
                            </div>

                            <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                            <select id="sexo" name="sexo" class="col-sm-4" aria-label=".form-select-sm example">
                                <option value="M" selected>Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>



                        <div class="mb-3 row">
                            <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="telefono" name="telefono" value="<%=p_Telefono%>" required>
                            </div>
                        </div>
                        
                        
                        <img  src="" id="imgPaci" class="img-thumbnail rounded mx-auto d-block" alt="imagen del paciente">

                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name="foto" accept="image/png, image/gif, image/jpeg, image/jpg" class="form-control" id="foto" name="foto">
                            </div>
                        </div>



                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary" href="pacientes.php">Cancelar</a>
                            <button type="submit" class="btn btn-primary" id="save" value="Guardar" name="btnSavePaciente">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>

    let params = new URLSearchParams(location.search);
    const idParam = params.get('id');
    let ciudadesPacientes = {};

    $(document).ready(function() {
        //Despliega a Medicos
        getCiudades();
        fetchPaciente();


        $(document).on("click", "#save", function(e) {

            var formData = new FormData($('#pacien-form')[0]);
            formData.append('valor',idParam);
            console.log(formData);
            
            $.ajax({
                method: "POST",
                url: "controllers/updatePaciente.php",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                        $('#pacien-form').trigger('reset');

                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });

                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Se actualizo satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                            fetchPaciente();

                    } else {
                        $('#pacien-form').trigger('reset');
                        $("#alertas").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al actualizar paciente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                    }
                }




            });
            e.preventDefault();
        });


        function fetchPaciente() {
            $.ajax({

                url: "controllers/updatePaciente.php",
                method: "GET",
                data: {
                    idParam
                },
                success: function(response) {

                    console.log(response);

                    let pacientes = JSON.parse(response);
                    let noasig = ``;
                    let nombres = ``;
                    let apellidos = '';
                    let calle = '';
                    let colonia = '';
                    let ciudad = '';
                    let noc = '';
                    let cp = '';
                    let nacimiento = '';
                    let sexo = '';
                    let telefono = '';
                    let foto = '';

                    pacientes.forEach(paciente => {

                        noasig = ``;
                        nombres = paciente['Nombres'];
                        apellidos = paciente['Apellidos'];
                        calle = paciente['Calle'];
                        colonia = paciente['Colonia'] ;
                        //ciudad = paciente['Ciudad'];
                        noc = paciente['Numero'];
                        cp = paciente['CP'];
                        nacimiento = paciente['FechaNac'];
                        sexo = paciente['Sexo'];
                        telefono = paciente['Telefono'];
                    
                        $('#imgPaci').attr('src',paciente['Foto']);

                        var val = paciente['Sexo'];
                        var sel = document.getElementById('sexo');
                        var opts = sel.options;
                        for (var opt, j = 0; opt = opts[j]; j++) {
                            if (opt.value == val) {
                                sel.selectedIndex = j;
                                break;
                            }
                        }
                        
                        
                        val = paciente['Ciudad'];
                        console.log("este es el valor " + val);
                        sel = document.getElementById('ciudad');
                        opts = sel.options;
                        for (var opt, j = 0; opt = opts[j]; j++) {
                            if (opt.value == val) {
                                sel.selectedIndex = j;
                                break;
                            }
                        }


                    });

                    //document.querySelector('#cedula').removeAttribute('value');
                    //document.querySelector('#cedula').setAttribute('value', cedula);
                    document.querySelector('#nombres').setAttribute('value', nombres);
                    document.querySelector('#apellidos').setAttribute('value', apellidos);
                    document.querySelector('#calle').setAttribute('value', calle);
                    document.querySelector('#colonia').setAttribute('value', colonia);
                    //document.querySelector('#ciudad').setAttribute('value', ciudad);
                    document.querySelector('#noc').setAttribute('value', noc);
                    document.querySelector('#nacimiento').setAttribute('value', nacimiento);
                    document.querySelector('#cp').setAttribute('value', cp);
                    document.querySelector('#sexo').setAttribute('value', sexo);
                    document.querySelector('#telefono').setAttribute('value', telefono);
                }


            });
        };
        
        
        function getCiudades() {
            $.ajax({
                url: 'controllers/showCiudades.php',
                type: 'GET',
                success: function(response) {
                    //console.log(response);

                    let pacientes = JSON.parse(response);

                    let template = ``;
                    pacientes.forEach(paciente => {
                        ciudadesPacientes[paciente['IdCiudad']] = `${paciente['Ciudad']} ${paciente['Estado']}`;
                        template += `<option value="${paciente['IdCiudad']}">${paciente['Ciudad']} ${paciente['Estado']}</option> `;
                    });

                    $('#ciudad').html(template);


                }


            });
        }


    });

</script>