<?php 

    include('../config.php');
    
    //print_r($_GET['idParam']);
    if(isset($_GET['idParam']))
    {
        $id = $_GET['idParam'];
        //print_r($id);
        $upSent = $db->prepare("call sp_findMedico(:ID)");
        $upSent->bindParam(":ID",$id);			
        $upSent->execute();
    
        if($upSent->rowCount() >0 )
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
                    'Especialidad' 	=> $row['Especialidad']
                );

                //print_r($json);
    
            }
    
            $jsonstring = json_encode($json);
            
            echo $jsonstring;
    
        }else
        {
    
            echo 0;
                    
        }
    }


    if(isset($_POST["valor"])){
        $id = $_POST["valor"];
        //print_r($id);
        $cedula         = $_POST["cedula"];
		$nombres         = $_POST["nombres"];
        $apellidos      = $_POST["apellidos"];
        $telefono       = $_POST["telefono"];
        $especialidad   = $_POST["especialidad"];

		$upSent = $db->prepare("call 	sp_updateMedico(:id,:cedula,:nombres,:apellidos,:telefono,:especialidad)");	
            $upSent->bindParam(':id', $id);	
			$upSent->bindParam(':cedula', $cedula);
            $upSent->bindParam(':nombres', $nombres);
            $upSent->bindParam(':apellidos', $apellidos);
            $upSent->bindParam(':telefono', $telefono);
            $upSent->bindParam(':especialidad', $especialidad);
			$upSent->execute();

			if ($upSent->rowCount() > 0){
			    echo 1;
			}else{
				echo 0;
			}
	}

		

?>