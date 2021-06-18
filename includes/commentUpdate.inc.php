<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['id']) && isset($_POST['msg'])){
        $datetime = date("Y-m-d H:i:s");
        $msg = $_POST['msg'];
        $id = $_POST['id'];
        $comment = new Comment();
        $comment->updateComment($msg, $datetime, $id);
    }