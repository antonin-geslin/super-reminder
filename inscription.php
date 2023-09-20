<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <header>
        <h1>To do list</h1>
        <a href="index.php"><img src="liste.png"></a>
            <?php
                if(!isset($_SESSION))
                    session_start();
                if (isset($_SESSION['login'])) {
                    $username = $_SESSION['login'];
                    echo "<div class='sign_out'><p class='login_check'>Bienvenue, " .strip_tags($username). "!</p><form method='post'><button type='submit' name='signout'>Sign Out</button></form></div>";
                    if (isset($_POST['signout'])) {
                        session_destroy();
                        header('location: index.php');
                        exit();
                    }
                } else {
                    echo "<a href='connexion.php'>connexion</a>";
                }
            ?>
    </header>
    <form class = "mainForm" method="post">
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="password2">Password</label>
            <input type="password" name="password2" id="password2">
            <p>Already registred ? Log-in <a class="link" href="connexion.php">here !</a></p>
        <button type="submit" name="submit">Inscription</button>
    </form>
</body>
</html>


<?php

require_once './user.php';
function checkForm($login, $password, $password2){
    $login = htmlspecialchars($login, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
    $password2 = htmlspecialchars($password2, ENT_QUOTES, 'UTF-8');
    $bdd = new PDO('mysql:host=localhost;dbname=superreminder;charset=utf8', 'root', 'root');
    $requete = $bdd->prepare("SELECT * FROM users WHERE login = :login");
    $requete->bindParam(':login', $login);
    $requete->execute();
    if (isset($login) && isset($password) && isset($password2)){
        if ($password == $password2){
            if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/", $password)){
                if ($requete->rowCount() === 0){
                    return true;
                }
                else {
                    return ('Login already used');
                }
            }
            else {
                return ('Password must contain at least 8 characters, 1 uppercase, 1 lowercase, 1 number and 1 special character');
            }
        } else {
            return ('Passwords do not match');
        }
    return false;
}
}

if (isset($_POST['submit'])){
    $user = new User($_POST['login'], $_POST['password']);
    $formresult = checkForm($user->getLogin(), $user->getPassword(), $_POST['password2']);
    if ($formresult === true){
        $user->addToBdd($user->getLogin(), $user->getPassword());
        header('Location: connexion.php');
    } else {
        echo "<p class = 'error_message'>".$formresult."</p>";
    }
}
?>