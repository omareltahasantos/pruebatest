<?php
/*
$connect = new PDO("pgsql:host=localhost;port=5432;dbname=omar;user=omar;password=APTItude01");

$data = array(
    ':username'		=>	'laura',
    ':password'		=>	password_hash("APTItude01", PASSWORD_DEFAULT)
);

$query = "
				INSERT INTO login 
				(username, password) 
				VALUES (:username, :password)
                ";
                
$statement = $connect->prepare($query);

if($statement->execute($data))
				{
                    $message = "<label>Registration Completed</label>";
                    echo $message;
                }
    */

    class login extends DataBoundObject {
        protected $user_id;
       // protected $username;
        protected $password;
       

      
        
        protected function DefineTableName() {
            return("login");
    }
    
        protected function DefineRelationMap() {
                return(array(
                        "user_id" => "valor",
                        "username" => "username",
                        "password" => "password"));
        }
    

      

        }
    

?>