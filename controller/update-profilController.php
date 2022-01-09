<?php

require('../model/bdd.php');

// CONTROLLER FUNCTION UPDATEINFOS

if (!empty($_POST)){
    extract($_POST);

    if (isset($_POST['updateinfos'])) {

        $newlogin = trim($_POST['newlogin']);
        $newemail = trim($_POST['newemail']);
        $newfirstname = trim(ucwords(strtolower($_POST['newfirstname'])));
        $newlastname = trim(ucwords(strtolower($_POST['newlastname'])));
        $checkemail = trim($_POST['checkemail']);
        $password = trim($_POST['password']);

        $data = [
            'login'=>$newlogin,
            'email'=>$newemail,
            'lastname'=>$newlastname,
            'firstname'=>$newfirstname,
        ];

        $valid = (boolean) true;


        // check LOGIN -------------

        $reqlog = $bdd->prepare("SELECT * FROM utilisateurs WHERE login ='".$newlogin."'");
        $reqlog->setFetchMode();
        $reqlog->execute();

        $resultlog = $reqlog->fetch();


        if (empty($newlogin)) {
            $valid = false;
            $err_login = "Renseignez votre login.";
            echo "Renseignez votre login.";
        }

        elseif (strlen(6>$newlogin)>20) {
            $valid = false;
            $err_login = "Le login doit contenir entre 6 et 20 caractères.";
            $login="";
            echo "Le login doit contenir entre 6 et 20 caractères.";
        }

        elseif (!preg_match("#^[a-z0-9A-Z]+$#" ,$newlogin)) {
            $valid = false;
            $err_login = "Le login doit uniquement contenir des lettres minuscules et des chiffres.";
            $login="";
            echo "Le login doit uniquement contenir des lettres minuscules et des chiffres. ";
        }

        elseif ($resultlog) {
            $valid = false;
            $err_login = "Ce login est déjà utilisé.";
            $login ="";
            echo "Ce login est déjà utilisé.";
        }

        // check EMAIL ----------

        $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE email ='".$newemail."'");
        $reqmail->setFetchMode();
        $reqmail->execute();

        $resultmail = $reqmail->fetch();

        if (empty($newemail)) {
            $valid=false;
            $err_email = "Renseignez l'email.";
            echo "Renseignez l'email.";

        }

        elseif(filter_var($newemail, FILTER_VALIDATE_EMAIL) == false) {
            $valid=false;
            $err_email = "Votre email n'est pas au bon format";
            $email="";
            echo "Votre email n'est pas au bon format";
        }
        
        elseif ($resultmail) {
            $valid = false;
            $err_email = "Cette adresse mail est déjà utilisée.";
            $email ="";
            echo "Cette adresse mail est déjà utilisée.";
        }

        elseif (empty($checkemail)) {
            $valid = false;
            $err_checkemail = "Veuillez confirmer votre email.";
            echo "Veuillez confirmer votre email.";
        }

        elseif ($checkemail !== $newemail) {
            $valid = false;
            $err_checkemail = "Les emails ne correspondent pas.";
            $checkemail = "";
            echo "Les emails ne correspondent pas.";
        }


        // check firstname/lastname ------

        if (empty($newfirstname)) {
            $valid = false;
            $err_firstname = "Renseignez votre prénom.";
            echo "Renseignez votre prénom.";
        }

        elseif (!preg_match("#^[a-zA-Z]+$#", $newfirstname)) {
            $valid = false;
            $err_firstname ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $firstname ="";
            echo "Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        if (empty($newlastname)) {
            $valid = false;
            $err_lastname = "Renseignez votre nom.";
            echo "Renseignez votre nom.";
        }

        elseif (!preg_match("#^[a-zA-Z]+$#", $newlastname)) {
            $valid = false;
            $err_lastname = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $lastname ="";
            echo "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        // check PASSWORD  ------

        $reqpassword = $bdd->prepare("SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."' && password ='".md5($password)."'");
        $reqpassword->setFetchMode();
        $reqpassword->execute();

        $resultpassword = $reqpassword->fetch();

        if($resultpassword == false ) {
            $valid = false;
            $err_password = "Le mot de passe est incorrect.";
            echo "Le mot de passe est incorrect.";
        }

        if($valid==true) {

            require('class_user.php');
            $updateinfos_user = new User();
            $updateinfos_user->Updateinfos("$newlogin", "$newfirstname", "$newemail", "$newlastname");
        }
    }
}

// CONTROLLER FUNCTION UPDATEPASSWORD

if (!empty($_POST)){
    extract($_POST);

    if (isset($_POST['updatepassword'])) {

        $password = $_POST['actualpassword'];
        $newpassword = $_POST['newpassword'];
        $checkpassword = $_POST['checkpassword'];

        $valid = (boolean) true;

        $reqpassword = $bdd->prepare("SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."' AND password ='".md5($password)."'");
        $reqpassword->setFetchMode();
        $reqpassword->execute();

        $resultpassword = $reqpassword->fetch();

        if(empty($password)) {
            $valid = false;
            $err_password = "Renseignez votre mot de passe actuel.";
            echo "Renseignez votre mot de passe actuel.";
        }

        elseif($resultpassword == false) {
            $valid = false;
            $password = '';
            $err_password = "Le mot de passe actuel est incorrect.";
            echo "Le mot de passe actuel est incorrect.";
        }

        if(empty($newpassword)) {
            $valid = false;
            $err_newpassword = "Renseignez votre nouveau mot de passe.";
            echo "Renseignez votre nouveau mot de passe.";
        }

        elseif (strlen($newpassword)<8) {
            $valid = false;
            $newpassword ='';
            $err_newpassword ="Le mot de passe doit contenir au moins 8 caractères.";
            echo "Le mot de passe doit contenir au moins 8 caractères.";
        }

        elseif(empty($checkpassword)) {
            $valid = false;
            $err_checkpassword = "Confirmez votre mot de passe.";
            echo "Confirmez votre mot de passe.";

        }

        elseif($newpassword !== $checkpassword) {
            $valid = false;
            $err_passwords = "Les mots de passe ne correspondent pas.";
            echo "Les mots de passe ne correspondent pas.";
        }

        if ($valid == true) {
            require('class_user.php');
            $updatepassword_user = new User();
            $updatepassword_user->Updatepassword("$newpassword");
        }
    }
}


    
?>