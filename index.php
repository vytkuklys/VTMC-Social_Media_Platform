<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Faceboek Login</title>
        <meta name="description" content="Log in to this faceboek site where you can post messages, as well as, comment and like.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css?rel=122">
        <style>
            body{
                background-color: #f0f2f5;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="banner">
                <h1 class="banner__title">faceboek</h1>
                <p class="banner__info">Faceboek padeda jums susisiekti su draugais ir dalintis savo gyvenimu.</p>
            </div>
            <div class="login">
                <form method="POST" class="login-form">
                    <input class="login-form__input" type="text" name="username" placeholder="El. pašto adresas arba telefono numeris" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" title="Enter a valid email address" required><br>
                    <input class="login-form__input" type="password" name="password" placeholder="Slaptažodis" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
                    <input type="submit" name="login" value="Prisijungti" class="login-form__input login-form__submit"><br>
                </form>
                <a href="" class="login__link">Pamiršote slaptažodį?</a>
                <hr>
                <a href="" class="login__link login__register">Kurti naują paskyrą</a>
            </div>
        </main>
        <script src="" async defer></script>
    </body>
</html>