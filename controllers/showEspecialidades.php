<?php

    include('../config.php');



    $upSent = $db->prepare("call sp_Especialidades()");			

	$upSent->execute();

	if($upSent->rowCount() > 0 )
	{

		$json = array();
		foreach($upSent as $row)
		{

			//print_r($row);
			$json[] = array(
				'IdEspecialidad' 	=> $row['IdEspecialidad'],
				'Descripcion' 		=> $row['Descripcion']
				
			);

		}

		$jsonstring = json_encode($json);
		
		echo $jsonstring;

	}else
	{
        
		$jsonstring = json_encode(array());
		echo $jsonstring;
	}

?>