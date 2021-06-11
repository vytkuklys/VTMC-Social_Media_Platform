<?php
    include_once('./dbh.inc.php');

    $comment = $_POST['postId'];

    try {
        $connectM = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
        $connectM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT komentarai.Tekstas, komentarai.Sukurimo_data, komentarai.Komentaro_id, 
        vartotojai.Vardas, vartotojai.Pavarde, vartotojai.Nuotrauka 
                FROM komentarai LEFT JOIN vartotojai 
                ON vartotojai.Vartotojo_id = komentarai.Autorius 
                WHERE Pranesimas = ".$comment."";
        $result = $connectM->prepare($sql);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <li class=\"l--flex\">
                <img class=\"c-post__comment-img c-comment__img\" src=\"./images/male.jpg\" alt=\"User Profile Image\">
                <div class=\"c-comment__wrapper l--flex\">
                    <div class=\"c-comment__details\">
                        <p class=\"c-comment__author\">".$row['Vardas']." ".$row['Pavarde']."</p>
                        <p class=\"c-comment__message\" data-text=\"".$row['Komentaro_id']."\">".$row['Tekstas']."</p>
                    </div>
                    <button class=\"c-btn c-post__more-btn c-comment__more-btn js-comment-menu-btn\"><i class=\"fas fa-ellipsis-h\"></i></button>
                    <div class=\"c-popup c-comment__popup h-hide\" id=\"".$row['Komentaro_id']."\">
                        <button class=\"js-comment-update-btn js-comment-update-btn\">Redaguoti...</button>
                        <button class=\"js-delete-update-btn js-comment-delete-btn\">Trinti...</button>
                    </div>
                    <button class=\"c-comment__like-btn\">Patinka</button>
                </div>
            </li>
            ";
        }
    }catch (PDOException $error) { 
        echo $error->getMessage();
    }

    // <input type=\"text\" name=\"comment\" class=\"c-post__comment-btn js-comment-input\"
    // placeholder=\"Parašykite komentarą...\" value=\"".$row['Tekstas']."\">


    // <form class=\"c-comment__form h-hide\" method=\"POST\" action=\"./includes/commentCreate.inc.php\">
    //                 <input type=\"text\" autofocus=\"autofocus\" value=\"tjos\" onfocus=\"var temp_value=this.value; this.value=''; this.value=temp_value\" name=\"comment\" class=\"c-post__comment-btn js-comment-input\"/>
    //                 <button class=\"c-comment__submit-btn\" name=\"submit\" value=\"".$row['Komentaro_id']."\"><i class=\"fas fa-plus-circle\"></i></button>
    //             </form>