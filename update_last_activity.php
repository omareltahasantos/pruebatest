<?php

//update_last_activity.php

include('database_connection.php');

session_start();
$logDetails= new loginDetails($objPDO, "=", "login_details_id", $_SESSION["login_details_id"]);

	$logDetails->setlast_activity($_SESSION["login_details_id"])->save();



?>

