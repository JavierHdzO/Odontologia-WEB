<?php 

    include('../config.php');
    
    session_start();
    
    $usr  = $_SESSION['usr'];

    $upSent = $db->prepare("call sp_showPaciente()");			

	$upSent->execute();

	if($upSent->rowCount() >0 )
	{
		

		

		$json = array();
		foreach($upSent as $row)
		{
			//print_r($row);
			$json[] = array(
				'NoAsig' 	=> $row['NoAsig'],
				'Nombres' 	=> $row['Nombres'],
				'Apellidos' => $row['Apellidos'],
				'Calle'     => $row['Calle'],
				'Numero' 	=> $row['Numero'],
				'Colonia'   => $row['Colonia'],
				'Ciudad'    => $row['Ciudad'],
				'CP' 	    => $row['CP'],
				'FechaNac' 	=> $row['FechaNac'],
				'Sexo' 	    => $row['Sexo'],
				'Telefono' 	=> $row['Telefono'],
				'Foto' 	    => $row['Foto'],
				'usr'       => $usr
			);

		}

		$jsonstring = json_encode($json);
		
		echo $jsonstring;

	}else
	{
		echo $usr;
	}

		

?>