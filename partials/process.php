<?php
session_start();
// making the db connection 
// try[
//     $conn = new PDO("mysql:host=localhost;dbname=user_logins","root","");
// }catch(Exeption $e){
//     echo "error : ".$e->getMessage();
// }


// listening for pos requests
if($_POST){
	$events = array(
        array("id" => 1265, "start" => "2019-07-25", "title" => "Bentley", "editable" => false, "allDay" => true),
        array("id" => 1222, "start" => "2019-07-14", "title" => "Dave", "editable" => false, "allDay" => true),
    );
    echo json_encode($events);
}
?>


