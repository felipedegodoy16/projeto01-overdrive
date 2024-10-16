<?php 

    if(isset($_GET['logout']) && $_GET['logout'] == 1){
        $_SESSION = array();
        session_destroy();
        header('Location: login.php');
    }