<?php 
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=superreminder;charset=utf8', 'root', 'root');
        $requete = $bdd->prepare("SELECT * FROM tasks");
        $requete->execute();
    
        $tasks = $requete->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($tasks);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>