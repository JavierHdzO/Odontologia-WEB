<?php 

     session_start();
    $usr = $_SESSION['usr'];

    include('../config.php');

    $upSent = $db->prepare("call sp_showMedicos()");			

	$upSent->execute();

	if($upSent->rowCount() > 0 )
	{

		$json = array();
		foreach($upSent as $row)
		{

			//print_r($row);
			$json[] = array(
				'ID' 			=> $row['ID'],
				'Cedula' 		=> $row['Cedula'],
				'Nombres' 		=> $row['Nombres'],
				'Apellidos' 	=> $row['Apellidos'],
				'Telefono' 		=> $row['Telefono'],
				'Especialidad' 	=> $row['Especialidad'],
				'usr'           => $usr
			);

		}

		$jsonstring = json_encode($json);
		
		echo $jsonstring;

	}else
	{
		
		echo $usr;
	}

		
?>