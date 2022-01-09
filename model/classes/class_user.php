<?php



class User {

    

    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $connexion;
    public $session;

    
    // DECLARATION DES METHODES 

     public function __construct() {  //VOIR POURQUOI LE CHEMIN REQUIRE FONCTIONNE PAS SA MERE
        $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');
            echo "Connecté à la bdd";
            $this->connexion=$bdd;
            
        }

        catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
       

    // FONCTION REGISTER -----------------------------------------------------------------------------------------------

    public function register($login, $email, $firstname, $lastname, $password) {

        $register = $this->connexion->prepare("INSERT into utilisateurs (login, email, firstname, lastname, password) VALUES ('".$login."', '".$email."', '".$firstname."', '".$lastname."', '".md5($password)."'");
        $register->execute();

        $message = "Vous êtes inscrit.";
        echo "Vous êtes inscrit.";
    }

    //FUNCTION CONNECT ---------------------------------------------------------------------------------------

    public function connect($login, $password) {


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

    // GETINFOS -----------------------------------------------------------------------------------------

    public function Getinfos() {
        $getinfos = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE id='".$_SESSION['id']."'");
        $getinfos->setFetchMode(PDO::FETCH_ASSOC);
        $getinfos->execute();

        $getinfosresult = $getinfos->fetchall();

        $this->login = $getinfosresult[0]['login'];
        $this->email = $getinfosresult[0]['email'];
        $this->firstname = $getinfosresult[0]['firstname'];
        $this->lastname = $getinfosresult[0]['lastname'];
        $this->session=$_SESSION['login'];
    }

    //UPDATEINFOS ---------------------------------------------------------------------------------------------

    public function Updateinfos() {

        $updateinfos = $this->connexion->prepare("UPDATE utilisateurs SET
        login=:login, 
        email=:email, 
        firstname =:firstname,
        lastname =:lastname
        WHERE login ='".$_SESSION['login']."'");

        $updateinfos->execute($data);
             
        echo "Modification enregistrées avec succès.";
        $message = "Modifications enregistrées avec succès.";
        $_SESSION['login'] = $newlogin;
  
    }

    //UPDATEPASSWORD ---------------------------------------------------------------------------------------------

    public function Updatepassword($password){

        $updatepassword = $this->connexion->prepare("UPDATE utilisateurs SET password='".md5($newpassword)."' WHERE login ='".$_SESSION['login']."'");
        $updatepassword->execute();

        $message = "Le nouveau mot de passe a bien été enregistré.";

        echo "Le nouveau mot de passe a bien été enregistré.";
    }




}

?>