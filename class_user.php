<?php




class User {

    private $id;
    public $login;
    public $email;
    public $prenom;
    public $nom;
    public $connexion;
    
    // DECLARATION DES METHODES 

    public function __construct() {}

    // FONCTION REGISTER --------------------------------------------------

    public function register($login, $password, $email, $prenom, $nom) {

        require('bdd.php');
        $this->login = $login;
        $this->email = $email;
        $this->prenom = $prenom;
        $this->nom = $nom;


        // VERIF LOGIN -------------

        $reqlog = $bdd->prepare("SELECT * FROM utilisateurs WHERE login ='".$this->login."'");
        $reqlog->setFetchMode();

        $resultlog = $reqlog->fetch();


        if (empty($this->login)) {
            $valid = false;
            $err_login = "Veuillez renseigner votre login.";
            echo "Veuillez renseigner votre login.";
        }

        elseif (strlen($this->login)>20) {
            $valid = false;
            $err_login = "Le login ne doit pas dépasser 20 caratères";
            $this->login="";
            echo "Le login ne doit pas dépasser 20 caractères.";
        }

        elseif (!preg_match("#^[a-z0-9]+$#" ,$this->login)) {
            $valid = false;
            $err_login = "Le login doit uniquement contenir des lettres minuscules et des chiffres.";
            $this->login="";
            echo "Le login doit uniquement contenir des lettres minuscules et des chiffres. ";
        }

        elseif ($resultlog) {
            $valid = false;
            $err_login = "Ce login est déjà utilisé.";
            $this->login = '';
            echo "Ce login est déjà utilisé.";
        }

        // VERIF EMAIL ----------

        $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE login ='".$this->login."'");
        $reqmail->setFetchMode();

        $resultmail = $reqmail->fetch();

        if (empty($this->email)) {
            $valid = false;
            $err_email = "Veuillez renseigner votre adresse email.";
            echo "Veuillez renseigner votre adresse email.";
        }

        elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $valid=false;
            $err_email = "Votre adresse email n'est pas au bon format";
            $this->email = "";
            echo "L'adresse email n'est pas au bon format.";
        }

        elseif ($resultmail) {
            $valid = false;
            $err_email = "Cette adresse mail est déjà utilisée.";
            $this->email = '';
            echo "Cette adresse mail est déjà utilisée.";
        }

        elseif (empty($confemail)) {
            $valid = false;
            $err_confemail = "Veuillez confirmer votre email.";
            echo "Veuillez confirmer votre email.";
        }

        elseif ($confemail =! $this->email) {
            $valid = false;
            $err_confemail = "Les emails ne correspondent pas.";
            $confemail = "";
            echo "Les emails ne correspondent pas.";
        }


        // VERIF PRENOM/NOM ------

        if (empty($this->prenom)) {
            $valid = false;
            $err_prenom = "Veuillez renseigner votre prénom.";
            echo "Veuillez renseigner votre prénom.";
        }

        elseif (!preg_match("#^[a-z]+$#", $this->prenom)) {
            $valid = false;
            $err_prenom ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $this->prenom = "";
            echo "Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        if (empty($this->nom)) {
            $valid = false;
            $err_nom = "Veuillez renseigner votre nom.";
            echo "Veuillez renseigner votre nom.";
        }

        elseif (!preg_match("#^[a-z]+$#", $this->nom)) {
            $valid = false;
            $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
            $this->nom = "";
            echo "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        }

        // VERIF PASSWORD  ------

        if (empty($password)) {
            $valid = false;
            $err_password = "Veuillez renseigner votre mot de passe.";
            echo "Veuillez renseigner votre mot de passe.";
        }

        elseif (empty($confpassword)) {
            $valid = false;
            $err_confpassword = "Veuillez confirmer votre mot de passe.";
            $confpassword = "";
            echo "Veuillez confirmer votre mot de passe.";
        }

        elseif ($password =! $confpassword) {
            $valid = false;
            $err_confpassword = "Les mots de passe ne correspondent pas.";
            $confpassword = "";
            echo "Les mots de passe ne correspondent pas.";
        }

        if ($valid==true) {
            $register = $bdd->prepare("INSERT into utilisateurs (login, email, prenom, nom, password) VALUES ('".$this->login."', '".$this->email."', '".$this->prenom."','".$this->nom."' , '".md5($password)."')");
            $register->execute();

            $message = "Vous êtes inscrit.";
            echo "Vous êtes inscrit.";

            $destinataire = $this->email;
            $sujet = "Confirmation d'inscription.";
            $message = "Bonjour '".$this->login."', merci de votre inscription sur le site de CHS. Connectez vous <a href='localhost/connexion.php'>ici</a>"; 

            mail($destinaire, $sujet, $message);
        }
    }
}


?>