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
    <meta name="description"
        content="Check out this faceboek site where you can post messages, as well as, like and comment.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/85a9462cb0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css?rel=133">
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
                <div class="c-hero__cover-popup h-hide">
                    <button class="js-popup-open-btn"><i class="far fa-images"></i>Pasirinkti nuotrauką</button>
                    <button><i class="fas fa-upload"></i>Įkelti nuotrauką</button>
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
                                <button class="c-hero__bio-hide c-hero__bio-btn js-bio-hide"
                                    aria-label="Exit Form">Atšaukti</button>
                                <button value="Išsaugoti" class="c-hero__bio-submit c-hero__bio-btn js-bio-submit"
                                    aria-label="Submit Form">Išsaugoti</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <nav class="c-nav">
            <div class="c-nav__links">
                <a href="#" class="c-nav__link h-selected js-nav-btn" id="posts-link">Įrašai</a>
                <a href="#" class="c-nav__link js-nav-btn" id="about-link">Apie</a>
                <a href="#" class="c-nav__link js-nav-btn" id="friends-link">Draugai</a>
                <a href="#" class="c-nav__link js-nav-btn" id="photo-link">Nuotraukos</a>
                <div class="c-nav__drop-menu">
                    <button class="c-nav__link c-nav__drop-btn js-drop-menu">Daugiau<i class="fa fa-caret-down"></i></button>
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
                <button class="c-nav__control"><i class="fas fa-pen"></i> Redaguoti profilį</button>
                <button class="c-nav__control"><i class="fas fa-eye"></i></button>
                <button class="c-nav__control"><i class="fas fa-search"></i></button>
                <button class="c-nav__control"><i class="fas fa-ellipsis-h"></i></button>
            </div>
        </nav>
        <div class="h-separator--shadow"></div>
        <div class="container">
            <div class="c-create-post">
                <div class="c-create-post__wrapper">
                    <img class="c-create-post__profile-img" src="./images/male.jpg" alt="User Profile Image">
                    <button class="c-create-post__open-btn">Ką galvojate?</button>
                </div>
                <div class="c-create-post__btns">
                    <button class="c-create-post__btn"><i class="fas fa-video"></i> Tiesioginė vaizdo transliacija</button>
                    <button class="c-create-post__btn"><i class="far fa-images"></i> Photo/Video</button>
                </div>
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
    </main>
    <script src="./js/main.js?rel=556" async defer></script>
</body>

</html>