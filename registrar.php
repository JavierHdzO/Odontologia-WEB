<!--GUARDAR USUARIO-->
<!--Si no se guardo mandar advertencia de no guardado-->

<html>

<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Sign In</title>
    <!--Boostrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--Css stylesheet-->
    <link href="css/register.css" rel="stylesheet">
</head>

<body>

    <main class="container col-12">
     

        <div id="alertas">

        </div>


        <div class="container container-fluid mt-5">
            <form action="" id="formulario" class="form-registro" enctype="multipart/form-data">

                <div class="row">
                    <div class="col">
                        <label>Nombre</Label>
                        <input type="text" id="nombres" class="form-control" name="nombres" placeholder="Nombres" required>
                    </div>
                    <div class="col">
                        <label>Apellidos</label>
                        <input type="text" id="apellidos" class="form-control" name="apellidos" ID="txtBox_apellidos" placeholder="Apellidos" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label>Contraseña</label>
                        <input type="password" id="pass" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="col">
                        <label>Confirma tu contraseña</label>
                        <input type="password" class="form-control" id="pass_conf" name="password_conf" placeholder="Confirma tu contraseña" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class=" col">
                        <label>Usuario</label>
                        <input type="text" class="form-control" id="usr" name="usuario" placeholder="Usuario" required>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col">
                        <label for="formFile" class="form-label">Imagen de perfil</label>
                        <input id="foto" name="foto" class="form-control" type="file" id="formFile">
                    </div>
                </div>

                <div class="form-group my-2">
                    <center>
                        <a href="index.php"> Ya estoy registrado </a>
                    </center>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary btn-block" id="register" value="Guardar" name="btnGuardarUsr">Registrar </button>
                </center>
            </form>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        $(document).on('click', '#register', function(e) {
            var valor = jQuery('#register').val();
            console.log(valor);
            var formData = new FormData($('#formulario')[0]);
            
           
            $.ajax({
                url:'controllers/saveUsr.php',
                type:'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response)
                {
                    console.log(response);
                    let alerta = '';
                    if ( response == 1)
                    {

                        alerta = 
                        '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                                'Usuario agregado exitosamente c:'+
                               '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                         '</div>'
                        
                        ;

                    }else 
                    {
                        alerta = 
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                'No ha sido posible agregar al usuario :c'+
                               '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                         '</div>'
                        
                        ;
                    }
                    $('#formulario').trigger('reset');
                    $("#alertas").html(alerta);
                }


                
            });
            
            e.preventDefault();
        });
    });
</script>