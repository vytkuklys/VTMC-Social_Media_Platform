<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $user = $_SESSION['userId'];
        $deletePost = new Post();
        $success = $deletePost->deletePost($id, $user);
        if($success === true && $_POST['previousPhoto'] !== 0 && file_exists($_POST['previousPhoto'])){
            unlink($_POST['previousPhoto']);
        }
    }