<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['msg'])){
        $bio = $_POST['msg'];
        $userId = $_SESSION['userId'];
        $update = new User();
        $update->updateBio($bio, $userId);
        header("Location: ../main.php");
    }