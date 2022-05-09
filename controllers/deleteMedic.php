<?php
    include("../config.php");

    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $query = $db->prepare("call sp_deleteMedico(:id)");
        $query->bindParam(':id',$id );
        $query->execute();


        if($query->rowCount() > 0)
        {
            echo 1;
        }else
        {
            echo 2;
        }
    }

?>