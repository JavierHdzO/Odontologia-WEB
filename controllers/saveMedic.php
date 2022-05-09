<?php
	
        
        include('../config.php');
    	
    	if(isset($_POST["valor"])){
             
            $cedula         = $_POST["cedula"];
    		$nombres         = $_POST["nombres"];
            $apellidos      = $_POST["apellidos"];
            $telefono       = $_POST["telefono"];
            $especialidad   = $_POST["especialidad"];
    
    		$upSent = $db->prepare("call sp_newMedico(:cedula,:nombres,:apellidos,:telefono,:especialidad)");
    		if(!empty($cedula) && !empty($nombres) && !empty($apellidos) && !empty($especialidad)){
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
    		}else
    			{
    			    echo 0;
    			}
    	}
    
?>