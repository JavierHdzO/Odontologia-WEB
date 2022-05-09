<?php

    include('../config.php');



    $upSent = $db->prepare("call sp_showCiudades()");			

	$upSent->execute();

	if($upSent->rowCount() > 0 )
	{

		$json = array();
		foreach($upSent as $row)
		{

			//print_r($row);
			$json[] = array(
				'IdCiudad' 	    => $row['IdCiudad'],
				'Ciudad' 		=> $row['Ciudad'],
				'Estado' 		=> $row['Estado']
				
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