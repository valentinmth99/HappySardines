<?php 

class Reservations {

    private $id, $id_user, $id_habit, $id_location, $option_activities, $option_borne, $option_discoclub;
    public $arrival, $departure, $length, $rate, $connexion;

    public function __construct(){
        
        try {

            $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');
            $this->connexion=$bdd;
            
        }

        catch (PDOException $e) {

            echo $e->getMessage();
            die();
        
        }
    
    }

    // FONCTION RESERVATION 

    public function CalculLength($arrival, $departure){

        $firstDate  = new DateTime($arrival);
        $secondDate = new DateTime($departure);
        $intvl = $firstDate->diff($secondDate);
        
        $length = $intvl->days;
        
        return $length;

    }




    // FONCTION AFFICHAGE RESERVATION

    public function Consult(){

        $consult = $this->connexion->prepare("SELECT arrival, departure, id_habit, id_location, option_activities, option_borne, option_discoclub, rate FROM reservations WHERE id_user=$id_user");
        $consult->execute();

        // Convertir id_habit en habit, id_lieux en lieu, id_option en options
        
    }

    // FONCTION ANNULATION BOOKING

    public function Cancel(){

        $cancel = $this->connexion->prepare("DELETE * FROM reservations WHERE id=$id");
        $cancel->execute();

        echo "Votre reservation a bien été annulée.";

    }

    // FONCTION ADMIN AFFICHER TOUTES RESERVATIONS 

    public function ConsultAll(){

        $consultall = $this->connexion->prepare("SELECT * FROM reservations");
        $consultall->setFetchMode(PDO::FETCH_ASSOC);
        $consultall->execute();

        $consultallresult =$consultall->fetchAll();

    }

    // FONCTION CALCUL PRIX SEJOUR 

    public function CalculRate ($equipment, $option_borne, $option_discoclub, $option_activities, $length) {

    // CALCUL PRIX TENTE/CAMPING CAR

        $get_rate_equipment = $this->connexion->prepare("SELECT rate FROM equipments WHERE name = '".$equipment."'");    
        $get_rate_equipment->setFetchMode(PDO::FETCH_ASSOC);
        $get_rate_equipment->execute();

        $result_rate_equipment = $get_rate_equipment->fetch();

        $rate_equipment = intval($result_rate_equipment['rate']);
        
    // CALCUL PRIX OPTIONS

       if ($option_borne==1) {

            $get_rate_option_1 = $this->connexion->prepare("SELECT rate from options WHERE id='1'");
            $get_rate_option_1->setFetchMode(PDO::FETCH_ASSOC);
            $get_rate_option_1->execute();

            $result_rate_option_1 = $get_rate_option_1->fetchall();
            
            $rate_option_1 = intval($result_rate_option_1[0]['rate']);

        }

        else {

            $rate_option_1 = 0;
        }

        if ($option_discoclub==1) {

            $get_rate_option_2 = $this->connexion->prepare("SELECT rate from options WHERE id='2'");
            $get_rate_option_2->setFetchMode(PDO::FETCH_ASSOC);
            $get_rate_option_2->execute();

            $result_rate_option_2 = $get_rate_option_2->fetchall();
            
            $rate_option_2 = intval($result_rate_option_2[0]['rate']);
            
        }

        else {

            $rate_option_2 = 0;

        }

        if ($option_activities==1) {

            $get_rate_option_3 = $this->connexion->prepare("SELECT rate from options WHERE id='3'");
            $get_rate_option_3->setFetchMode(PDO::FETCH_ASSOC);
            $get_rate_option_3->execute();

            $result_rate_option_3 = $get_rate_option_3->fetchall();
            
            $rate_option_3 = intval($result_rate_option_3[0]['rate']);

        }

        else {

            $rate_option_3 = 0;

        }

        //CALCUL PRIX TOTAL SEJOUR 
        
        $rate = ($rate_equipment + $rate_option_1 + $rate_option_2 + $rate_option_3) * $length;

        return $rate;

    }

    public function GetIdLocation($location){

        $get_id_location = $this->connexion->prepare("SELECT id FROM locations WHERE name = '".$location."'");
        $get_id_location->setFetchMode(PDO::FETCH_ASSOC);
        $get_id_location->execute();
        $fetch_id_location = $get_id_location->fetch();

        return $id_location = intval(($fetch_id_location)['id']);
    }

    public function GetIdEquipment($equipment) {
        $get_id_equipment = $this->connexion->prepare("SELECT id FROM equipments WHERE name = '".$equipment."'");
        $get_id_equipment->setFetchMode(PDO::FETCH_ASSOC);
        $get_id_equipment->execute();
        $fetch_id_equipment = $get_id_equipment->fetch();

        return $id_equipment = intval(($fetch_id_equipment)['id']);

    }

    public function Booking($arrival, $departure, $length, $option_borne, $option_discoclub, $option_activities, $rate, $id_user,$id_location,$id_equipment){

        $data = [
            'arrival'=>$arrival,
            'departure'=>$departure,
            'length'=>intval($length),
            'option_borne'=>intval($option_borne),
            'option_discoclub'=>intval($option_discoclub),
            'option_activities'=>intval($option_activities),
            'rate'=>intval($rate),
            'id_user'=>intval($id_user),
            'id_location'=>intval($id_location),
            'id_equipment'=>intval($id_equipment),
        ];

        $booking = $this->connexion->prepare("INSERT INTO reservations (arrival, departure, length, option_borne, option_discoclub, option_activities, rate, id_user, id_location, id_equipment) 
        VALUES (:arrival, :departure, :length, :option_borne, :option_discoclub, :option_activities, :rate, :id_user, :id_location, :id_equipment)");
        $booking->execute($data);
        
        echo "Votre réservation est confirmée.";

    }

    // FONCTION UPDATE BOOKING 

    public function UpdateBooking($arrival, $departure, $length, $option_borne, $option_discoclub, $option_activities, $rate, $id_location, $id_equipment){

        $data = [
            'arrival'=>$arrival,
            'departure'=>$departure,
            'length'=>intval($length),
            'option_borne'=>intval($option_borne),
            'option_discoclub'=>intval($option_discoclub),
            'option_activities'=>intval($option_activities),
            'rate'=>intval($rate),
            'id_user'=>intval($id_user),
            'id_location'=>intval($id_location),
            'id_equipment'=>intval($id_equipment),
        ];
        
        $updatebooking = $this->connexion->prepare("UPDATE reservations SET arrival=:arrival, departure=:departure, length=:length, option_borne = :option_borne, option_discoclub = :option_discoclub, option_activities = :option_activities, rate = :rate, id_location = :id_location, id_equipment = :id_equipment WHERE id ='".$id_reservation."'");
        $updatebooking->execute();

        echo "Votre réservation a bien été modifiée.";

    }



        

}