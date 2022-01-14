<?php 
session_start();
include ('classes/class_reservations.php');
require ('classes/class_user.php');

$test = new Reservations;
$test->ListingUserBookings();