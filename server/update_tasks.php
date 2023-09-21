<?php 
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $id = $data['id'];
    $done = $data['done'];
    
   
    $bdd = new PDO('mysql:host=localhost;dbname=superreminder;charset=utf8', 'root', 'root');
    $requete = $bdd->prepare("UPDATE tasks SET done = :done WHERE id = :id");
    $requete->bindParam(':id', $id);
    $requete->bindParam(':done', $done);
    
    $requete->execute();

    $response = array('message' => 'Données mises à jour avec succès');

    echo json_encode($response);
    
?>