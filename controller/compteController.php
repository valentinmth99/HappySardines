<?php

// FUNCTION CONNECT CONTROLLER

if (!empty($_POST)){
    extract($_POST);
    
    if (isset($_POST['connexion'])) {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $valid = (boolean) true;

        if (empty($login)) {
            $valid = false;
            $err_login = "Veuillez renseigner votre login.";
            echo "Veuillez renseigner votre login.";
        }

        if (empty($password)) {
            $valid = false;
            $err_login = "Veuillez renseigner votre mot de passe.";
            echo "Veuillez renseigner votre mot de passe.";
        }

        if($valid == true) {
            require('class_user.php');

            $connect_user = new User ;
            $connect_user->connect("$login", "$password");
        }

    }
}

// FUNCTION GETINFOS CONTROLLER

if (isset($_SESSION['login'])) {
    $getinfos_user = new User;
    $getinfos_user->Getinfos();
}

// REDIRECTION PAGE INSCRIPTION

if (isset($_POST['suscribe'])) {
    header ('Location: inscription.php');
}



?>


