<?php include('includes/slider.php'); ?>

<div class="col-9 my-3" id="vieTab">

    <a class="btn btn-success mb-3 " type="button" id="btnAdd" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar</a>

    <div id="alertas">

    </div>

    <div class="tabScroll" align="center">
        
        <!--GUARDAR PACIENTE-->

        <!--BORRAR PACIENTE-->



        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Medico</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Paciente</th>
                <th>Editar</th>
                <th>Elimiar</th>
            </thead>
            <tbody id="tbody">

                <!--Inicia itera cita-->
                <!--termina itera cita-->
            </tbody>
            
            <tfoot id="tfoot" >

            </tfoot>

        </table>

    </div>

</div>
</div>
</div>
</main>


<!--Modal-->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir nuevo cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="cita-form">
                    <div class="mb-3 row">
                        <label for="selMedic" class="col-sm-2 col-form-label">Medico</label>
                        <select id="selMedic" name="medID" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">
                            <option value="0" selected>Medico No Seleccionado</option>


                        </select>
                    </div>
                    <div class="mb-3 row">
                        <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha" name="Fecha" required>
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


                    <div class="mb-3 row">
                        <label for="selPaciente" class="col-sm-2 col-form-label">Paciente</label>
                        <select id="selPaciente" name="pacienteID" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">
                            <option value="0" selected>Paciente No Seleccionado</option>

                            <!--INICIA ITERA Pacientes-->

                            <!--Termina itera pacientes-->
                        </select>
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="save" value="Guardar" name="btnSaveCita">Guardar</button>
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
    $(document).ready(function() {
        //Despliega a Medicos
        fetchCitas();

        getMedicos();
        getPaciente();
        getImageUsr();


        function getImageUsr() {
            $.ajax({
                url: 'controllers/getImageUsr.php',
                type: 'POST',
                async: false,
                success: function(response) {
                    
                    $('.disclaimer').html('<p></p>');
                    if (response == 0) {


                    } else {
                        $('#usrImg').attr('src', response);
                    }



                }

            });
        }



        $(document).on("click", "#save", function(e) {
            var valor = "save";
            var medicoID = jQuery('#selMedic').val();
            var fecha = jQuery('#fecha').val();
            var horario = jQuery('#horario').val();
            var time = jQuery('#time').val();
            console.log(time);
            //var horario = '54465';
            var pacienteID = jQuery('#selPaciente').val();
            //console.log(fecha);



            //$('#Msg').html('<div class="loading"><img src="files/busy.gif" alt="loading" />&nbsp;&nbsp;Procesando, por favor espere...</div>');
            $.ajax({
                method: "POST",
                url: "controllers/newCita.php",
                cache: false,
                data: {
                    valor,
                    medicoID,
                    fecha,
                    horario,
                    pacienteID
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                        //$('#cita-form').trigger('reset');

                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });

                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Cita agregada satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        $('#cita-form').trigger('reset');
                        fetchCitas();

                    } else {
                        $('#cita-form').trigger('reset');
                        $("#alertas").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al agregar cita
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
                    medicos.forEach(medico => {
                        template += `<option value="${medico['ID']}">${medico['Nombres']} ${medico['Apellidos']}</option> `;
                    });

                    $('#selMedic').html(template);
                }


            });
        };



        function fetchCitas() {
            $.ajax({

                url: "controllers/showCitas.php",
                method: "GET",
                success: function(response) {

                    if (response.search('{') != -1) 
                        {
                            let citas = JSON.parse(response);
                            let template = ``;
                            let usr = ``;
                            citas.forEach(cita => {
                                template += `
                                    <tr attrID =${cita['idHorario']}>
                                        <td>${cita['idHorario']} </td>
                                        <td>${cita['NombreM']} </td>
                                        <td>${cita['Fecha']} </td>
                                        <td>${cita['Horario']} </td>
                                        <td>${cita['NombreP']} </td>
                                        <td align="center"> <a href="editCita.php?id=${cita['idHorario']}" class="far fa-edit buttonEdit" ></a> </td>
                                        <td align="center"> <button " type="submit" name="btnDeletMed" class="far fa-trash-alt buttonDelete"></button></td>
                                    </tr>
                                `;
                                usr = `<p>${cita['usr']}</p>`;
                            });

                            $('#tbody').html(template);
                            $('#usr').html(usr);
                            $('#tfoot').html('<div><div>');

                        }else
                        {
                            template = "<tr></tr>";
                            let empty = `
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <div class="text-center text-dark">
                                        <h1>No items</h1>
                                        <img src="img/empty.svg" class="w-75" alt="Empty" />
                                </div>
                            </div>
                            `;
                            $('#tbody').html(template);
                            $('#tfoot').html(empty);
                            $('#usr').html(response);
                        }


                    
                }


            });
        };




        $(document).on('click', ".buttonDelete", function() {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('attrID');

            $.ajax({
                type: 'POST',
                url: "controllers/deleteCita.php",
                data: {
                    id
                },
                success: function(response) {
                    if (response == 1) {
                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Se elimino satisfactoriamente c:
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);

                    } else {
                        $("#alertas").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    No se logró eliminar :c
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                    }
                    fetchCitas();
                }
            });
        });



        const aLinks = document.querySelectorAll(".aLink");

        aLinks.forEach(aLink => {
            aLink.classList.remove('acive');
            aLink.classList.add('text-white');
        });

        const aLink = document.getElementById(id = "aLink3");
        
        aLink.classList.remove('text-white');
        aLink.classList.add('active');



    });
</script>