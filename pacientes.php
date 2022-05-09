<?php include('includes/slider.php'); ?>

<div class="col-9 my-3" id="vieTab">

    <a class="btn btn-success mb-3 " type="button" id="btnAdd" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar</a>

    <div id="alertas">

    </div>

    <div class="tabScroll" align="center">




        <table class="table table-bordered">
            <thead>
                <th>NoAsig</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Calle</th>
                <th>Numero</th>
                <th>Colonia</th>
                <th>Ciudad</th>
                <th>CP</th>
                <th>FechaNac</th>
                <th>Sexo</th>
                <th>Telefono</th>
                <th>Foto</th>
                <th>Editar</th>
                <th>Elimiar</th>
            </thead>
            <tbody id="tbody">

                <!--Inicia itera-->




                <!--Termina itera-->

            </tbody>
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
                <h5 class="modal-title" id="exampleModalLabel">Añadir nuevo paciente</h5>
                <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="pacien-form" enctype="multipart/form-data">

                    <div class="mb-3 row">
                        <label for="Nombres" class="col-sm-2 col-form-label">Nombres</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Nombres" name="nombres" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="Apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Apellidos" name="apellidos" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="Calle" class="col-sm-2 col-form-label">Calle</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Calle" name="calle" required>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="Colonia" class="col-sm-2 col-form-label">Colonia</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Colonia" name="Colonia" required>
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
                            <input type="number" class="form-control" id="noc" name="noc" required>
                        </div>

                        <label for="cp" class="col-sm-2 col-form-label">CP</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="cp" name="cp" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="Nac" class="col-sm-2 col-form-label">Fecha N</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="Nac" name="nacimiento" required>
                        </div>

                        <label for="Sexo" class="col-sm-2 col-form-label">Sexo</label>
                        <select id="Sexo" name="sexo" class="col-sm-4" aria-label=".form-select-sm example">
                            <option value="M" selected>Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="B">Binario</option>
                        </select>
                    </div>



                    <div class="mb-3 row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="Foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" id="Foto " name="foto" accept="image/png, image/gif, image/jpeg, image/jpg" class="form-control" name="foto">
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="save" value="Guardar" name="btnSaveMedico">Guardar </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    ///const navLinks = document.querySelectorAll();
</script>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    let ciudadesPacientes = {};
    $(document).ready(function() {
        //Despliega a Medicos
        getCiudades();
        fetchPacientes();
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
            var nombres = jQuery('#Nombres').val();
            var apellidos = jQuery('#Apellidos').val();
            var calle = jQuery('#Calle').val();
            var colonia = jQuery('#Colonia').val();
            var ciudad = jQuery('#ciudad').val();
            var noc = jQuery('#noc').val();
            var cp = jQuery('#cp').val();
            var nac = jQuery('#Nac').val();
            var sexo = jQuery('#Sexo').val();
            var telefono = jQuery('#telefono').val();

            var formData = new FormData($('#pacien-form')[0]);
            
            console.log(formData);


            //$('#Msg').html('<div class="loading"><img src="files/busy.gif" alt="loading" />&nbsp;&nbsp;Procesando, por favor espere...</div>');
            $.ajax({
                method: "POST",
                url: "controllers/newPaciente.php",
                cache: false,
                data:formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                        $('#pacien-form').trigger('reset');

                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });

                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Se agrego satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        fetchPacientes();

                    } else {
                        $('#pacien-form').trigger('reset');
                        $("#alertas").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error a agregar paciente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        //$("#Msg").html("<div class='alert alert-danger' role='alert'>Error.</div> ");
                    }
                }




            });
            e.preventDefault();
        });


        function fetchPacientes() {
            $.ajax({

                url: "controllers/showPacientes.php",
                method: "GET",
                success: function(response) {
                    $('.disclaimer').html('<p></p>');
                    //console.log(response);
                    let template = ``;
                    let usr = ``;
                    let valCiudad = '';

                    if (response.search('{') != -1) {
                        let pacientes = JSON.parse(response);
                        getCiudades();
                        pacientes.forEach(paciente => {
                            valCiudad = ciudadesPacientes[paciente['Ciudad']];

                            template += `
                                <tr attrID =${paciente['NoAsig']}>
                                    <td>${paciente['NoAsig']} </td>
                                    <td>${paciente['Nombres']} </td>
                                    <td>${paciente['Apellidos']} </td>
                                    <td>${paciente['Calle']} </td>
                                    <td>${paciente['Numero']} </td>
                                    <td>${paciente['Colonia']} </td>
                                    <td>${valCiudad} </td>
                                    <td>${paciente['CP']} </td>
                                    <td>${paciente['FechaNac']} </td>
                                    <td>${paciente['Sexo']} </td>
                                    <td>${paciente['Telefono']} </td>
                                    <td><img class="imgPac" src="${paciente['Foto']}" style="border-radius:10px; height:60px" > </td>
                                    <td align="center"> <a href="editPaciente.php?id=${paciente['NoAsig']}" class="far fa-edit buttonEdit" ></a> </td>
                                    <td align="center"> <button " type="submit" name="btnDeletMed" class="far fa-trash-alt buttonDelete"></button></td>
                                </tr>
                            `;
                            usr = `<p>${paciente['usr']}</p>`;
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
                url: "controllers/deletePaciente.php",
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
                    fetchPacientes();
                }
            });
        });


        function getCiudades() {
            $.ajax({
                url: 'controllers/showCiudades.php',
                type: 'GET',
                success: function(response) {
                    console.log(response);

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




        const aLinks = document.querySelectorAll(".aLink");

        aLinks.forEach(aLink => {
            aLink.classList.remove('acive');
            aLink.classList.add('text-white');
        });

        const aLink = document.getElementById(id = "aLink2");

        aLink.classList.remove('text-white');
        aLink.classList.add('active');









    });
</script>