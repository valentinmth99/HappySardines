<?php


class User {

    private $id;
    public $login;
    public $email;
    public $prenom;
    public $nom;
    public $connexion;
    public $session;

    
    // DECLARATION DES METHODES 

    public function __construct() {
        require('./bdd.php');
        $this->connexion=$bdd;
    }

    // FONCTION REGISTER -----------------------------------------------------------------------------------------------

    public function register($login, $password, $email, $prenom, $nom) {

        
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $prenom = trim(ucwords(strtolower($_POST['prenom'])));
        $nom = trim(ucwords(strtolower($_POST['nom'])));
        $confemail = trim($_POST['confemail']);
        $confpassword = trim($_POST['confpassword']);
        $password = trim($_POST['password']);

        $data = [
            'login'=>$login,
            'email'=>$email,
            'prenom'=>$prenom,
            'nom'=>$nom,
            'password'=>md5($password),
        ];

        $valid = (boolean) true;


        // VERIF LOGIN -------------

        $reqlog = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login =:login");
        $reqlog->setFetchMode();
        $reqlog->execute(['login'=> $login]);

        $resultlog = $reqlog->fetch();


        if (empty($login)) {
            $valid = false;
            $err_login = "Renseignez votre login.";
            echo "Renseignez votre login.";
        }

        elseif (strlen(6>$login)>20) {
            $valid = false;
            $err_login = "Le login doit contenir entre 6 et 20 caractères.";
            $login="";
            echo "Le login doit contenir entre 6 et 20 caractères.";
        }

        elseif (!preg_match("#^[a-z0-9A-Z]+$#" ,$login)) {
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

        // VERIF EMAIL ----------

        $reqmail = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE email =:email");
        $reqmail->setFetchMode();
        $reqmail->execute(['email'=>$email]);

        $resultmail = $reqmail->fetch();

        if (empty($email)) {
            $valid=false;
            $err_email = "Renseignez l'email.";
            echo "Renseignez l'email.";

        }

        elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
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

        elseif (empty($confemail)) {
            $valid = false;
            $err_confemail = "Veuillez confirmer votre email.";
            echo "Veuillez confirmer votre email.";
        }

        elseif ($confemail !== $email) {
            $valid = false;
            $err_confemail = "Les emails ne correspondent pas.";
            $confemail = "";
            echo "Les emails ne correspondent pas.";
        }


        // VERIF PRENOM/NOM ------

        if (empty($prenom)) {
            $valid = false;
            $err_prenom = "Renseignez votre prénom.";
            echo "Renseignez votre prénom.";
        }

        elseif (!preg_match("#^[a-zA-Z]+$#", $prenom)) {
            $valid = false;
            $err_prenom ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $prenom ="";
            echo "Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        if (empty($nom)) {
            $valid = false;
            $err_nom = "Renseignez votre nom.";
            echo "Renseignez votre nom.";
        }

        elseif (!preg_match("#^[a-zA-Z]+$#", $nom)) {
            $valid = false;
            $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $nom ="";
            echo "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        // VERIF PASSWORD  ------

        if (empty($password)) {
            $valid = false;
            $err_password = "Renseignez votre mot de passe.";
            echo "Renseignez votre mot de passe.";
        }

        elseif (strlen($password)<8) {
            $valid = false;
            $err_password = "Le mot de passe doit être de 8 caractères minimum.";
            $password="";
            echo "Le mot de passe doit être de 8 caractères minimum.";
        }

        elseif (empty($confpassword)) {
            $valid = false;
            $err_confpassword = "Confirmez votre mot de passe.";
            echo "Confirmez votre mot de passe.";
        }

        elseif ($password !== $confpassword) {
            $valid = false;
            $err_confpassword = "Les mots de passe ne correspondent pas.";
            $confpassword ="";
            echo "Les mots de passe ne correspondent pas.";
        }

        if ($valid==true) {
            $register = $this->connexion->prepare("INSERT into utilisateurs (login, email, prenom, nom, password) VALUES (:login, :email, :prenom, :nom, :password)");
            $register->execute($data);

            $message = "Vous êtes inscrit.";
            echo "Vous êtes inscrit.";
            
        }
    }

    //FUNCTION CONNECT ---------------------------------------------------------------------------------------

    public function connect($login, $password) {

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
            $connect = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login='".$login."' && password='".md5($password)."'");
            $connect->setFetchMode(PDO::FETCH_ASSOC);
            $connect->execute();

            $connectresult = $connect->fetchall();

            if($connectresult) {
                echo "Vous êtes connecté.";

                $_SESSION['login'] = $login;
                $_SESSION['id'] = $connectresult[0]['id'];
                header('Location: compte.php?val="'.$connectresult[0]['login']."'");
            }

            else {
                echo "Le login et/ou le mot de passe est incorrect.";
                $err_connexion = "Le login et/ou le mot de passe est incorrect.";
            }
        }
    }

    // GETINFOS -----------------------------------------------------------------------------------------

    public function Getinfos() {
        $getinfos = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE id='".$_SESSION['id']."'");
        $getinfos->setFetchMode(PDO::FETCH_ASSOC);
        $getinfos->execute();

        $getinfosresult = $getinfos->fetchall();

        $this->login = $getinfosresult[0]['login'];
        $this->email = $getinfosresult[0]['email'];
        $this->prenom = $getinfosresult[0]['prenom'];
        $this->nom = $getinfosresult[0]['nom'];
        $this->session=$_SESSION['login'];
    }

    //UPDATEINFOS ---------------------------------------------------------------------------------------------

    public function Updateinfos() {
        $newlogin = trim($_POST['newlogin']);
        $newemail = trim($_POST['newemail']);
        $newprenom = trim(ucwords(strtolower($_POST['newprenom'])));
        $newnom = trim(ucwords(strtolower($_POST['newnom'])));
        $confemail = trim($_POST['confemail']);
        $password = trim($_POST['password']);

        $data = [
            'login'=>$newlogin,
            'email'=>$newemail,
            'nom'=>$newnom,
            'prenom'=>$newprenom,
        ];

        $valid = (boolean) true;


        // VERIF LOGIN -------------

        $reqlog = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login ='".$newlogin."'");
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

        // VERIF EMAIL ----------

        $reqmail = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE email ='".$newemail."'");
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

        elseif (empty($confemail)) {
            $valid = false;
            $err_confemail = "Veuillez confirmer votre email.";
            echo "Veuillez confirmer votre email.";
        }

        elseif ($confemail !== $newemail) {
            $valid = false;
            $err_confemail = "Les emails ne correspondent pas.";
            $confemail = "";
            echo "Les emails ne correspondent pas.";
        }


        // VERIF PRENOM/NOM ------

        if (empty($newprenom)) {
            $valid = false;
            $err_prenom = "Renseignez votre prénom.";
            echo "Renseignez votre prénom.";
        }

        elseif (!preg_match("#^[a-zA-Z]+$#", $newprenom)) {
            $valid = false;
            $err_prenom ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $prenom ="";
            echo "Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        if (empty($newnom)) {
            $valid = false;
            $err_nom = "Renseignez votre nom.";
            echo "Renseignez votre nom.";
        }

        elseif (!preg_match("#^[a-zA-Z]+$#", $newnom)) {
            $valid = false;
            $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $nom ="";
            echo "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        // VERIF PASSWORD  ------

        $reqpassword = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."' && password ='".md5($password)."'");
        $reqpassword->setFetchMode();
        $reqpassword->execute();

        $resultpassword = $reqpassword->fetch();

        if($resultpassword == false ) {
            $valid = false;
            $err_password = "Le mot de passe est incorrect.";
            echo "Le mot de passe est incorrect.";
        }

        if($valid==true) {

            $updateinfos = $this->connexion->prepare("UPDATE utilisateurs SET
            login=:login, 
            email=:email, 
            prenom =:prenom,
            nom =:nom
            WHERE login ='".$_SESSION['login']."'");

            $updateinfos->execute($data);
             
            echo "Modification enregistrées avec succès.";
            $message = "Modifications enregistrées avec succès.";
            $_SESSION['login'] = $newlogin;

        }

        
        
    }




}


?>