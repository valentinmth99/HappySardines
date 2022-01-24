<?php

session_start();

require('../model/classes/class_reservations.php');
require('../model/classes/class_user.php');
require('../model/classes/class_admin.php');

$check_admin = new Admin;
$check_admin->CheckAdmin();

?>