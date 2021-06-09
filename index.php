<?php
session_start();
include_once('./includes/dbh.inc.php');

try {
     $connect = new PDO("mysql:host=$host; dbname=$dbName", $user, $pass);
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     if (isset($_POST["login"])) {
           if(empty($_POST["username"]) || empty($_POST["password"]))
           {
                $message = '<span>All fields are required</span>';
           }
           else
           {
                $query = "SELECT * FROM vartotojai WHERE Slaptazodis = ? AND (Email = ? OR Telefono_nr = ?)";
                $statement = $connect->prepare($query);
                $statement->execute([$_POST["password"], $_POST["username"], $_POST["username"]]);
                $count = $statement->rowCount();
                if ($count > 0) {
                    $statement->setFetchMode(2);
                    $result = $statement->fetchAll();
                    $_SESSION["firstname"] = $result[0]['Vardas'];
                    $_SESSION["lastname"] = $result[0]['Pavarde'];
                    $_SESSION["userId"] = $result[0]['Vartotojo_id'];
                    header("location:main.php");
                } else {
                    $message = 'Invalid email or password';
                }
            }
     }
} catch (PDOException $error) {
     $message = 'Something went wrong';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Faceboek Login</title>
        <meta name="description" content="Log in to this faceboek site where you can post messages, as well as, comment and like.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css?rel=762">
        <style>
            body{
                background-color: #f0f2f5;
            }
            main{
                margin: 7rem auto 0;
                padding: 20px 4px 20px 0;
                display: flex;
                justify-content: space-between;
                /* align-items: center; */
                width: 980px;
                font-family: Helvetica, sans-serif;
            }
            /* media only screen and (max-width: 1075px)
._8esk {
    height: 496px;
    margin: 0 40px;
    width: auto;
} */
        </style>
    </head>
    <body>
        <main class="login-main">
            <div class="c-banner">
                <h1 class="c-banner__title">faceboek</h1>
                <p class="c-banner__info">Faceboek padeda jums susisiekti su draugais ir dalintis savo gyvenimu.</p>
            </div>
            <div class="c-login">
                <form method="POST" class="c-login-form">
                    <input class="c-login-form__input" type="text" name="username" placeholder="El. pašto adresas arba telefono numeris" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" title="Enter a valid email address" required><br>
                    <input class="c-login-form__input" type="password" name="password" placeholder="Slaptažodis" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
                    <input type="submit" name="login" value="Prisijungti" class="c-login-form__input c-login-form__submit"><br>
                </form>
                <a href="" class="c-login__link c-login__password-reset">Pamiršote slaptažodį?</a>
                <div class="c-login__separator"></div>
                <a href="" class="c-login__link c-login__register">Kurti naują paskyrą</a>
            </div>
        </main>
        <script src="" async defer></script>
    </body>
</html>