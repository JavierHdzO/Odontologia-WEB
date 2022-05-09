<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Administracion</title>

        <!--Bootstrap 5-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!--FONTS AWESOME-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

        <!--Css styles-->

        <link  href="css/sidebars.css" rel="stylesheet" type="text/css">
        <link  href="css/mainCrud.css" rel="stylesheet" type="text/css">


    </head>
    <body>
        <!--Si la sesion no está activa - Mandar a login-->
        
        

        <!--Carga imagen de usuario-->
        
        
        <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="/">Odontologia</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href='controllers/closeSession.php'>Cerrar Sesion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <main>
            <div class="container-fluid ">
                <div class="row " id="divMain" >
                    <!-- <div class="col-3 bg-primary align-items-center " align="center">-->
                    <div class="col-3 m-0 bg-dark" id="slider">


                        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"  id="slider2" style="width: 100%; ">
                            <a href="../medicos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                                <span class="fs-4">Administración</span>
                            </a>
                            <hr>
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a  href="medicos.php" id="aLink1" class="nav-link  aLink" aria-current="page">
                                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                                        Medicos
                                    </a>
                                </li>
                                <li>
                                    <a href="pacientes.php" id="aLink2" class="nav-link text-white aLink">
                                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                                        Pacientes
                                    </a>
                                </li>
                                <li>
                                    <a href="citas.php" id="aLink3" class="nav-link text-white aLink">
                                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                                        Citas
                                    </a>
                                </li>

                            </ul>
                            <hr>
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                   
                                    
                                <img id="usrImg"  src="" alt="" width="32" height="32" class="rounded-circle me-2">
                
                                    
                                    <strong id="usr">
                                        
                                        
                                    </strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href='controllers/closeSession.php'>Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        </div>






                    </div>