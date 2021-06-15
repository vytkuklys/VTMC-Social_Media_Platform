<?php
    session_start();
    include_once('./dbh.inc.php');
    $userId = $_SESSION['userId'];
    try {
        $connectM = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
        $connectM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT pranesimu_reakcijos.Pranesimo_id FROM `vartotojai` 
                INNER JOIN pranesimu_reakcijos 
                ON pranesimu_reakcijos.Vartotojo_id = vartotojai.Vartotojo_id 
                WHERE pranesimu_reakcijos.Vartotojo_id = ".$userId."";
        $result = $connectM->prepare($sql);
        $result->execute();
        $data = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data["".$row["Pranesimo_id"].""] = "Posts";
        }     
        $sqlComments = "SELECT komentaru_reakcijos.Komentaro_id FROM `vartotojai` 
                INNER JOIN komentaru_reakcijos 
                ON komentaru_reakcijos.Vartotojas = vartotojai.Vartotojo_id 
                WHERE komentaru_reakcijos.Vartotojas = ".$userId."";
        $result2 = $connectM->prepare($sqlComments);
        $result2->execute();

        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            $data["".$row["Komentaro_id"].""] = "Comments";
        } 
        echo json_encode($data);
    }catch (PDOException $error) { 
        echo $error->getMessage();
    }