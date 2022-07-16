<?php
session_start();
 include "autoload.php";
 $gobj = new Database();

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

 $result_error= array();
 if(isset($_POST['submit'])){
      $email = $_POST['email'];
      if(Validate::required($email)){
         echo "<script>
                 alert('Email is required');
                 window.location.href='http://localhost/mailman/forgat.php';
                 </script>";  
      }elseif(Validate::is_email($email)){
         echo "<script>
         alert('Invalid Email');
         window.location.href='http://localhost/mailman/forgat.php';
         </script>";  
      }else{

         $email_id = $_POST['email'];
         $_SESSION['email_id'] = $email_id; // jis Email-id s user registered h use Email-id k session banaya h
     
         $mail = new PHPMailer(true);

        try {
        
                        
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'abhihesta@gmail.com';                    
            $mail->Password   = 'cnqtpjgukjpdxuuw';           // create webapp in gmail and get password and use here                   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    

        
            $mail->setFrom('abhishek@gmail.com', 'hestabit pvt ltd');

            $mail->addAddress($email_id);    // to email placeholder       


            $mail->isHTML(true);                                 
            $mail->Subject = 'Forgat password Link';
            $mail->Body    = 'Click on This URL:-http://localhost/mailman/new_password.php';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo "<script>
            alert('Email has been sent Your Registerd Email id');
            </script>"; 
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
            }
        }






?>