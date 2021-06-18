<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['id']) && (isset($_POST['msg']) || isset($_POST['file']))){
        $datetime = date("Y-m-d H:i:s");
        $photo = 0;
        $msg = $_POST['msg'];
        $id = $_POST['id'];
        if(!empty($_FILES['file']['name'])){
            $newImg = new Image();
            $photo = $newImg->uploadImg($_FILES);
        }
        echo $msg;
        $updatePost = new Post();
        $success = $updatePost->updatePost($msg, $datetime, $photo, $id);
        if($success === true && $_POST['previousPhoto'] !== 0 && file_exists($_POST['previousPhoto'])){
            unlink($_POST['previousPhoto']);
        }
        header("Location: ../main.php");
    }