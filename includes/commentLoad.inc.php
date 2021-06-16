<?php
    session_start();
    include_once('./dbh.inc.php');

    $postId = $_POST['postId'];

    try {
        $connectM = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
        $connectM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
        SELECT k.Komentaro_id, k.Tekstas, k.Sukurimo_data,
                (SELECT COUNT(*) FROM komentaru_reakcijos k_r WHERE k_r.Komentaro_id = k.Komentaro_id) as Total_likes, 
                v.Vardas, v.Vartotojo_id, v.Pavarde, v.Profilio_nuotrauka
                FROM komentarai k INNER JOIN
                vartotojai v
                ON v.Vartotojo_id = k.Autorius
                WHERE k.Pranesimas = ".$postId."
                ORDER BY k.Redagavimo_data DESC";
        $result = $connectM->prepare($sql);
        $result->execute();
        $hideLikes = "h-hide";
        $photo = "./images/male.php";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($row['Total_likes'] > 0){
                $hideLikes = "";
            }else{
                $hideLikes = "h-hide";
            }
            if(!empty($row['Profilio_nuotrauka'])){
                $photo = "./uploads/".$row['Profilio_nuotrauka'];
            }else{
                $photo = "./images/male.php";
            }
            if($row['Vartotojo_id'] === $_SESSION['userId']){
                $authorised = "";
            }else{
                $authorised = "h-hide";
            }
            echo "
            <li class=\"l--flex\" data-comment-id=\"".$row['Komentaro_id']."\">
                <img class=\"c-post__comment-img c-comment__img\" src=\"".$photo."\" onerror=\"this.onerror=null; this.src='./images/male.jpg'\" alt=\"User Profile Image\">
                <div class=\"c-comment__wrapper l--flex\">
                    <div class=\"c-comment__details\">
                        <p class=\"c-comment__author\">".$row['Vardas']." ".$row['Pavarde']."</p>
                        <p class=\"c-comment__message\" data-text=\"".$row['Komentaro_id']."\">".$row['Tekstas']."</p>
                        <p class=\"c-likes c-comment__likes ".$hideLikes."\" data-comment-likes=\"".$row['Komentaro_id']."\">
                            <span class=\"c-likes__icon c-comment__likes-icon\">
                                <i class=\"fas fa-thumbs-up\"></i>
                            </span>
                            <span class=\"c-likes__counter\">".$row['Total_likes']."</span>
                        </p>
                    </div>
                    <button class=\"c-btn c-post__more-btn c-comment__more-btn ".$authorised." js-comment-menu-btn\"><i class=\"fas fa-ellipsis-h\"></i></button>
                    <div class=\"c-popup c-comment__popup h-hide\" id=\"".$row['Komentaro_id']."\">
                        <button class=\"js-comment-update-btn js-comment-update-btn\">Redaguoti...</button>
                        <button class=\"js-delete-update-btn js-comment-delete-btn\">Trinti...</button>
                    </div>
                    <button class=\"c-comment__like-btn js-comment-like\" data-likes=\"".$row['Komentaro_id']."\">Patinka</button>
                </div>
            </li>
            ";
        }
    }catch (PDOException $error) { 
        echo $error->getMessage();
    }