<?php 

    include('../config.php');

    if(isset($_POST['valor']))
    {

        $medicoID   =   $_POST['medicoID'];
        $fecha      =   $_POST['fecha'];
        $horario    =   $_POST['horario'];
        $pacienteID =   $_POST['pacienteID']; 
        
    
        $upSent = $db->prepare("call sp_newCita(:medicoID, :fecha, :horario, :pacienteID)");

        $upSent->bindParam(':medicoID',$medicoID);
        $upSent->bindParam(':fecha',$fecha);
        $upSent->bindParam(':horario',$horario);
        $upSent->bindParam(':pacienteID',$pacienteID);
    
        if(!empty($fecha) && !empty($horario) && !empty($medicoID) && !empty($pacienteID)){ 
        $upSent->execute();

        if($upSent->rowCount() > 0)
        {
            echo 1;
        }else
        {
            echo 0;
        }
        }else
        {
            echo 0;
        }

    }

    
    		

?>