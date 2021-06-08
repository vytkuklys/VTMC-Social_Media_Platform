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
    print_r($_SESSION);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gezichtboek</title>
    <meta name="description"
        content="Check out this faceboek site where you can post messages, as well as, like and comment.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/85a9462cb0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css?rel=212">
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
                <!-- <img src="" alt="Profile photo"> -->
                <p><?php echo $_SESSION['firstname'];?></p>
            </div>
            <button class="c-controls__settings l-controls--margin">
                <i class="fas fa-sort-down"></i>
            </button>
        </div>
    </header>
    <main>
        <div class="c-hero">
            <div class="c-hero__cover-img js-cover-btn">
                <div class="c-hero__profile-img">
                    <button class="c-hero__profile-btn"><i class="fas fa-camera"></i></button>
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

        <div class="container l-grid">
            <div class="c-posts">
            <?php
                try {
                    $connectM = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
                    $connectM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "
                    SELECT pranesimai.*, vartotojai.Vardas, vartotojai.Pavarde 
                    FROM `pranesimai` LEFT JOIN vartotojai 
                    ON vartotojai.Vartotojo_id = pranesimai.Autorius
                    ORDER BY pranesimai.Redagavimo_data DESC";
                    $result = $connectM->prepare($sql);
                    $result->execute();
                    $number = $result->rowCount();
                    $i = 1;                                   
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $datetime = explode(' ', $row['Sukurimo_data']);
                        $date = $datetime[0];
                        $time = end($datetime);
                        echo 
                        "
                        <div class=\"c-post\">
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
                                <button><i class=\"fas fa-pen\"></i>Redaguoti įrašą</button>
                                <button><i class=\"far fa-calendar-alt\"></i> Edit date</button>
                                <hr>
                                <button><i class=\"far fa-trash-alt\"></i> Move to trash</button>
                            </div>
                            <p class=\"c-post__text\">".$row['Tekstas']."</p>";
                        
                        echo 
                            empty($row['Nuotrauka']) ? "" :
                            "<img src=\"./uploads/".$row['Nuotrauka']."\" class=\"c-post__img\" alt=\"\">";
                        
                        echo "
                            <div class=\"l--flex h--border-top\">
                                <button class=\"c-btn c-post__option\"><i class=\"far fa-thumbs-up\"></i>Patinka</button>
                                <button class=\"c-btn c-post__option\"><i class=\"far fa-comment-alt\"></i>Komentuoti</button>
                                <button class=\"c-btn c-post__option\"><i class=\"fas fa-share\"></i>Bendrinti</button>
                            </div>
                            <div class=\"h--border-top l--flex l--padding-top\">
                                <img class=\"c-post__comment-img\" src=\"./images/male.jpg\" alt=\"User Profile Image\">
                                <input type=\"text\" name=\"comment\" class=\"c-post__comment-btn\"
                                    placeholder=\"Parašykite komentarą...\">
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
                <h2 class="c-pop-up__title">Sukurti įrašą</h2>
                <button class="c-pop-up__exit-btn js-popup-exit-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="l--flex l--margin">
                <img class="c-profile-img" src="./images/male.jpg" alt="User Profile Image">
                <p class="c-pop-up__fullname">Simonas Donskovas</p>
            </div>
            <form method="POST" action="./includes/postCreate.inc.php" enctype="multipart/form-data">
                <textarea name="postMsg" rows="4" placeholder="Ką galvojate?" class="c-pop-up__input-msg js-post-create-input"></textarea>
                <div class="c-pop-up__file-info js-file-info h-hide">
                    <p class="c-pop-up__filename">filename.jpg</p>
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
    </main>
    <script src="./js/main.js?rel=141" async defer></script>
</body>

</html>