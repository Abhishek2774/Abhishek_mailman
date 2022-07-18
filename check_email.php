<?php 
include "autoload.php";
$gobj = new Database();

$trval = $_POST["id"];
$sql = "SELECT email from Reg_userid WHERE email='$trval'";

$result = $gobj->mysqli->query($sql);



if($result->num_rows > 0){

 $row = $result->fetch_all(MYSQLI_ASSOC);
 echo json_encode(['msg'=> "Email Already Exist", "status"=> true]);
 
}else{
    echo json_encode(['msg'=>'0 Result Found', 'status'=> false]);
}
?>
