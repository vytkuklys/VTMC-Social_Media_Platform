<?php
    session_start();
    require_once './auto-loader.inc.php';
    
    if(isset($_POST['submit'])){
        $id = $_POST['submit'];
        $deletePost = new Post();
        $deletePost->deletePost($id);
        echo 'post';
    }
    echo 'post';