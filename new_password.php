<?php
session_start();
include 'header.php';
include "autoload.php";
$gobj = new Database();

$login_Email = $_SESSION['login_user_Email'];
$newpass = $_POST['newpass'];
$cpass  = $_POST['cpass'];

$data = [
    'login'=>$login_Email,
    'pass' => $newpass,
    'cpass' => $cpass 

];

if (isset($_POST['submit'])) {
    if (Validate::required($newpass)) {
        echo "<script> alert('New Password field are Required');</script>";
    } elseif (validate::ic_conf_pass($newpass, $cpass)) {
        echo "<script> alert('Confirm password are not match');</script>";
    } elseif (Validate::is_valid_password($newpass)) {
        echo "<script> alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character');
        </script>";
    }else{
        // print_r($data);
        if ($gobj->reset_password('Reg_userid', $data)) {
            echo "<script>
            alert('Your Password successfully Update');
            window.location.href='http://localhost/mailman/index.php';
            </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailman</title>
</head>
<body>
    <div class="container my-5">
        <div class="row border">
            <div class="col-md-8 py-5">
                <img src="image/keys.jpeg" alt="not found">
            </div>
            <div class="col-md-4 py-5">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="text" name="newpass" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="text" name="cpass" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Reset">
                </div>
            </form>
            </div>
            
        </div>
    </div>
</body>

</html>