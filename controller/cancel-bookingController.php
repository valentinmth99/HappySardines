<?php 

require('../model/classes/class_reservations.php');

if (isset($_POST['confirmcancel'])){

    $cancel_booking = new Reservations;
    $cancel_booking->Cancel();
    unset ($_SESSION['id_reservation']);
    
}

?>