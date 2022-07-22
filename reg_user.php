<?php
include "autoload.php";
if (isset($_POST['submit'])) {
  $gobj = new Database();
  $error = array();


  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $email = $_POST['email'];

  $primary_email = "/^[\w.+\-]+@mailman\.com$/";
  $recover_pattern = "/^[\w.+\-]+@gmail\.com$/";

  $namepattern = "/^[A-Za-z]+$/";
  $remail = $_POST['remail'];
  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];
  $image = $_FILES['image'];
 
  if ($fname == '' and $fname == null) {
    $error['f_error'] = 'Please Enter fname Name';
  } else if (!preg_match($namepattern, $fname)) {
    $error['f_error'] = 'Only letters allowed';
  } else {
    $error['f_error']='';
  }

  if ($lname == '' and $lname == null) {
    $error['l_error'] = 'Please Enter last Name';
  } else if (!preg_match($namepattern, $lname)) {
    $errorerror['l_error'] = 'Only letters allowed';
  } else {
    $error['l_error']='';
  }

  if ($username == null and $username=='') {
    $error['user_error'] = 'Please fill  User Name';
  } else {
     $sql = "SELECT username FROM Reg_userid   WHERE username  = '$username'";
     $result = $gobj->mysqli->query($sql);
    if ($result->num_rows > 0) {
      $error['user_error'] = 'Username already Exist';
    } else {
      $error['user_error'] = '';
    }
  }

   if(!preg_match($primary_email, $email)){
    $email = $_POST['email'] . "@mailman.com";
  }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email_error'] = 'email address not valid';
  } else{
    $sql = "SELECT email from Reg_userid where email = '$email'";
    $result = $gobj->mysqli->query($sql);
    if ($result->num_rows > 0) {
      $error['email_error'] = 'email address not unique';
    } else {
      $error['email_error'] = '';
    }

  }

 if (!preg_match($recover_pattern, $remail)) {
    $error['remail_error'] = 'Invalid Email';
  } else {
    $error['remail_error'] = '';
  }

  if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,20}$/', ($pass))) {
    $error['pass_error'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
  } else {
    $error['pass_error'] = '';
  }

  if ($pass != $cpass) {
    $error['cpass_error'] = 'Password should be same';
  } else {

    $error['cpass_error'] = '';
  }


  $path="../upload";
  $temp_name = $image['tmp_name'];
  $name = $image['name'];
   $path = $path . "/" . $name;
    if ($image != null) {
    $allowed =  array('jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG');
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
      $error['imgid'] = 'Please upload valid image';
    } else if ($image['name']['size'] > 200000) {
      $error['imgid'] = 'size should be less than 2 kb';
    } else {
      move_uploaded_file($temp_name, $path);
      $error['imgid'] = '';
    }
  }


$count=0;
foreach ( $error as $key => $value ) {
  if($value != ''){
    $count=1;
    break;
  }
}

  if ($count==1) {
    echo json_encode(
      [
        "arrayvalue" => $error,
        "response" => false
      ]
    );
  } else {

          $data = [
                'fname' => $_POST["fname"],
                'lname' => $_POST["lname"],
                'username' => $_POST["username"],
                'email' => $_POST["email"],
                'remail' => $_POST["remail"],
                'pass' => $_POST["pass"],
                'cpass' => $_POST["cpass"],
                'image' => $name,
                't_condition' => $_POST["checkbox"]
                      
                  ];  
      
                  if($gobj->insert('Reg_userid',$data)){
                      $result = $gobj->getResult(); 
                      echo json_encode(["response" => true, "type" => "user_registered", "message" => "Your account created successfully."]); exit;
                        
                  }
   
  }

 
}