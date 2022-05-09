<?php 

    include('../config.php');

    if(isset($_GET['idParam']))
    {
        $id = $_GET['idParam'];
        $upSent = $db->prepare("call sp_findCita(:id)");			
        $upSent->bindParam(':id', $id);
        $upSent->execute();
    
        if($upSent->rowCount() >0 )
        {
     
            
    
            $json = array();
            foreach($upSent as $row)
            {
                //print_r($row);
                $json[] = array(
                    'idHorario' 	=> $row['idHorario'],
                    'NombreM' 		=> $row['MedicoId'],
                    'Fecha' 		=> $row['Fecha'],
                    'Horario' 		=> $row['Horario'],
                    'NombreP' 		=> $row['IdPaciente']
                );
    
            }
    
            $jsonstring = json_encode($json);
            
            echo $jsonstring;
    
        }else
        {
    
            echo 0;
                    
        }
    
    }

    if(isset($_POST['valor']))
    {

        $id = $_POST['valor'];
        $medicoID   =   $_POST['medicoID'];
        $fecha      =   $_POST['fecha'];
        $horario    =   $_POST['horario'];
        $pacienteID =   $_POST['pacienteID']; 

        $upSent = $db->prepare("call sp_updateCita(:id, :medicoID, :fecha, :horario, :pacienteID)");


        $upSent->bindParam(':id',$id);
        $upSent->bindParam(':medicoID',$medicoID);
        $upSent->bindParam(':fecha',$fecha);
        $upSent->bindParam(':horario',$horario);
        $upSent->bindParam(':pacienteID',$pacienteID);

     
        $upSent->execute();

        if($upSent->rowCount() > 0)
        {
            echo 1;
        }else
        {
            echo 0;
        }


    }
		

?>