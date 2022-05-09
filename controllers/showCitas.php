<?php 

    include('../config.php');
    
    session_start();
    
    $usr = $_SESSION['usr'];

    $upSent = $db->prepare("call sp_showCitas()");			

	$upSent->execute();

	if($upSent->rowCount() >0 )
	{
 
		

		$json = array();
		foreach($upSent as $row)
		{
			
			$json[] = array(
				'idHorario' 	=> $row['idHorario'],
				'NombreM' 		=> $row['NombreM'],
				'Fecha' 		=> $row['Fecha'],
				'Horario' 		=> $row['Horario'],
				'NombreP' 		=> $row['NombreP'],
				'usr'           =>$usr
			);

		}

		$jsonstring = json_encode($json);
		
		echo $jsonstring;

	}else
	{

		echo $usr;
                
	}

		

?>