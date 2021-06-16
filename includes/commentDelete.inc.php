<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $user = $_SESSION['userId'];
        $comment = new Comment();
        $comment->deleteComment($id, $user);
    }
