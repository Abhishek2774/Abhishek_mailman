<?php 
include "autoload.php";
$gobj = new Database();

// create variable for store data
        $fname = $_POST['fname'];
         $lname = $_POST['lname'];
        $username = $_POST['username'];
         $email = $_POST['email'];
        $remail = $_POST['remail'];
       $pass= $_POST['pass'];
         $cpass = $_POST['cpass'];
        $checkbox = $_POST['checkbox'];
        $image = $_FILES['image'];


$result = array();

if ($fname == '' && $fname == null) {
    $result["f_error"] = "Please Enter first name";
} elseif (!preg_match("/^[A-Za-z]+$/", $fname)) {
    $result["f_error"] = "Only latter are Allowed";
} else {
    $result["f_error"] = "";
}

if ($lname == '' && $lname == null) {
    $result["l_error"] = "Please Enter Last name";
} elseif (!preg_match("/^[A-Za-z]+$/", $lname)) {
    $result["l_error"] = "Only latter are Allowed";
} else {
    $result["l_error"] = "";
}


if ($username == '' && $username == null) {
    $result["user_error"] = "Please Enter user name";
} elseif (!preg_match("/^[A-Za-z0-9]+$/", $username)) {
    $result["user_error"] = "username name shuld be alphabetic";
} else {
    $result["user_error"] = "";
}

if(Validate::required($email)){ 
        $result["email_error"] = "Email is required";
    }elseif(Validate::is_email($email)){
        $result["email_error"] = "Invalide Email";
    }else{
    $result["email_error"] = "";
    }

    if(Validate::required($remail)){
        $result["remail_error"] = "Recovery Email is required";
    }elseif(Validate::is_email($remail)){
        $result["remail_error"] = "Invalide Email";
    }else{
        $result["remail_error"] = " ";
    }

    if(Validate::is_valid_password($pass)){
    $result["pass_error"] = " Password should be at least 8 characters in <br> length and should include at least one upper case letter,<br> one number, and one special character.";
    }else{
        $result["pass_error"] = "";
    }
    
    if(Validate::ic_conf_pass($pass,$cpass)){
        $result["cpass_error"]= "Password are not Match";
    }else{
    $result["cpass_error"]= "";

    }
    if(Validate::is_profile($image)){
        $result["img_error"] = "Only PNG and JPG are allowed  and size shuld not be exceeds 2MB";
    }else{
       $result["img_error"]= "";

    }
   
if($fname !='' && $lname !='' && $username != '' &&  $email !='' && $remail !='' && $pass !='' && $cpass !='' &&  $checkbox !='' && $image !=''){
  
    $target_dir = "../upload";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $folder = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $data = [
                'fname' => $_POST["fname"],
                'lname' => $_POST["lname"],
                'username' => $_POST["username"],
                'email' => $_POST["email"],
                'remail' => $_POST["remail"],
                'pass' => $_POST["pass"],
                'cpass' => $_POST["cpass"],
                'image' => $target_file,
                't_condition' => $_POST["checkbox"]
                
            ];  

            if($gobj->insert('Reg_userid',$data)){
                $result = $gobj->getResult(); 
                echo json_encode(["status" => true, "type" => "user_registered", "message" => "Your account created successfully."]); exit;
                  
            }

}

$result["type"] = "form_error";

echo json_encode($result);

    
      
 


?>