<?php 
include 'header.php';
include "autoload.php";
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
<div class="container">
    <div class="modelf">
        <h4>MailMan</h4>
        <hr>
        <form action="mail.php" method="post">
        <div class="row">
            <div class="col-sm-8">
                <p>Enter your Registerd Email-id</p>
                <input type="email" class="form-control" name="email" placeholder="xyx@gmail.com">
                <div class="row">
                <a class="m-2" href="index.php">Back to Login</a>
                <input type="submit" name="submit" class="btn btn-primary m-2">
                </div>
            </div>
            <div class="col-sm-4">
            <img src="image/login.jpeg" alt="not found" style="height:120px", width="120px">
            </div>
        </div>
        </form>
    </div>
</div>
</body>
</html>