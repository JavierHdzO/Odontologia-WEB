<?php
    session_start();

    include('../config.php');

    if(isset($_SESSION['idUsr']))
    {
        $idUsr = $_SESSION['idUsr'];

        $upSent = $db->prepare("call sp_getPhotoUser(:idUsr)");
        $upSent->bindParam(':idUsr',$idUsr);

        $upSent->execute();

        $foto = '';
        //print_r('entre');
        if($upSent->rowCount() > 0)
        {
            //print_r('entrex2');
            foreach($upSent as $row)
            {
                //print_r($row);
                $foto = $row['foto'];
            }

            echo $foto;

        }
        else
        {
            echo 0;
        }

    }


?>