
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
        <!--Boostrap 5-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- CSS styles  -->
        <link href="css/login.css" rel="stylesheet">
        
    </head>
    <body class="Background">

            <div id="alertas">

            </div>


            <div class= "container container-fluid mt-5" align="center">
                
                <form action=""  class="form-login">
                    <img src="img/logo.png"  class="img-fluid" ID="logoOdontología" alt="logo odontologia">
                    <div class="form-group mt-3 my-1">
                        <input type="text" class="form-control"  id="usr" name="usuario" placeholder="Usuario" required />
                    </div>
                    <div class="form-group mt-3 my-1">
                        <input type="password" class="form-control" id="pass" name="password" placeholder="Contraseña" required/>
                    </div>
                    <div class="form-group my-2">
                        <center>
                            <a href="registrar.php"> ¿No tienes una cuenta? </a>
                        </center>
                    </div>
                    <center>

                        <button type="submit" class="btn btn-primary btn-block my-2 " id="login" name="btnIngresar"   value="Iniciar Sesión">Ingresar</button>

                    </center>
                </form>


            </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    
    $(document).ready(function (){

        $(document).on('click','#login', function (e){
            let usr = jQuery('#usr').val();
            let pass = jQuery('#pass').val();
            let valor = "login";
            $.ajax({
                url: 'controllers/loginUsr.php',
                method: 'GET',
                data:
                {
                    valor,
                    usr,
                    pass
                },
                success: function (response)
                {
                    //console.log(response);
                    if(response == 0)
                    {
                        $('#alertas').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                            'Usruario o contraseña no coincide'+
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                        '</div>');
                    }else
                    {
                        window.location.href = "medicos.php";
                    }
                

                }
            });
            e.preventDefault();
        });
    });
</script>



