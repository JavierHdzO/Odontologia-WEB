<?php 

    include('../config.php');
    //print_r($_GET['idParam']);
    if(isset($_GET['idParam']))
    {
        
        $id = $_GET['idParam'];
        $upSent = $db->prepare("call sp_findPaciente(:id)");			
        $upSent->bindParam(':id',$id);
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
                );
    
            }
    
            $jsonstring = json_encode($json);
            
            echo $jsonstring;
    
        }else
        {
    
           // echo 0;
                    
        }
    }


 if(isset($_POST['valor']))
    {
               $sql = '';
        $flag = true;
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

                $sql = "call 	sp_updatePaciente(:id,:nombres,:apellidos,:calle,:noc,:colonia ,:ciudad,:cp,:nac,:sexo,:telefono,:foto)";

			
			}
		
			$flag =true;
	

		//print_r($documento_dest);
	} else {
		$foto = 'NULL';
        $sql =  "call 	sp_updatePaciente2(:id,:nombres,:apellidos,:calle,:noc,:colonia ,:ciudad,:cp,:nac,:sexo,:telefono)";
        $flag =false;
	}



        $id = $_POST['valor'];
        $nombres    = $_POST['nombres'];
        $apellidos  = $_POST['apellidos'];
        $calle      = $_POST['calle'];
        $colonia    = $_POST['colonia'];
        $ciudad     = $_POST['ciudad'];
        $noc        = $_POST['noc'];
        $cp         = $_POST['cp'];
        $nac        = $_POST['nacimiento'];
        $sexo       = $_POST['sexo'];
        $telefono   = $_POST['telefono'];


        $upSent = $db->prepare($sql);
        $upSent->bindParam(':id',           $id);
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

        if($flag == true)
        {
           $upSent->bindParam(':foto',     $foto); 
        }
            
       
        
        $upSent->execute();
        
        //print_r($upSent->rowCount());
        if ($upSent->rowCount() > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
