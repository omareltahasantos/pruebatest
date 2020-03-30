<?php

//database_connection.php
require("class.pdofactory.php");
require("abstract.databoundobject.php");
require("loginMapping.php");
require("chatMessageMapping.php");
require("loginDetailsMapping.php");

//$connect = new PDO("pgsql:host=localhost;port=5432;dbname=omar;user=omar;password=APTItude01");
$strDSN = "pgsql:dbname=da6fucdbb9g9vd;host=ec2-46-137-177-160.eu-west-1.compute.amazonaws.com
;port=5432";
   $objPDO = PDOFactory::GetPDO($strDSN, "fcnlbfuyyoxhxb", "4297280e8c527dd9272cd8cf0f2ae4b3f0c77760f17f3fc858585d7324d2ea43", 
       array());
   $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Asia/Kolkata');

function fetch_user_last_activity($user_id, $objPDO)
{
	/*
	$details = new loginDetails($GLOBALS['objPDO'], "=", "user_id", $user_id);
    $loginid = $details->getvalor();
    $user_id = $details->getuser_id();
    $last_activity = $details->getlast_activity();
	$is_type = $details->getis_type();

	return $last_activity;
	*/
	$login_Details = new loginDetails($objPDO, "=", "user_id",$user_id );

	 $last_activity= $login_Details->getlast_activity();

	 return $last_activity;
	 /*
	$query = "
	SELECT * FROM login_details 
	WHERE user_id = '$user_id' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";
	*/
	/*
	$statement = $GLOBALS['objPDO']->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['last_activity'];
	}
*/
}

function fetch_user_chat_history($from_user_id, $to_user_id)
{
	/*
	$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp DESC
	";

	
	$statement = $GLOBALS["objPDO"]->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

*/
	$chatmessage = new chatMessage($GLOBALS['objPDO']);
	//public function onlySelectForEach($tabla = NULL, $campos= NULL, $signoS = NULL, $campoWhere = NULL, $valorS= NULL, $campoWhere2 = NULL, $valorS2= NULL , $condicionOR = NULL, $condicionAND= NULL, $parantesisderecho =NULL, $parentesisIzquierdo= NULL){
	$stmt = $chatmessage->onlySelectForEach("chat_message", "*", "=", "from_user_id", $from_user_id, "to_user_id",$to_user_id, "OR", "AND", ")", "(" );
	//echo $stmt;
	$output = '<ul class="list-unstyled">';

	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		//echo $row['user_id']. " ". $row['username']. " " .$row['password']."<br />\n";


		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $from_user_id)
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			}
			else
			{
				$chat_message = $row['chat_message'];
				$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button>&nbsp;<b class="text-success">You</b>';
			}
			

			$dynamic_background = 'background-color:#ffe6e6;';
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
			}
			else
			{
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id']).'</b>';
			$dynamic_background = 'background-color:#ffffe6;';
		}
		$output .= '
		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.'
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</li>
		';
	}


	
	
	$output .= '</ul>';

	return $output;
}

function get_user_name($user_id)
{
	$login = new login($GLOBALS["objPDO"], "user_id", $user_id);

	$usuario = $login->getusername();

	return $usuario;

}

function count_unseen_message($from_user_id, $to_user_id)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE from_user_id = '$from_user_id' 
	AND to_user_id = '$to_user_id' 
	AND status = '1'
	";
	$chat = new chatMessage($GLOBALS['objPDO']);
	$stmt = $chatmessage->onlySelectForEach("chat_message", "*", "=", "from_user_id", $from_user_id, "to_user_id",$to_user_id, "OR", "AND");
	$output = '';
	
	if($stmt->rowCount()>0){
		$output = '<span class="label label-success">'.$count.'</span>';
	}
	return $output;

	
}

function fetch_is_type_status($user_id)
{

	$login_Details = new loginDetails($GLOBALS['objPDO']);
	$stmt= $login_Details->onlySelectForEach("login_details", "is_type", "=", "user_id", $user_id);
	$output = '';
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		if($row["is_type"] == 'yes')
		{
			$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
		}

	}
	
	

	return $output;

}



?>
