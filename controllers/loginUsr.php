<?php 


    include("../config.php");

	if(isset($_GET["valor"])){
		
		
        $password       = $_GET["pass"];
        $usuario        = $_GET["usr"];


		$upSent = $db->prepare("call 	sp_findUser(:usuario,:password)");
            $upSent->bindParam(':usuario', $usuario);
            $upSent->bindParam(':password', $password);			

			
			
				$upSent->execute();		
				if ($upSent->rowCount() > 0){

					session_start();
					$_SESSION['usr'] =  $usuario;
					foreach($upSent as $row)
					{
						
						$_SESSION['idUsr'] = $row['Clave'];
					}
					
				    header("Location: ../medicos.php");

				}else{
					
					echo 0;
				}


		
	}
/*
    include("../config.php");
	if(isset($_POST["btnIngresar"])){
		
		
        $password       = $_POST["password"];
        $usuario        = $_POST["usuario"];

		$upSent = $db->prepare("call 	sp_findUser(:usuario,:password)");
            $upSent->bindParam(':usuario', $usuario);
            $upSent->bindParam(':password', $password);			

			
			
				$upSent->execute();
					
				if ($upSent->rowCount() > 0){
					session_start();
					$_SESSION['usr'] =    $usuario  ;
				    header("Location: ../medicos.php");

				}else{
					session_start();
                    $_SESSION['msg'] = "Usuario o contraseña no coinciden";
                    header("Location: ../index.php");
				}
			
	}
	
	*/

?>