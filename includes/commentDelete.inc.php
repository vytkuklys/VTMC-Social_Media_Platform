<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['submit'])){
        $id = $_POST['submit'];
        $comment = new Comment();
        $comment->deleteComment($id);
    }
