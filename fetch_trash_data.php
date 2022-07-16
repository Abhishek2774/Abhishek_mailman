<?php
session_start();
include "autoload.php";
$gobj = new Database();

$login_user = $_SESSION['login_user_Email'];

$sql ="SELECT * FROM All_emails 
WHERE  (((sender_status=0 and reciver_status=1) or (sender_status=0 and reciver_status=0)) and sender_email='$login_user') or (reciver_email='$login_user' and (reciver_status=0 and sender_status=1))";

  $result = $gobj->mysqli->query($sql);
        if($result->num_rows > 0){

            $output = $result->fetch_all(MYSQLI_ASSOC);
             echo json_encode($output);
            
        }else{
            echo json_encode(array("msg"=> "0 Result found","status"=> false));
        }
        
 
?>