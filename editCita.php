<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Editar cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Css styles-->
    <link href="css/editables.css" rel="stylesheet">
</head>

<body>
    <main>
        <div id="alertas">

        </div>



        <div aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content formulario">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir nuevo cita</h5>
                        <a type="button" class="btn-close" href="citas.php" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">

                            <div class="mb-3 row col-sm-12">
                                <label for="selMedic" class="col-sm-2 col-form-label"><strong>Medico</strong></label>
                                <select id="selMedic" name="medID" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">

                                </select>
                            </div>




                            <!--Inicia itera CITTA-->

                            <div class="mb-3 row">
                                <label for="fecha" class="col-sm-2 col-form-label"><strong>Fecha</strong></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="fecha" value="" name="fecha" required>
                                </div>
                            </div>

                            <!--Aqui se debe cambiar por un select-->
                            <!--Aqui se debe cambiar por un select-->

                            <div class="mb-3 row">
                                <label for="horario" class="col-sm-2 col-form-label">Horario</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="horario" name="time" required>
                                </div>
                            </div>


                            <!--Termina itera cita -->

                            <div class="mb-3 row col-sm-12">
                                <label for="selPaciente" class="col-sm-2 col-form-label"><strong>Paciente </strong></label>
                                <select id="selPaciente" name="pacienteID" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">


                                </select>
                            </div>



                            <div class="modal-footer">
                                <a type="button" class="btn btn-secondary" href="citas.php">Cancelar</a>
                                <button type="submit" class="btn btn-primary" id="save" name="btnUpdateCita">Guardar</button>
                            </div>
                        </form>




                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {

        let params = new URLSearchParams(location.search);
        const idParam = params.get('id');

        console.log(idParam);
        //Despliega a Medicos
        getMedicos();
        getPaciente();
        fetchCitas();





        $(document).on("click", "#save", function(e) {
            var valor = "save";
            var medicoID = jQuery('#selMedic').val();
            var fecha = jQuery('#fecha').val();
            var horario = jQuery('#horario').val();
            var pacienteID = jQuery('#selPaciente').val();




            //$('#Msg').html('<div class="loading"><img src="files/busy.gif" alt="loading" />&nbsp;&nbsp;Procesando, por favor espere...</div>');
            $.ajax({
                method: "POST",
                url: "controllers/updateCita.php",
                cache: false,
                data: {
                    valor: idParam,
                    medicoID,
                    fecha,
                    horario,
                    pacienteID
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                        $('#cita-form').trigger('reset');

                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });

                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Cita actualizada satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        fetchCitas();

                    } else {
                        $('#pacien-form').trigger('reset');
                        $("#alertas").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al actualizar cita
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        //$("#Msg").html("<div class='alert alert-danger' role='alert'>Error.</div> ");
                    }
                }




            });
            e.preventDefault();
        });


        function getPaciente() {
            $.ajax({

                url: "controllers/showPacientes.php",
                method: "GET",
                success: function(response) {
                    //console.log(response);

                    let pacientes = JSON.parse(response);
                    let template = ``;
                    pacientes.forEach(paciente => {
                        template += `<option value="${paciente['NoAsig']}">${paciente['Nombres']} ${paciente['Apellidos']}</option> `;
                    });

                    $('#selPaciente').html(template);
                }


            });
        };

        function getMedicos() {
            $.ajax({

                url: "controllers/showMedic.php",
                method: "GET",
                success: function(response) {
                    let medicos = JSON.parse(response);
                    let template = ``;
                    //console.log(response);

                    medicos.forEach(medico => {
                        template += `<option value="${medico['ID']}">${medico['Nombres']} ${medico['Apellidos']}</option> `;
                    });

                    $('#selMedic').html(template);
                }


            });
        };



        function fetchCitas() {
            $.ajax({

                url: "controllers/updateCita.php",
                method: "GET",
                data: {
                    idParam
                },
                success: function(response) {
                    console.log(response);
                    let citas = JSON.parse(response);
                    let medicoId = '';
                    let fecha = '';
                    let horario = '';
                    let pacienteId = '';

                    citas.forEach(cita => {

                        medicoId = cita['NombreM'];
                        fecha = cita['Fecha'];
                        horario = cita['Horario'];
                        pacienteId = cita['NombreP'];;

                        var val = medicoId;
                        var sel = document.getElementById('selMedic');
                        var opts = sel.options;
                        for (var opt, j = 0; opt = opts[j]; j++) {
                            if (opt.value == val) {
                                sel.selectedIndex = j;
                                break;
                            }
                        }



                        var val = pacienteId;
                        var sel = document.getElementById('selPaciente');
                        var opts = sel.options;
                        for (var opt, j = 0; opt = opts[j]; j++) {

                            if (opt.value == val) {


                                sel.selectedIndex = j;
                                break;
                            }
                        }

                        document.querySelector('#fecha').setAttribute('value', fecha);
                        document.querySelector('#horario').setAttribute('value', horario);

                    });


                }


            });
        };











    });
</script>