<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['submit']) && isset($_POST['comment'])){
        $datetime = date("Y-m-d H:i:s");
        $userId = $_SESSION["userId"];
        $postId = $_POST['submit'];
        $comment = $_POST['comment'];
        $commentNew = new Comment();
        $commentNew->createComment($comment, $datetime, $userId, $postId);
    }