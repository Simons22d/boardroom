<?php
session_start();
// making the db connection 
try{
    $conn = new PDO("mysql:host=localhost;dbname=user_logins","root","");
}catch(Exeption $e){
    echo "error : ".$e->getMessage();
}


// listening for pos requests
if($_POST){
	echo json_encode(["msg"=>"working..."]);
}
?>


