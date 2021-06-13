<?php
    session_start();
    require_once './auto-loader.inc.php';
    if(isset($_POST['postId'])){
        $userId = $_SESSION["userId"];
        $id = $_POST['postId'];
        $create = new Post();
        $create->unlikePost($id, $userId);
    }