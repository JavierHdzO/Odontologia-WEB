<?php 
	include("../config.php");


	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$db->exec("SET CHARACTER SET utf8");

	$nombre         = $_POST["nombres"];
	$apellidos      = $_POST["apellidos"];
	$password       = $_POST["password"];
	$password_conf  = $_POST["password_conf"];
	$usuario        = $_POST["usuario"];
	
	if (!empty($_FILES["foto"]["tmp_name"])) {
	
			//print_r("entre");
			$valores = $_FILES['foto'];
			$nombre_imagen = $_FILES['foto']['name'];
			$tipo_imagen = $_FILES['foto']['type'];
			$tam_imagen = $_FILES['foto']['size'];
		
			if($tam_imagen < (pow(10,6)*10))
			{
				$carpteta_dest = $_SERVER['DOCUMENT_ROOT'] . '/img/';
				move_uploaded_file($_FILES['foto']['tmp_name'], $carpteta_dest . $nombre_imagen);
				

				$foto =  '/img/' . $nombre_imagen;
				
				
			
			}
		
			
	

		//print_r($documento_dest);
	} else {
		$foto = 'NULL';
	}
	
	
	$upSent = $db->prepare("call sp_newUser(:usuario,:password,:nombre,:foto)");
	$upSent->bindParam(':usuario', $usuario);
	$upSent->bindParam(':password', $password);
	$upSent->bindParam(':nombre', $nombre);
	$upSent->bindParam(':foto', $foto, PDO::PARAM_LOB);
	
	if(!empty($nombre) && !empty($apellidos ) && !empty($password ) && !empty($usuario)){
    	if ($password == $password_conf) {
    		$upSent->execute();
    		if ($upSent->rowCount() > 0) {
    			
    	
    			echo 1;
    		} else {
    			
    			
    			echo 0;
    		}
    	}
	}else 
	{
	    echo 0;
	}




/*

	include("../config.php");

	$nombre         = $_POST["nombres"];
	$apellidos      = $_POST["apellidos"];
	$password       = $_POST["password"];
	$password_conf  = $_POST["password_conf"];
	$usuario        = $_POST["usuario"];
	
	if (!empty($_FILES["foto"]["tmp_name"])) {
	
			//print_r("entre");
			$valores = $_FILES['foto'];
			$nombre_imagen = $_FILES['foto']['name'];
			$tipo_imagen = $_FILES['foto']['type'];
			$tam_imagen = $_FILES['foto']['size'];
			$carpteta_dest = $_SERVER['DOCUMENT_ROOT'] . '/img/';
			move_uploaded_file($_FILES['foto']['tmp_name'], $carpteta_dest . $nombre_imagen);
		
		
			$imagen_objetivo = fopen($carpteta_dest . $nombre_imagen, "r");
			$foto = fread($imagen_objetivo, $tam_imagen);
		    //$foto = addslashes($foto);
			//$foto = mysqli_real_scape_string($foto);
			fclose($imagen_objetivo);
	

		//print_r($documento_dest);
	} else {
		$foto = 'NULL';
	}
	
	
	$upSent = $db->prepare("call sp_newUser(:usuario,:password,:nombre,:foto)");
	$upSent->bindParam(':usuario', $usuario);
	$upSent->bindParam(':password', $password);
	$upSent->bindParam(':nombre', $nombre);
	$upSent->bindParam(':foto', $foto,PDO::PARAM_LOB);
	
	if ($password == $password_conf) {
		$upSent->execute();
		//print_r('entre 2');
		if ($upSent->rowCount() > 0) {
			
	
			echo 1;
		} else {
			
			
			echo 0;
		}
	}

*/





/*
    include("../config.php");
	if(isset($_POST["btnGuardarUsr"])){
		$nombre         = $_POST["nombre"];
        $apellidos      = $_POST["apellidos"];
        $password       = $_POST["password"];
        $password_conf  = $_POST["password_conf"];
        $usuario        = $_POST["usuario"];
		$foto = 'NULL';

		$upSent = $db->prepare("call sp_newUser(:usuario,:password,:nombre,:foto)");
            $upSent->bindParam(':usuario', $usuario);
            $upSent->bindParam(':password', $password);			
			$upSent->bindParam(':nombre', $nombre);
            $upSent->bindParam(':foto', $foto);
			
			if($password == $password_conf)
			{
				$upSent->execute();
			
				if ($upSent->rowCount() > 0){
					//session_start();
					header("Location: ../index.php");
					$_SESSION['msg'] = 'Usuario agregado exitosamente';
					$_SESSION['mes_type'] = "success";
				echo 1;
				

				

				}else{
					//session_start();
					header("Location: ../index.php");
					echo 0;
				}
			}else
			{
				$_SESSION['msg_error'] = "Cotraseñas no coinciden";
				header("Location: ../registrar.php");
			}
	}
	
	*/

?>