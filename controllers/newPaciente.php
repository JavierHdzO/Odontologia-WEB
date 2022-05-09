<?php
include('../config.php');



if (!empty($_FILES["foto"]["tmp_name"])) {


			$valores = $_FILES['foto'];
			$nombre_imagen = $_FILES['foto']['name'];
			$tipo_imagen = $_FILES['foto']['type'];
			$tam_imagen = $_FILES['foto']['size'];
		
			if($tam_imagen < (pow(10,6)*10))
			{
				$carpteta_dest = $_SERVER['DOCUMENT_ROOT'] . '/img/';
				move_uploaded_file($_FILES['foto']['tmp_name'], $carpteta_dest . $nombre_imagen);
				
				
				$foto = '/img/' . $nombre_imagen;



			
			}
		
			
	

		//print_r($documento_dest);
	} else {
		$foto = 'NULL';
	}

    $nombres    = $_POST['nombres'];
    $apellidos  = $_POST['apellidos'];
    $calle      = $_POST['calle'];
    $colonia    = $_POST['Colonia'];
    $ciudad     = $_POST['ciudad'];
    $noc        = $_POST['noc'];
    $cp         = $_POST['cp'];
    $nac        = $_POST['nacimiento'];
    $sexo       = $_POST['sexo'];
    $telefono   = $_POST['telefono'];

    if(!empty($nombres) && !empty($apellidos) && !empty($calle) && !empty($colonia) && !empty($ciudad) && !empty($sexo) && !empty($telefono) && !empty($nac))
    {

    

    $upSent = $db->prepare("call sp_newPaciente(:nombres,:apellidos,:calle,:noc,:colonia ,:ciudad,:cp,:nac,:sexo,:telefono,:foto)");
    $upSent->bindParam(':nombres',      $nombres);
    $upSent->bindParam(':apellidos',    $apellidos);
    $upSent->bindParam(':calle',        $calle);
    $upSent->bindParam(':noc',          $noc);
    $upSent->bindParam(':colonia',      $colonia);
    $upSent->bindParam(':ciudad',       $ciudad);
    $upSent->bindParam(':cp',           $cp);
    $upSent->bindParam(':nac',          $nac);
    $upSent->bindParam(':sexo',         $sexo);
    $upSent->bindParam(':telefono',     $telefono);
    $upSent->bindParam(':foto',         $foto);
    $upSent->execute();
    
    
    if ($upSent->rowCount() > 0) {
        echo 1;
    } else {
        echo 0;
    }
    
    }else
    {
        echo 0;
    }
    

?>