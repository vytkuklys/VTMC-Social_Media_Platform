<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['submit']) && isset($_POST['comment'])){
        $datetime = date("Y-m-d H:i:s");
        $msg = $_POST['comment'];
        $id = $_POST['submit'];
        $comment = new Comment();
        $comment->updateComment($msg, $datetime, $id);
    }