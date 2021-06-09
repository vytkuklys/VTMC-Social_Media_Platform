<?php
    session_start();
    require_once './auto-loader.inc.php';

    if (isset($_POST['submit']) && isset($_SESSION['userId'])) {
        $newImg = new Image();
        $photo = $newImg->uploadImg($_FILES);
        $userId = $_SESSION['userId'];
        
        $user = new User();
        $user->updateProfileImg($photo, $userId);
    }