<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['submit']) && (isset($_POST['postMsg']) || isset($_POST['file']))){
        $datetime = date("Y-m-d H:i:s");
        $photo = 0;
        $userId = $_SESSION["userId"];
        $msg = $_POST['postMsg'];
        print_r($_FILES);
        if(!empty($_FILES['file']['name'])){
            $newImg = new Image();
            $photo = $newImg->uploadImg($_FILES);
        }
        $create = new Post();
        $create->createPost($msg, $datetime, $userId, $photo);
    }