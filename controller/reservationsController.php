<?php

    require('../model/classes/class_reservations.php');
    require('../model/bdd.php');


    $param = array();

    if (isset($_POST['research'])) {

        $arrival = htmlspecialchars($_POST['arrival']);
        $departure = htmlspecialchars($_POST['departure']);
        $firstname = htmlspecialchars(strtolower(trim($_POST['firstname'])));
        $lastname = htmlspecialchars(strtolower(trim($_POST['lastname'])));


        //PREPARE THE QUERY INFORMATION FOR THE WHERE CLAUSE
        $whereParts = array();

        if($arrival)     { $whereParts[] = "arrival = '$arrival'"; }
        if($departure) { $whereParts[] = "departure = '$departure'"; }
        if($firstname) { $whereParts[] = "users.firstname = '$firstname'"; }
        if($lastname) { $whereParts[] = "users.lastname = '$lastname'"; }
        
        //BUILD THE QUERY
        $query = "SELECT * from reservations
        INNER JOIN users on users.id = reservations.id_user ";

        if(count($whereParts)) {
            $query .= "WHERE " . implode('AND ', $whereParts);
        }

        $research_reservations = new Reservations;
        $research_reservations->ResearchReservations($query);
    }


    

?>