<?php 
    class User {
        private string $login;
        private string $password;


        function __construct(string $login, string $password) {
            $this->login = $login;
            $this->password = $password;
        }

        function getLogin() {
            return $this->login;
        }
        function getPassword() {
            return $this->password;
        }

        function setLogin($login){
            $this->login = $login;
        }

        function setPassword($password){
            $this->password = $password;
        }


        function addToBdd ($login, $password){
            $login = htmlspecialchars($login, ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
            $bdd = new PDO('mysql:host=localhost;dbname=superreminder;charset=utf8', 'root', 'root');
            $requete = $bdd->prepare("INSERT INTO users (login, password) VALUES (:login, :password)");
            $requete->bindParam(':login', $login);
            $requete->bindParam(':password', $password);
            $requete->execute();
        }
    }

?>