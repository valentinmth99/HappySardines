<?php 

class Reservations {

    private $id, $id_utilisateur, $id_habit, $id_lieux, $id_option;
    public $debut, $fin, $duree, $prix;

    public function contruct(){
        
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

    public function reserver($debut, $fin, $duree, $id_utilisateur, $id_habit, $id_lieux, $id_option, $prix){

        $reservation = $this->connexion->prepare("INSERT INTO reservations (debut, fin, duree, id_utilisateur, id_habit, id_lieux, id_option, prix) VALUES ($debut, $fin, $duree, $id_utilisateur, $id_habit, $id_lieux, $id_option, $prix)");
        $reservation->execute();

        echo "Votre réservation est confirmée.";

    }

    public function updateresa($debut, $fin, $duree, $id_habit, $id_lieux, $id_option, $prix){

        $updateresa = $this->connexion->prepare("UPDATE reservations SET debut=$debut, fin=$fin, duree=$duree, id_habit=$id_habit, id_lieux=$id_lieux, id_option=$id_option, prix=$prix WHERE id_utilisateur =$id_utilisateur");
        $updateresa->execute();

        echo "Votre réservation a bien été modifiée.";

    }

    public function consulter($debut, $fin, $id_habit, $id_lieux, $id_option, $prix){

        $consulter = $this->connexion->prepare("SELECT debut, fin, id_habit, id_lieux, id_option, prix FROM reservations WHERE id_utilisateur=$id_utilisateur");
        $consulter->execute();

        // Convertir id_habit en habit, id_lieux en lieu, id_option en options
        

    }

    public function annuler($id){

        $annuler = $this->connexion->prepare("DELETE * FROM reservations WHERE id=$id");
        $annuler->execute();

        echo "Votre reservation a bien été annulée.";

    }

    public function consultall(){

        $consultall = $this->connexion->prepare("SELECT * FROM reservations");
        $consultall->setFetchMode(PDO::FETCH_ASSOC);
        $consultall->execute();

        $consultallresult =$consultall->fetchAll();

    }

    public function calcultarif ($prix) {


    }

}