<?php

//remove_chat.php

include('database_connection.php');

if(isset($_POST["chat_message_id"]))
{

	$chat = new chatMessage($objPDO, "=", "chat_message_id", $_POST["chat_message_id"]);

	$chat->setstatus(2)->save();


}

?>