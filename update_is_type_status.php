<?php

//update_is_type_status.php

include('database_connection.php');

session_start();

$logDetails= new loginDetails($objPDO, "=", "login_details_id", $_SESSION["login_details_id"]);

	$logDetails->setis_type($_POST["is_type"])->save();



?>