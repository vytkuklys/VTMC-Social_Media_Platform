<?php
    session_start();
    if (isset($_SESSION["firstname"]) && isset($_SESSION["lastname"]) && isset($_SESSION["userId"])) {
        if (isset($_POST['logout'])) {
            session_destroy();
            header("location:index.php");
        }
    } else {
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gezichtboek</title>
        <meta name="description" content="Check out this faceboek site where you can post messages, as well as, like and comment.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/85a9462cb0.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css?rel=3123">
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
                        <input type="text" aria-label="Post Search" placeholder="Search Faceboek" aria-hidden="false" name="search" id="searchPosts" class="c-search__input-field">
                    </label>
                </div>
            </div>
            <div class="c-controls l-controls--flex" aria-label="Account Controls and Settings">
                <div class="c-controls__account l-controls--margin">
                    <!-- <img src="" alt="Profile photo"> -->
                    <p><?php echo $_SESSION['username'];?></p>
                </div>
                <button class="c-controls__settings l-controls--margin">
                    <i class="fas fa-sort-down"></i>
                </button>
            </div>
        </header>
        <main>
        <div class="c-hero">
            <div class="c-hero__img">
                <div class="c-hero__profile-img">
                    <button class="c-hero__profile-btn"><i class="fas fa-camera"></i></button>
                </div>
                <button class="c-hero__img-btn"><i class="fas fa-camera"></i>Redaguoti viršelio nuotrauką</button>
            </div>
            <div aria-label="User Bio" class="hero__bio">
                <h1 class="c-hero__fullname"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h1>
                <div class="c-hero__bio-controls">
                    <button aria-hidden="false" class="c-hero__bio-show h-bio-show js-bio-show">Pridėti biografiją</button>
                    <form aria-hidden="true" class="c-hero__bio-form h-bio-hide js-bio-form" method="POST">
                        <textarea class="c-hero__bio-input js-bio-input" maxlength="101" name="bio" aria-label="Enter Bio Text" cols="30" rows="3" placeholder="Apibūdinkite save"></textarea>
                        <p class="c-hero__bio-info"><span class="c-hero__bio-digit js-digits-quota">101</span> characters remaining</p>
                        <div>
                            <p class="c-hero__bio-status"><i class="fas fa-globe-europe"></i>Viešas</p>
                            <div>
                                <button class="c-hero__bio-hide js-bio-hide">Atšaukti</button>
                                <input type="submit" name="bioSubmit" value="Išsaugoti" class="c-hero__bio-submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </main>
        <script src="./js/main.js?rel=122" async defer></script>
    </body>
</html>