<?php include('includes/slider.php'); ?>




<div class="col-9 my-3" id="vieTab">

    <a class="btn btn-success mb-3 " type="button" id="btnAdd" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar</a>





    <div id="alertas">

    </div>

    <div class="tabScroll" align="center">


        <!--
                            -->

        <!--Guardar medico-->

        <!--Borrar elemento de tabla-->



        <table class="table table-bordered">
            <thead>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Especialidad</th>
                <th>Editar</th>
                <th>Elimiar</th>
            </thead>
            <tbody id="tbody">

                <!--Itera while-->



                <!--Cierra itera while-->

            </tbody>
            <tfoot id="tfoot">

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
                <h5 class="modal-title" id="exampleModalLabel">Añadir nuevo medico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="medic-form">
                    <div class="mb-3 row">
                        <label for="cedula" class="col-sm-2 col-form-label">Cédula</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control-plaintext" id="cedula" name="cedula" requiered>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="especialidad" class="col-sm-2 col-form-label">Especialidad</label>
                        <select id="especialidad" name="especialidad" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">

                        </select>
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-primary" name="btnSaveMedico">Guardar</button>
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
    let especialidadMedico = {} ;

    $(document).ready(function() {
        //Despliega a Medicos
        espeMedico();
        
        getEspecialidades();
        getImageUsr();
        fetchMedicos();
        

        function getImageUsr()
        {
            $.ajax({
                url:'controllers/getImageUsr.php',
                type: 'GET',
                success: function (response)
                {
                    $('.disclaimer').html('<p></p>');
                    template = response;
                    
                    $('#usrImg').attr('src', template)
                    
                }

            });
        }
        

        $(document).on("click", "#save", function(e) {
            var valor = "save";
            var cedula = jQuery('#cedula').val();
            var nombres = jQuery('#nombres').val();
            var apellidos = jQuery('#apellidos').val();
            var telefono = jQuery('#telefono').val();
            var especialidad = jQuery('#especialidad').val();


            //$('#Msg').html('<div class="loading"><img src="files/busy.gif" alt="loading" />&nbsp;&nbsp;Procesando, por favor espere...</div>');
            $.ajax({
                method: "POST",
                url: "controllers/saveMedic.php",
                cache: false,
                data: {
                    valor: valor,
                    cedula: cedula,
                    nombres: nombres,
                    apellidos: apellidos,
                    telefono: telefono,
                    especialidad: especialidad
                },
                success: function(data) {
                    //console.log("si esta entrando");
                    
                    if (data == 1) {
                        //console.log("si esta entrando");
                        $('#medic-form').trigger('reset');

                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });

                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Se agrego satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        fetchMedicos();

                    } else {
                        jQuery('#cedula').val('');
                        jQuery('#nombres').val('');
                        jQuery('#apellidos').val('');
                        jQuery('#telefono').val('');
                        jQuery('#especialidad').val('');
                        //$("#Msg").html("<div class='alert alert-danger' role='alert'>Error.</div> ");
                    }
                }




            });
            e.preventDefault();
        });


        function fetchMedicos() {
            $.ajax({

                url: "controllers/showMedic.php",
                method: "GET",
                success: function(response) {
                    $('.disclaimer').html('<p></p>');
                    espeMedico();
                    let template = ``;
                        let usr = ``;
                    if (response.search('{') != -1) {
                        let medicos = JSON.parse(response);
                        let template = ``;
                        let usr = ``;

                        medicos.forEach(medico => {

                            let realEspecialidad = especialidadMedico[medico['Especialidad']];

                            template += `
                                <tr attrID =${medico['ID']}>
                                    <td>${medico['Cedula']} </td>
                                    <td>${medico['Nombres']} </td>
                                    <td>${medico['Apellidos']} </td>
                                    <td>${medico['Telefono']} </td>
                                    <td>${realEspecialidad} </td>
                                    <td align="center"> <a href="editMedic.php?id=${medico['ID']}" class="far fa-edit buttonEdit" ></a> </td>
                                    <td align="center"> <button " type="submit" name="btnDeletMed" class="far fa-trash-alt buttonDelete"></button></td>
                                </tr>
                            `;
                            usr = `<p>${medico['usr']}</p>`;

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
                url: "controllers/deleteMedic.php",
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
                    fetchMedicos();
                }
            });
        });


        function getEspecialidades()
        {
            $.ajax({
                url:"controllers/showEspecialidades.php",
                type: "GET",
                success: function (response){
                    
                    let especialidades = JSON.parse(response);
                 
                    let template = ``;
                    especialidades.forEach(especialidad => {
                         especialidadMedico[especialidad['IdEspecialidad']]= especialidad['Descripcion'];
                        template += `<option value="${especialidad['IdEspecialidad']}">${especialidad['Descripcion']} </option> `;
                    });

                    $('#especialidad').html(template);

                }
            });


        }


        function espeMedico() {
            $.ajax({
                url: "controllers/showEspecialidades.php",
                type: "GET",
                success: function(response) {
             
                    let especialidades = JSON.parse(response);

                    let template = ``;
                    especialidades.forEach(especialidad => {
                        
                        especialidadMedico[especialidad['IdEspecialidad']]= especialidad['Descripcion'];
                    });
               



                }
            });

        }



        const aLinks = document.querySelectorAll(".aLink");

        aLinks.forEach(aLink => {
            aLink.classList.remove('acive');
            aLink.classList.add('text-white');
        });

        const aLink = document.getElementById(id = "aLink1");
        aLink.classList.remove('text-white');
        aLink.classList.add('active');


    });
</script>