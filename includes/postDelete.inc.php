<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $user = $_SESSION['userId'];
        $deletePost = new Post();
        $deletePost->deletePost($id, $user);
    }