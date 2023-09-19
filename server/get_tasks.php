<?php 

    session_start();
    if (isset($_SESSION['login'])) {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=superreminder;charset=utf8', 'root', 'root');

            $requeteUser = $bdd->prepare("SELECT id FROM users WHERE login = :login");
            $requeteUser->bindParam(':login', $_SESSION['login']);
            $requeteUser->execute();
            
            $user = $requeteUser->fetch(PDO::FETCH_ASSOC);
            $id = $user['id'];


            $requete = $bdd->prepare("SELECT * FROM tasks where id_user = :id");
            $requete->bindParam(':id', $id);
            $requete->execute();
            $tasks = $requete->fetchAll(PDO::FETCH_ASSOC);
        
            echo json_encode($tasks);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>