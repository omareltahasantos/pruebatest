<?php


    class chatMessage extends DataBoundObject {
        protected $chat_message_id;
        protected $to_user_id;
        protected $from_user_id;
        protected $chat_message;
        protected $timestamp;
        protected $status;
        protected $ID;

      
        
        protected function DefineTableName() {
            return("chat_message");
    }
    
        protected function DefineRelationMap() {
                return(array(
                        "chat_message_id" => "valor",
                        "to_user_id" => "to_user_id",
                        "from_user_id" => "from_user_id",
                        "chat_message" => "chat_message",
                        "timestamp" => "timestamp",
                        "status" => "status"
                    ));
        }
    

      

        }
    

?>