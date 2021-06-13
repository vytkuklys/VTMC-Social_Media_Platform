<?php
    session_start();
    include_once('./includes/dbh.inc.php');

    if (isset($_SESSION["firstname"]) && isset($_SESSION["lastname"]) && isset($_SESSION["userId"])) {
        if (isset($_POST['logout'])) {
            session_destroy();
            header("location:index.php");
        }
    } else {
        header("location:index.php");
    }
    try {
        $connect = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM vartotojai WHERE Vartotojo_id = ".$_SESSION['userId'].";";
        $statement = $connect->prepare($query);
        $statement->execute();
        $statement->setFetchMode(2);
        $result = $statement->fetchAll();
        // if(isset($result[0]['Nuotrauka'])){
        //     $_SESSION["profilePhoto"] = $result[0]['Nuotrauka'];
        // }
        // if(isset($result[0]['Bio'])){
        //     $_SESSION["Bio"] = $result[0]['bio'];
        // }
    } catch (PDOException $error) {
        $message = 'Something went wrong';
   }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Faceboek</title>
    <meta name="description"
        content="Check out this faceboek site where you can post messages, as well as, like and comment.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/85a9462cb0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/style.css?rel=124">
</head>

<body>
    <header>
        <div>
            <div class="c-search">
                <div class="c-search__logo">
                    <i class="fab fa-facebook"></i>
                </div>
                <label for="searchPosts" class="c-search__input">
                    <div class="c-search__input-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" aria-label="Post Search" placeholder="Search Faceboek" aria-hidden="false"
                        name="search" id="searchPosts" class="c-search__input-field">
                </label>
            </div>
        </div>
        <div class="c-controls l-controls--flex" aria-label="Account Controls and Settings">
            <div class="c-controls__account l-controls--margin">
                <img src="./images/male.jpg" alt="Profile photo" class="c-controls__img">
                <p><?php echo $_SESSION['firstname'];?></p>
            </div>
            <button class="c-controls__settings l-controls--margin">
                <i class="fas fa-sort-down"></i>
            </button>
        </div>
    </header>
    <ul id="1234"></ul>

    <main>
        <div class="c-hero">
            <div class="c-hero__cover-img js-cover-btn" style="<?php echo isset($result[0]['Virselio_nuotrauka']) ? "background-image: url('./uploads/".$result[0]['Virselio_nuotrauka']."');" : "";?>" data-bg="<?php echo isset($result[0]['Virselio_nuotrauka']) ? "".$result[0]['Virselio_nuotrauka']."" : "0";?>">
                <div class="c-hero__profile-img js-profle-img" style="<?php echo empty($result[0]['Nuotrauka']) ? "background-image: url('./images/male.jpg');" : "background-image: url('./uploads/".$result[0]['Nuotrauka']."');";?>">
                    <label class="c-hero__profile-btn" for="profileImg">
                        <i class="fas fa-camera"></i>
                        <input type="file" id="profileImg" name="file" accept=".jpg, .jpeg, .png">
                    </label>
                </div>
                <button class="c-hero__cover-btn"><i class="fas fa-camera"></i>Pridėti viršelio nuotrauką</button>
                <div class="c-hero__cover-popup c-popup h-hide">
                    <button class="js-popup-open-btn"><i class="far fa-images"></i>Pasirinkti nuotrauką</button>
                    <label for="uploadCover">
                        <i class="fas fa-upload"></i>Įkelti nuotrauką
                        <input type="file" class="js-cover-upload-btn" name="file" id="uploadCover" accept=".jpg, .jpeg, .png">
                    </label>
                </div>
            </div>
            <div aria-label="User Bio" class="c-hero__bio">
                <h1 class="c-hero__fullname"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h1>
                <div class="c-hero__bio-controls">
                    <button aria-hidden="false" class="c-hero__bio-show h-show js-bio-show">Pridėti biografiją</button>
                    <form aria-hidden="true" class="c-hero__bio-form h-hide js-bio-form" method="POST">
                        <textarea class="c-hero__bio-input js-bio-input" maxlength="101" name="bio"
                            aria-label="Enter Bio Text" cols="32" rows="3" placeholder="Apibūdinkite save"></textarea>
                        <p class="c-hero__bio-info"><span class="c-hero__bio-digit js-digits-quota">101</span>
                            characters remaining</p>
                        <div class="c-hero__bio-btns">
                            <p class="c-hero__bio-status"><i class="fas fa-globe-europe"></i>Viešas</p>
                            <div>
                                <button class="c-hero__bio-hide c-btn js-bio-hide"
                                    aria-label="Exit Form">Atšaukti</button>
                                <button value="Išsaugoti" class="c-submit-btn c-btn js-bio-submit"
                                    aria-label="Submit Form">Išsaugoti</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <nav class="c-nav">
            <div class="c-nav__links">
                <a href="#" class="c-nav__link c-underlined-btn h-selected js-nav-btn" id="posts-link">Įrašai</a>
                <a href="#" class="c-nav__link c-underlined-btn js-nav-btn" id="about-link">Apie</a>
                <a href="#" class="c-nav__link c-underlined-btn js-nav-btn" id="friends-link">Draugai</a>
                <a href="#" class="c-nav__link c-underlined-btn js-nav-btn" id="photo-link">Nuotraukos</a>
                <div class="c-nav__drop-menu">
                    <button class="c-nav__link c-underlined-btn c-nav__drop-btn js-drop-menu">Daugiau<i
                            class="fa fa-caret-down"></i></button>
                    <div class="c-nav__drop-items h-hide">
                        <a class="c-nav__drop-item" href="#">Story Archive</a>
                        <a class="c-nav__drop-item" href="#">Vaizdo įrašai</a>
                        <a class="c-nav__drop-item" href="#">Aplankytos vietos</a>
                        <a class="c-nav__drop-item" href="#">Sportas</a>
                        <a class="c-nav__drop-item" href="#">Muzika</a>
                    </div>
                </div>
            </div>
            <div class="c-nav__controls">
                <button class="c-btn"><i class="fas fa-pen"></i> Redaguoti profilį</button>
                <button class="c-btn"><i class="fas fa-eye"></i></button>
                <button class="c-btn"><i class="fas fa-search"></i></button>
                <button class="c-btn"><i class="fas fa-ellipsis-h"></i></button>
            </div>
        </nav>
        <div class="h-separator--shadow"></div>
        <div class="container">
            <div class="c-create-post">
                <div class="l--flex">
                    <img class="c-profile-img" src="./images/male.jpg" alt="User Profile Image">
                    <button class="c-create-post__open-btn js-open-create-post-btn">Ką galvojate?</button>
                </div>
                <div class="c-create-post__btns">
                    <button class="c-create-post__btn js-open-create-post-btn"><i class="fas fa-video"></i> Tiesioginė vaizdo
                        transliacija</button>
                    <button class="c-create-post__btn js-open-create-post-btn"><i class="far fa-images"></i> Photo/Video</button>
                </div>
            </div>
            <div class="c-filter-post">
                <div class="l--flex l--center-justify l--padding-bottom l--padding">
                    <h3 class="c-filter-post__title">Įrašai</h3>
                    <div class="c-nav__controls">
                        <button class="c-btn"><i class="fas fa-sliders-h"></i>Filtrai</button>
                        <button class="c-btn"><i class="fas fa-cog"></i>Tvarkyti įrašus</button>
                    </div>
                </div>
                <div class="l--flex l--center-justify h--border-top l--padding">
                    <button href="#" class="c-filter-post__layout-btn c-underlined-btn h-selected js-nav-btn"
                        id="posts-link"><i class="fas fa-bars"></i>Sąrašo rodinys</button>
                    <button href="#" class="c-filter-post__layout-btn c-underlined-btn js-nav-btn" id="about-link"><i
                            class="fas fa-th-large"></i>Grid View</button>
                </div>
            </div>
        </div>
        <!-- SELECT pranesimai.*, 
                    vartotojai.Vardas, vartotojai.Pavarde, 
                    COUNT(komentarai.Pranesimas) as Total_comments
                        FROM `pranesimai` 
                        LEFT JOIN komentarai 
                        ON komentarai.Pranesimas = pranesimai.Pranesimo_id
                        RIGHT JOIN vartotojai
                        ON vartotojai.Vartotojo_id = pranesimai.Autorius
                        GROUP BY pranesimai.Pranesimo_id
                        ORDER BY pranesimai.Redagavimo_data DESC -->
        <div class="container l-grid">
            <div class="c-posts">
            <?php
                try {
                    $connectM = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
                    $connectM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "
                        SELECT p.*,
                                (SELECT COUNT(*) FROM komentarai k WHERE k.Pranesimas = p.Pranesimo_id) as Total_comments, 
                                (SELECT COUNT(*) FROM pranesimu_reakcijos p_r WHERE p_r.Pranesimo_id = p.Pranesimo_id) as Total_likes,
                                v.Vardas,
                                v.Pavarde
                                FROM pranesimai p INNER JOIN
                                vartotojai v
                                ON v.Vartotojo_id = p.Autorius
                                ORDER BY p.Redagavimo_data DESC";
                    $result = $connectM->prepare($sql);
                    $result->execute();
                    $hideComments = "h-hide";
                    $showComments = "";
                    $hideLikes = "h-hide";  
                    $colorLikes = "h-color";                   
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $datetime = explode(' ', $row['Redagavimo_data']);
                        if($row['Total_comments'] > 0){
                            $hideComments = "";
                            $showComments = "h-hide";
                        }else{
                            $hideComments = "h-hide";
                            $showComments = "";
                        }
                        if($row['Total_likes'] > 0){
                            $hideLikes = "";
                        }else{
                            $hideLikes = "h-hide";
                        }
                        $date = $datetime[0];
                        $time = end($datetime);
                        echo 
                        "<div class=\"c-post\">
                            <div class=\"l--flex l--center-justify\">
                                <img class=\"c-profile-img\" src=\"./images/male.jpg\" alt=\"User Profile Image\">
                                <div class=\"c-post__details\">
                                    <p class=\"c-post__author\">".$row['Vardas']." ".$row['Pavarde']."</p>
                                    <p class=\"c-post__datetime\">".$date.", ".$time."</p>
                                </div>
                                <button class=\"c-btn c-post__more-btn js-post-manage-btn\"><i
                                        class=\"fas fa-ellipsis-h\"></i></button>
                            </div>
                            <div class=\"c-post__popup c-popup h-hide\" id=\"".$row['Pranesimo_id']."\">
                                <button><i class=\"far fa-bookmark\"></i> Išsaugoti įrašą</button>
                                <hr>
                                <button class=\"js-post-update-btn\"><i class=\"fas fa-pen\"></i>Redaguoti įrašą</button>
                                <button><i class=\"far fa-calendar-alt\"></i> Edit date</button>
                                <hr>
                                <button class=\"js-post-delete-btn\"><i class=\"far fa-trash-alt\"></i> Move to trash</button>
                            </div>
                            <p class=\"c-post__text\">".$row['Tekstas']."</p>";
                        
                        echo 
                            empty($row['Nuotrauka']) ? "" :
                            "<img src=\"./uploads/".$row['Nuotrauka']."\" class=\"c-post__img\" alt=\"\">";
                        echo
                            "<div class=\"c-reactions__wrapper\" data-reaction=\"".$row['Pranesimo_id']."\">
                                <p class=\"c-likes ".$hideLikes."\"><span class=\"c-likes__icon\"><i class=\"fas fa-thumbs-up\"></i></span><span class=\"c-likes__counter\">".$row['Total_likes']."</span></p>
                                <button class=\"c-comment__toggler js-comment-toggler ".$hideComments."\">".$row['Total_comments']." komentarai</button>
                            </div>
                            <div class=\"l--flex h--border-top h--border-bottom\">
                                <button class=\"c-btn c-post__option js-post-like-btn\" data-likes=".$row['Pranesimo_id']."><i class=\"far fa-thumbs-up\"></i>Patinka</button>
                                <button class=\"c-btn c-post__option\"><i class=\"far fa-comment-alt\"></i>Komentuoti</button>
                                <button class=\"c-btn c-post__option\"><i class=\"fas fa-share\"></i>Bendrinti</button>
                            </div>
                            <div class=\"c-comment l--padding-top ".$showComments."\">
                                <ul class=\"c-comment__items\" data-id=\"".$row['Pranesimo_id']."\"></ul>
                                <div class=\" l--flex l--padding-bottom\">
                                    <img class=\"c-post__comment-img\" src=\"./images/male.jpg\" alt=\"User Profile Image\">
                                    <form class=\"c-comment__form\" method=\"POST\" action=\"./includes/commentCreate.inc.php\">
                                        <input type=\"text\" name=\"comment\" class=\"c-post__comment-btn js-comment-input\"
                                        placeholder=\"Parašykite komentarą...\">
                                        <button class=\"c-comment__submit-btn\" name=\"submit\" value=\"".$row['Pranesimo_id']."\"><i class=\"fas fa-plus-circle\"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ";    
                    }
                    
                } catch (PDOException $error) { 
                        echo $error->getMessage();
                }
            ?>
            </div>
        </div>
        <div class="c-pop-up__cover-img c-pop-up__form h-hide">
            <div class="c-pop-up__header">
                <h2 class="c-pop-up__title">Pasirinkti nuotrauką</h2>
                <button class="c-pop-up__exit-btn js-popup-exit-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="c-pop-up__nav">
                <button class="c-pop-up__nav-btn h-selected js-popup-nav-btn" id="left-nav-btn"><span
                        style="font-weight: 700;">Naujausios nuotraukos</span></button>
                <button class="c-pop-up__nav-btn js-popup-nav-btn" id="right-nav-btn">Nuotraukų albumai</button>
            </div>
            <div class="c-pop-up__flex">
                <div class="c-pop-up__img" aria-label="user image">
                </div>
                <div class="c-pop-up__img" aria-label="user image">
                </div>
                <div class="c-pop-up__img" aria-label="user image">
                </div>
                <div class="c-pop-up__img" aria-label="user image">
                </div>
                <div class="c-pop-up__img" aria-label="user image">
                </div>
                <div class="c-pop-up__img" aria-label="user image">
                </div>
            </div>
        </div>
        <div class="c-pop-up__form c-pop-up__create-post h-hide">
            <div class="c-pop-up__header">
                <h2 class="c-pop-up__title js-post-title">Sukurti įrašą</h2>
                <button class="c-pop-up__exit-btn js-popup-exit-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="l--flex l--margin">
                <img class="c-profile-img" src="./images/male.jpg" alt="User Profile Image">
                <p class="c-pop-up__fullname">Simonas Donskovas</p>
            </div>
            <form method="POST" action="./includes/postCreate.inc.php" enctype="multipart/form-data" class="js-popup-form">
                <textarea name="postMsg" rows="4" placeholder="Ką galvojate?" class="c-pop-up__input-msg js-post-input"></textarea>
                <div class="c-pop-up__file-info js-file-info h-hide">
                    <!-- <p class="c-pop-up__filename">filename.jpg</p> -->
                    <img src="" alt="Uploaded Image Preview" class="js-popup-img h--border-radius" width="100%"> 
                    <button class="c-pop-up__exit-btn c-pop-up__cancel-btn js-post-cancel-img-btn"><i class="fas fa-times"></i></button>
                </div>
                <div class="c-pop-up__extras">
                    <p class="c-pop-up__subtitle">Pridėkite prie savo įrašo</p>
                    <!-- <button class="c-pop-up__img-btn"><i class="far fa-images"></i></button> -->
                    <label for="postImg" class="c-pop-up__img-btn">
                        <input type="file" id="postImg" class="js-post-img-btn" name="file" accept=".jpg, .jpeg, .png">
                        <i class="far fa-images"></i>
                    </label>
                </div>
                <button name="submit" value="submit" class="c-submit-btn c-btn c-pop-up__submit-btn js-post-submit"
                                    aria-label="Submit Form">Sukurti įrašą</button>
            </form>
        </div>
        <div class="c-pop-up__form js-delete-popup h-hide">
            <div class="c-pop-up__header c-pop-up__delete-header">
                <h2 class="c-pop-up__title js-delete-title">Ištrinti pranešimą</h2>
                <button class="c-pop-up__exit-btn js-popup-exit-btn"><i class="fas fa-times"></i></button>
            </div>
            <p class="c-pop-up__delete-info js-delete-info">Ar tikrai norite ištrinti šį pranešimą?</p>
            <form method="POST" action="./includes/postDelete.inc.php" class="c-pop-up__delete-form js-delete-form">
                <button class="c-btn c-pop-up__delete-cancel-btn js-popup-exit-btn">Atšaukti</button>
                <button name="submit" class="c-btn c-pop-up__delete-btn js-delete-submit-btn">Ištrinti</button>
            </form>
        </div>
        <div class="c-pop-up__form js-comment-update-popup h-hide">
            <div class="c-pop-up__header c-pop-up__delete-header">
                <h2 class="c-pop-up__title js-delete-title">Redaguoti komentarą</h2>
                <button class="c-pop-up__exit-btn js-popup-exit-btn"><i class="fas fa-times"></i></button>
            </div>
            <form class="c-comment__form c-comment__update" method="POST" action="./includes/commentUpdate.inc.php">
                    <textarea type="text" name="comment" rows="3" class="c-post__comment-btn c-comment__update-field js-comment-update-field"/></textarea>
                    <button class="c-btn c-pop-up__delete-cancel-btn js-popup-exit-btn">Atšaukti</button>
                    <button name="submit" class="c-btn c-pop-up__delete-btn js-update-submit-btn">Redaguoti</button>
            </form>
        </div>
        <button type="button" name="search" id="search" class="btn btn-info">Search</button>

    </main>
    <!-- <script>
    $(document).ready(function(){
    $(function(){
    const id = 123;
    $.ajax({
    url:"./includes/postReaction.inc.php",
    method:"POST",
    data:{id:id},
    dataType:"text",
    success:function(data)
    {
        console.log(JSON.parse(data));
        let tmp = JSON.parse(data);
        var result = Object.keys(tmp).map((key) => tmp[key] == "Comments" ? key : "").filter(key => key);
        console.log(result)
    },error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    } 
   })
 });
});
</script> -->
    <script src="./js/main.js?rel=135" async defer></script>
</body>

</html>