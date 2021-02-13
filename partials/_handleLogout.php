<?php
    session_start();

    echo "please wait till logout is successfull";

    session_destroy();
    
    header("location: /project-3/index.php")
?>