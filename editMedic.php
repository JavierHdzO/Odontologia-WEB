<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medico</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Css styles-->
    <link href="css/editables.css" rel="stylesheet">
</head>

<body>

    <div id="alertas"></div>

    <div aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content formulario">
                <div class="modal-header ">
                    <h5 class="modal-title" id="exampleModalLabel">Editar medico</h5>
                    <a type="button" class="btn-close" href="medicos.php" aria-label="Close"></a>
                </div>
                <div class="modal-body ">
                    <form action="#" method="POST">

                        <div class="mb-3 row">
                            <label for="cedula" class="col-sm-2 col-form-label"><strong>Cédula</strong></label>
                            <div class="col-sm-10">
                                <input type="text" value="<%=cedu%>" class="form-control" id="cedula" name="cedula" requiered>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nombres" class="col-sm-2 col-form-label"><strong>Nombres</strong></label>
                            <div class="col-sm-10">
                                <input type="text" value="<%=names%>" class="form-control" id="nombres" name="nombres" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="apellidos" class="col-sm-2 col-form-label"><strong>Apellidos</strong></label>
                            <div class="col-sm-10">
                                <input type="text" value="<%=last_names%>" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="telefono" class="col-sm-2 col-form-label"><strong>Telefono</strong></label>
                            <div class="col-sm-10">
                                <input type="tel" value="<%=tel%>" class="form-control" id="telefono" name="telefono" required>
                            </div>
                        </div>


                        <div class="mb-3 row">


                            <label for="especialidad" class="col-sm-2 col-form-label"><strong>Especialidad</strong></label>
                            <select id="especialidad" name="especialidad" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">
                                
                            </select>


                        </div>




                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary" href="medicos.php">Cancelar</a>
                            <button type="submit" class="btn btn-primary" id="save" value="Guardar" name="btnUpdateMedico">Guardar</button>
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
    
    $(document).ready(function() {
        //Despliega a Medicos
        getEspecialidades();
        fetchMedicos();


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
                url: "controllers/updateMedic.php",
                cache: false,
                data: {
                    valor: idParam,
                    cedula,
                    nombres,
                    apellidos,
                    telefono,
                    especialidad
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                        

                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Se actualizo satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        fetchMedicos();

                    }else
                    {
                        $("#alertas").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    No actualizo satisfactoriamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                    }
                }




            });
            e.preventDefault();
        });


        function fetchMedicos() {
            $.ajax({

                url: "controllers/updateMedic.php",
                method: "GET",
                data:{idParam},
                success: function(response) {

                    console.log(response);
                    let medicos = JSON.parse(response);
                    let cedula = ``;
                    let nombres = ``;
                    let apellidos = '';
                    let telefono = '';
                    let especialidad = '';
                    medicos.forEach(medico => {

                        cedula      = medico['Cedula'];
                        nombres     = medico['Nombres'];
                        apellidos   = medico['Apellidos'];
                        telefono    = medico['Telefono'];


                        var val = medico['Especialidad'];
                        var sel = document.getElementById('especialidad');
                        var opts = sel.options;
                        for (var opt, j = 0; opt = opts[j]; j++) {
                            if (opt.value == val) {
                                sel.selectedIndex = j;
                                break;
                            }
                        }


                    });

                    //document.querySelector('#cedula').removeAttribute('value');
                    document.querySelector('#cedula').setAttribute('value',cedula);
                    document.querySelector('#nombres').setAttribute('value',nombres);
                    document.querySelector('#apellidos').setAttribute('value',apellidos);
                    document.querySelector('#telefono').setAttribute('value',telefono);
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
                        template += `<option value="${especialidad['IdEspecialidad']}">${especialidad['Descripcion']} </option> `;
                    });

                    $('#especialidad').html(template);

                }
            });


        }



    });
</script>