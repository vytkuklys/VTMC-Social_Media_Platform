<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['id']) && isset($_POST['comment'])){
        $datetime = date("Y-m-d H:i:s");
        $userId = $_SESSION["userId"];
        $postId = $_POST['id'];
        $comment = $_POST['comment'];
        $commentNew = new Comment();
        $commentNew->createComment($comment, $datetime, $userId, $postId);
    }