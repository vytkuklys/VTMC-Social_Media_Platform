<?php
    session_start();
    require_once './auto-loader.inc.php';
    if(isset($_POST['commentId'])){
        $userId = $_SESSION["userId"];
        $id = $_POST['commentId'];
        $create = new Comment();
        $create->unlikeComment($id, $userId);
    }