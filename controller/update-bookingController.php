<?php

require('../model/bdd.php');

require('../model/classes/class_reservations.php');

require('../model/classes/class_locations.php');

require('../model/classes/class_equipments.php');


// CONTROLLER FUNCTION BOOKING

if (!empty($_POST)) {
    extract($_POST);

    if (isset($_POST['updatebooking'])) {

        $arrival = $_POST['arrival'];
        $departure = $_POST['departure'];
        $equipment = $_POST['equipments'];
        $location = $_POST['location'];
        $id_user = $_SESSION['id'];

        if (isset($_POST['option_borne'])){

            $option_borne = 1;

        }

        else {

            $option_borne = 0;

        }
        
        if (isset($_POST['option_discoclub'])){

            $option_discoclub = 1;

        }

        else {

            $option_discoclub = 0;

        }

        if (isset($_POST['option_activities'])) {

            $option_activities = 1;

        }

        else {

            $option_activities = 0;

        }

        $today_date = date('Y-m-d');
        $tomorrow = strtotime($today_date . "+1day");
        $tomorrow_date = date('Y-m-d', $tomorrow);

        $valid = (boolean) true;

        // Check if all necessary fields are fulfilled

        if(empty($arrival) || empty($departure) || empty($equipment) || empty($location)) {
            $valid = false;
            $err_field = "Les champs avec (*) doivent être remplis.";
            echo "Les champs avec (*) doivent être remplis.";
        }

        // Check if arrival date is at least one day after today

        if($arrival < $today_date ) {
            $valid = false;
            $err_arrival = "La date d'arrivée ne peut être antérieure à celle du jour.";
            echo "La date d'arrivée ne peut être antérieure à celle du jour.";
        }
        
        // Check if departure date is at least one day after arrival

        if($departure < $tomorrow_date) {
            $valid = false;
            $err_departure = "La réservation doit être minimum de deux jours et une nuit.";
            echo "La réservation doit être minimum de deux jorus et une nuit.";
        }

        // Check if available spaces on the location the user choose with CheckSpaces function (for the location) and CheckSize function(for the size of the equipment)

        $spaces = new Locations();
        $available_spaces = $spaces->CheckSpaces($location);

        $size = new Equipments();
        $equipment_size = $size->CheckSize($equipment);

        if(($available_spaces - $equipment_size) < 0) {
            $valid = false;
            $err_spaces ="L'espace sélectionné ne peut pas vous accueillir.";
            echo "L'espace sélectionné ne peut pas vous accueillir.";
        }

        if($valid == true) {

            // getting the length

            $booking_length = new Reservations ();
            $length = $booking_length->CalculLength("$arrival", "$departure");
            

            // getting the rate 

            $booking_rate = new Reservations ();
            $rate = $booking_rate->CalculRate("$equipment", "$option_borne", "$option_discoclub", "$option_activities", "$length");
            

            //getting ids

            $booking_id_location = new Reservations ();
            $id_location = $booking_id_location->GetIdLocation("$location");

            $booking_id_equipment = new Reservations ();
            $id_equipment = $booking_id_equipment->GetIdEquipment("$equipment");
            


            // booking in BDD

            $booking = new Reservations ();
            $booking->UpdateBooking("$arrival", "$departure", "$length", "$option_borne", "$option_discoclub", "$option_activities", "$rate", "$id_user", "$id_location", "$id_equipment");
            
            unset($_SESSION['id_reservation']);
        }
    }
}

?>