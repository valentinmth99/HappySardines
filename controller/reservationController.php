<?php

require('../model/bdd.php');

require('../model/classes/class_reservations.php');

require('../model/classes/class_locations.php');

// CONTROLLER FUNCTION BOOKING

if (!empty($_POST)) {
    extract($_POST);

    if (isset($_POST['calculate'])) {

        $arrival = $_POST['arrival'];
        $departure = $_POST['departure'];
        $equipment = $_POST['equipments'];
        $location = $_POST['location'];
        $option_borne = $_POST['option_borne'];
        $option_discoclub = $_POST['option_discoclub'];
        $option_activites = $_POST['activites'];

        $today = date('Y-m-d');
        $tomorrow = date($today + "+1day");

        $valid = (boolean) true;

        // Check if all necessary fiels are fulfilled

        if(empty($arrival) || empty($departure) || empty($equipment) || empty($location)) {
            $valid = false;
            $err_field = "Les champs avec (*) doivent être remplis.";
            echo "Les champs avec (*) doivent être remplis.";
        }

        // Check if arrival date is at least one day after today

        if($arrival < $today ) {
            $valid = false;
            $err_arrival = "La date d'arrivée ne peut être antérieure à celle du jour.";
            echo "La date d'arrivée ne peut être antérieure à celle du jour.";
        }
        
        // Check if departure is logic

        if($departure < $tomorrow) {
            $valid = false;
            $err_departure = "La réservation doit être minimum de deux jours et une nuit.";
            echo "La réservation doit être minimum de deux jorus et une nuit.";
        }

        // Check if available spaces on the location the user choose 

        if()


    }
}

?>