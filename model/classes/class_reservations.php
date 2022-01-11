<?php 

class Reservations {

    private $id, $id_user, $id_habit, $id_location, $option_activities, $option_borne, $option_discoclub;
    public $arrival, $departure, $length, $rate, $connexion;

    public function Contruct(){
        
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

    // public function CalculLength($length){


    // }
    public function Booking($arrival, $departure, $length, $option_borne, $option_discoclub, $option_activities, $rate,$id_user,$id_location,$id_habit){

        $data = [
            'arrival'=>$arrival,
            'departure'=>$departure,
            'length'=>$length,
            'option_borne'=>$option_borne,
            'option_discoclub'=>$option_discoclub,
            'option_activities'=>$option_activities,
            'rate'=>$rate,
            'id_user'=>$id_user,
            'id_location'=>$id_location,
            'id_habit'=>$id_habit,
        ];

        $booking = $this->connexion->prepare("INSERT INTO reservations (arrival, departure, length, option_borne, option_discoclub, option_activities, rate, id_user, id_location, id_habit) VALUES (:arrival, :departure, :length, :option_borne, :option_discoclub, :option_activities, :rate, :id_user, :id_location, :id_habit)");
        $booking->execute($data);
        
        echo "Votre réservation est confirmée.";

    }

    public function UpdateBooking($arrival, $departure, $length, $option_borne, $option_discoclub, $option_activities, $rate, $id_location, $id_habit){

        $data = [
            'arrival'=>$arrival,
            'departure'=>$departure,
            'length'=>$length,
            'option_borne'=>$option_borne,
            'option_discoclub'=>$option_discoclub,
            'option_activities'=>$option_activities,
            'rate'=>$rate,
            'id_location'=>$id_location,
            'id_habit'=>$id_habit,
        ];

        
        $updatebooking = $this->connexion->prepare("UPDATE reservations SET arrival=:arrival, departure=:departure, length=:length, option_borne = :option_borne, option_discoclub = :option_discoclub, option_activities = :option_activities, rate = :rate, id_location = :id_location, id_habit = :id_habit WHERE id_user ='".$id_user."'");
        $updatebooking->execute();

        echo "Votre réservation a bien été modifiée.";

    }

    public function Consult(){

        $consult = $this->connexion->prepare("SELECT arrival, departure, id_habit, id_location, option_activities, option_borne, option_discoclub, rate FROM reservations WHERE id_user=$id_user");
        $consult->execute();

        // Convertir id_habit en habit, id_lieux en lieu, id_option en options
        
    }

    public function Cancel(){

        $cancel = $this->connexion->prepare("DELETE * FROM reservations WHERE id=$id");
        $cancel->execute();

        echo "Votre reservation a bien été annulée.";

    }

    public function ConsultAll(){

        $consultall = $this->connexion->prepare("SELECT * FROM reservations");
        $consultall->setFetchMode(PDO::FETCH_ASSOC);
        $consultall->execute();

        $consultallresult =$consultall->fetchAll();

    }

    public function CalculRate ($rate) {

    }

}