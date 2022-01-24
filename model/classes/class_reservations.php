<?php 

class Reservations {

    public $id, $id_user, $id_habit, $id_location, $option_activities, $option_borne, $option_discoclub, $id_reservation;
    public $arrival, $departure, $length, $rate, $connexion, $equipment, $location, $substraction;
    private $equipment_space;

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


    // FONCTION LISTE DES RESERVATIONS D'UN USER SUR SON COMPTE
    public function ListingUserBookings(){

        $id_user = $_SESSION['id'];
        $query = "SELECT reservations.id, arrival, departure, equipments.type, locations.name FROM reservations 
        INNER JOIN equipments ON reservations.id_equipment = equipments.id 
        INNER JOIN locations ON reservations.id_location = locations.id WHERE id_user=$id_user";

        $list_booking = $this->connexion->prepare($query);
        $list_booking->setFetchMode(PDO::FETCH_ASSOC);
        $list_booking->execute();
        $fetch_list_booking = $list_booking->fetchAll();


        for ($i=0; isset($fetch_list_booking[$i]); $i++){

            $id_reservation = $fetch_list_booking[$i]['id'];
            $arrival = $fetch_list_booking[$i]['arrival'];
            $departure = $fetch_list_booking[$i]['departure'];
            $equipment = $fetch_list_booking[$i]['type'];
            $location = $fetch_list_booking[$i]['name'];

            if ($equipment == 'campingcar'){
                $equipment = 'camping-car';
            }

            if ($location == 'plage'){
                $location = "La Plage";
            }

            elseif ($location == 'pins'){
                $location = 'Les Pins';
            }

            elseif ($location == 'maquis'){
                $location = 'Le Maquis';
            }

            echo "<div><a href='vos-reservations.php?val=".$id_reservation."'> Votre séjour du $arrival au $departure en $equipment à l'emplacement $location</a></div>";

            // AJOUTER LE LIEN VERS LE BAIL DETAILLER DE LA RESERVATION

            

        }

    }

    // FONCTION AFFICHAGE RESERVATION D'UN USER
    public function ConsultUserBooking(){


        // RETAPER CETTE MERDE  POUR ENLEVER LES IF INUTILE UTILISER UN INNER JOIN
        $id_user = $_SESSION['id'];
        $get_booking = $this->connexion->prepare("SELECT id, arrival, departure, option_borne, option_discoclub, option_activities, rate, id_location, id_equipment FROM reservations WHERE reservations.id='".@$_GET['val']."'");
        $get_booking->setFetchMode(PDO::FETCH_ASSOC);
        $get_booking->execute();
        $fetch_booking = $get_booking->fetch();
        
        $this->id_reservation = $fetch_booking['id'];
        $this->arrival = $fetch_booking['arrival'];
        $this->departure = $fetch_booking['departure'];
        $this->rate = $fetch_booking['rate'];


        $_SESSION['id_reservation'] = $fetch_booking['id'];

        if ($fetch_booking['id_equipment']=='1') {
            $this->equipment = 'Tente';
        }

        else {
            $this->equipment = 'Camping-car';
        }

        if ($fetch_booking['id_location']=='1') {
            $this->location = 'La Plage';
        }

        elseif ($fetch_booking['id_location']=='2'){
            $this->location = 'Le Maquis';
        }

        elseif ($fetch_booking['id_location']=='3'){
            $this->location = 'Les Pins';
        }

        if ($fetch_booking['option_borne']=='1') {
            $this->option_borne = 'Oui';
        }

        else {
            $this->option_borne = 'Non';
        }

        if ($fetch_booking['option_discoclub']=='1'){
            $this->option_discoclub = 'Oui';
        }

        else {
            $this->option_discoclub = 'Non';
        }

        if ($fetch_booking['option_activities']=='1'){
            $this->option_activities = 'Oui';
        }

        else {
            $this->option_activities = 'Non';
        }
    
    }

    // FONCTION ANNULATION BOOKING

    public function Cancel(){

        $id_reservation = $_SESSION['id_reservation'];
        $cancel = $this->connexion->prepare("DELETE  FROM reservations WHERE reservations.id =$id_reservation");
        $cancel->execute();

        echo "Votre reservation a bien été annulée.";

    }

    // FONCTION ADMIN AFFICHER TOUTES RESERVATIONS 

    public function ConsultAll(){

        $consultall = $this->connexion->prepare("SELECT * FROM reservations");
        $consultall->setFetchMode(PDO::FETCH_ASSOC);
        $consultall->execute();

        $consultallresult =$consultall->fetchAll();

        var_dump($consultallresult);

    }

    // FONCTION CALCUL PRIX SEJOUR 

    public function CalculRate ($equipment, $option_borne, $option_discoclub, $option_activities, $length) {

    // CALCUL PRIX TENTE/CAMPING CAR

        $get_rate_equipment = $this->connexion->prepare("SELECT rate FROM equipments WHERE type = '".$equipment."'");    
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

        $get_id_equipment = $this->connexion->prepare("SELECT id FROM equipments WHERE type = '".$equipment."'");
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

    public function UpdateBooking($arrival, $departure, $length, $option_borne, $option_discoclub, $option_activities, $rate, $id_user, $id_location, $id_equipment){

        $id_reservation = $_SESSION['id_reservation'];

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
            'id_equipment'=>$id_equipment,
        ];
        
        $query="UPDATE reservations 
        SET arrival=:arrival, 
        departure=:departure, 
        length=:length, 
        option_borne = :option_borne, 
        option_discoclub = :option_discoclub, 
        option_activities = :option_activities, 
        rate = :rate, 
        id_user = :id_user,
        id_location = :id_location, 
        id_equipment = :id_equipment 
        WHERE id ='".$id_reservation."'";
        $updatebooking = $this->connexion->prepare($query);
        $updatebooking->execute($data);

        echo "Votre réservation a bien été modifiée.";

    }

    // SUPPRIME LA TABLE EPHEMERE PERMETTANT LE CALCUL DES PLACES DISPOS

    public function DropTable() {
        $query = " DROP TABLE IF EXISTS unavailable_space";
        $drop_table = $this->connexion->prepare($query);
        $drop_table->execute();
    }



    // LISTE LES JOURS DE RESERVATIONS ENTRE DEUX DATES POUR REMPLIR LE PLANNING

    public function BetweenDates()  {
        $query = "SELECT reservations.id, reservations.id_user, reservations.arrival, reservations.departure, reservations.id_location, users.firstname, users.lastname 
        FROM reservations 
        INNER JOIN locations on locations.id = reservations.id_location 
        INNER JOIN users on users.id = reservations.id_user
        WHERE locations.name ='".@$_GET['location']."'";
        $request = $this->connexion->prepare($query);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();
        
        $assoc = $request->fetchAll();

        $between_dates[] = array();

        // var_dump($assoc);


        for ($i = 0 ; isset($assoc[$i]) ; $i ++) {

            $arrival = strtotime($assoc[$i]['arrival']);
            $departure = strtotime($assoc[$i]['departure']);
            $id_user = $assoc[$i]['id_user'];
            $id_reservation = $assoc[$i]['id'];
            $lastname = $assoc[$i]['lastname'];
            $firstname = $assoc[$i]['firstname'];

            for ($j = $arrival ; $j<= $departure; $j += 86400) {

                $between_dates[$i][$j]['id_reservation'] = $id_reservation;
                $between_dates[$i][$j]['id_user'] = $id_user;
                $between_dates[$i][$j]['firstname'] = $firstname;
                $between_dates[$i][$j]['lastname'] = $lastname;
                $between_dates[$i][$j]['date'] = date("Y-m-d", $j);

            }

        }

        // var_dump($between_dates);

        return $between_dates;
    }

    // AFFICHE LA RESERVATION DANS LE PLANNING 

    public function DisplayReservation ($date) {

        $get_between_dates = new Reservations;
        $between_dates = $get_between_dates->BetweenDates();

        $time = $date->format('Y-m-d');
        $timestamp = strtotime($time);

        for ($i = 0  ; isset($between_dates[$i]) ; $i ++) {

            foreach ( $between_dates[$i] as $result) {

                if ( $result['date'] == $time ) {

                    echo "<div> N° ".$result['id_reservation']." -".$result['firstname']." ".$result['lastname']."</div>";


                }
            }
        }
    }
}