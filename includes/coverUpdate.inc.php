<?php
    session_start();
    require_once './auto-loader.inc.php';

    if (isset($_POST['submit']) && isset($_SESSION['userId'])) {
        $newImg = new Image();
        $photo = $newImg->uploadImg($_FILES);
        $userId = $_SESSION['userId'];
        
        $user = new User();
        $success = $user->updateCoverImg($photo, $userId);
        if($success === true && $_POST['previousPhoto'] !== 0 && file_exists($_POST['previousPhoto'])){
            unlink($_POST['previousPhoto']);
        }
    }
