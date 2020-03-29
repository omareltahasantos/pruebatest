<?php

//fetch_user.php

include('database_connection.php');

session_start();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="70%">Username</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';
//AQUI VA UN FOR EACH DE CADA REGISTRO DE LA QUERY DE ARRIBA


$login = new login($objPDO);
  
$stmt = $login->onlySelectForEach("login", "*", "!=", "user_id", $_SESSION['user_id']);



while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {



 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $objPDO);
 

 if($user_last_activity > $current_timestamp)
 {
	 $status = '<span class="label label-success">Online</span>';
 }
 else
 {
	 $status = '<span class="label label-danger">Offline</span>';
 }
 $output .= '
 <tr>
	 <td>'.$row["username"].'</td>
	 <td>'.$status.'</td>
	 <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row["user_id"].'" data-tousername="'.$row["username"].'">Start Chat</button></td>
 </tr>
 ';



}

$output .= '</table>';

echo $output;

?>