<?php
    
    session_start();
    if(session_status() != PHP_SESSION_DISABLED)
    {
        session_destroy();
        header('Location: ../index.php');
    }else
    {
        header('Location: ../index.php');
    }

?>