<?php
    session_start();
    include_once('./includes/dbh.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
    <script>
        $(document).ready(function(){
            var commentCount = 2;
            $("button").click(function(event){
                console.log(event.target.parentElement.children[1].id);
                commentCount +=1;
                $(`#${event.target.getAttribute("data-id")}`).load("testas.php",{
                    commentCount: commentCount
                });
            });
        })
    </script>
<!-- 
    SELECT komentarai.Sukurimo_data, komentarai.Tekstas, komentarai.Komentaro_id, vartotojai.Vardas, vartotojai.Nuotrauka, vartotojai.Vartotojo_id, vartotojai.Pavarde FROM `komentarai` LEFT JOIN vartotojai ON vartotojai.Vartotojo_id = komentarai.Autorius WHERE komentarai.Pranesimas = 3 -->

</head>
<body>
<div id="comments">
    <?php
        try {
            $connectM = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
            $connectM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `komentarai` LIMIT 1";
            $result = $connectM->prepare($sql);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<p>".$row['Tekstas']."</p>";
            }
        }catch (PDOException $error) { 
            echo $error->getMessage();
        }
    ?>
</div>
<ul id="1234"></ul>
<button data-id="123"">Show more comments</button>
</body>
</html>