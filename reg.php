<?php 
include 'header.php';
include "autoload.php";
$gobj = new Database();

// create variable for store data
        $image = $_FILES['image'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $remail = $_POST['remail'];

        $pass= $_POST['pass'];
        $cpass = $_POST['cpass'];
        $image = $_FILES['image'];
        $checkbox = $_POST['checkbox'];
        
        
//create array for store all error 
$result = array();

if(isset($_POST['submit'])){

//check  validation of form 

   if(Validate::required($fname)){
        array_push($result, "First name is required");
    }elseif(Validate::is_alphanum($fname)){
        array_push($result, " First name shuld be alphabetic");
    }elseif(Validate::required($lname)){
        array_push($result, "last name is required");
    }elseif(Validate::is_alphanum($lname)){
        array_push($result, " Last name shuld be alphabetic");
    }elseif(Validate::required($username)){
        array_push($result, "username is required");
    }elseif(Validate::is_alphanum($username)){
    array_push($result, " username name shuld be alphabetic");
    } elseif(Validate::required($email)){
        array_push($result, "Email is required ");
    }elseif(Validate::is_email($email)){
        array_push($result,"Invalide Email");
    }elseif(Validate::required($remail)){
    array_push($result, "Recovery Email is required ");
    }elseif(Validate::is_email($remail)){
    array_push($result,"Invalide Email");
    }elseif(Validate::is_valid_password($pass)){
        array_push($result, " Password should be at least 8 characters in <br> length and should include at least one upper case letter,<br> one number, and one special character.';");
    }elseif(Validate::ic_conf_pass($pass,$cpass)){
        array_push($result,"Password are not Match");
    }elseif(Validate::is_profile($image)){
        array_push($result, "Only PNG and JPG are allowed. <br> and size shuld not be exceeds 2MB");
    }elseif($gobj->fetch_email('Reg_userid',$email)){
            $result = $gobj->getResult();
    }else{
       
        $target_dir = "upload/";
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
                echo "<script>
                alert('Your are Ragisterd Successfully');
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
    <title>MailMan</title>
</head>
<body>
    <div class="conatiner">
        <div class="modelf">
            <h4>MailMan</h4>
            <?php foreach($result as $item){
                echo $item."<br>";
                }?>
            <hr>
            <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8 order-1">
                    <input type="text" name="fname" id="fname" class="form-control mt-2"  placeholder="Enter your First Name" >
                    <input type="text" name="lname" id="lname" class="form-control mt-2"  placeholder="Enter your last Name" >
                    <input type="text" name="username" id="username" class="form-control mt-2"  placeholder="Enter username" >
                    <input type="email" name="email" id="email" class="form-control mt-2" placeholder="Enter your Email" >
                    <input type="email" name="remail" id="remail" class="form-control mt-2" placeholder="Enter your Recovery Email" > 
                    <input type="text" name="pass" id="pass" class="form-control mt-2" placeholder="Enter your password" >
                    <input type="text" name="cpass" id="cpass" class="form-control mt-2" placeholder="Confirm password" >
                    <div class="box">
                    <input name="checkbox" id="checkbox" type="checkbox" class="mt-2">
                    <label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit"  class="btn btn-primary m-2">
                       <a  class="btn btn-primary m-2" href="index.php">Sign-in-Instead</a>
                    </div>
                </div>
                <div class="col-md-4 order-2">
                    <img src="image/login.jpeg"  alt="not found" style="height:120px", width="120px">
                    <input type="file" id="file" name="image">
                </div>
            </div>
            </form>
        </div>
        
    </div>
</body>
</html>