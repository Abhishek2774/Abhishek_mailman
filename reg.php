<?php include 'header.php'; ?>
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
            <hr>
            <form method="post" enctype="multipart/form-data">
            <!-- <div id="error_message" class="ajax_response" style="float:left"></div> -->
	        <div id="success_message" class="ajax_response"></div>
                <div class="row">
                    <div class="col-md-8 order-1">
                        <input type="text" name="fname" id="fname" class="form-control mt-2" placeholder="Enter your First Name">
                        <span id='f_error' class="text-danger"></span>
                        <input type="text" name="lname" id="lname" class="form-control mt-2" placeholder="Enter your last Name">
                        <span id='l_error' class="text-danger"></span>
                        <input type="text" name="username" id="username" class="form-control mt-2" placeholder="Enter username">
                        <span id='user_error' class="text-danger"></span>
                        <input type="email" name="email" id="email" class="form-control mt-2" placeholder="Enter your Email">
                        <span id='email_error' class="text-danger"></span>
                        <input type="email" name="remail" id="remail" class="form-control mt-2" placeholder="Enter your Recovery Email">
                        <span id='remail_error' class="text-danger"></span>
                        <input type="password" name="pass" id="pass" class="form-control mt-2" placeholder="Enter your password">
                        <span id='pass_error' class="text-danger"></span>
                        <input type="password" name="cpass" id="cpass" class="form-control mt-2" placeholder="Confirm password">
                        <span id='cpass_error' class="text-danger"></span>
                        <div class="box">
                            <input name="checkbox" id="checkbox" type="checkbox" class="mt-2">
                            <span id='check_error'></span>
                            <label for="error_checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>
                        </div>
                        <div class="row">
                            <input type="submit" name="submit" id="regbtn" class="btn btn-primary m-2">
                            <a class="btn btn-primary m-2" href="index.php">Sign-in-Instead</a>
                        </div>
                    </div>
                    <div class="col-md-4 order-2">
                        <img src="image/login.jpeg" alt="not found" style="height:120px" , width="120px">
                        <input type="file" id="inputTag" name="image">
                        <span id='img_error' class="text-danger"></span>
                    </div>
                </div>
            </form>
        </div>

    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#regbtn").click(function(e) {
            e.preventDefault();
            $("#email").on("blur", function() {
                var email_id = $(this).val();
                // alert(email_id);
                $.ajax({
                    url: "check_email.php",
                    dataType: "json",
                    type: "post",
                    data: {
                        id: email_id
                    },
                    success: function(data) {
                        if (data.status == true) {
                            $("#email_error").html(data.msg);
                        } else {
                            $("#email_error").html("");
                        }
                    }
                });
            });

            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var username = $("#username").val();
            var email = $("#email").val();
            var remail = $("#remail").val();
            var pass = $("#pass").val();
            var cpass = $("#cpass").val();
            var checkbox = $("#checkbox").val();

            var file_data = $('#inputTag').prop('files')[0];
            var form_data = new FormData();

            form_data.append('fname', fname);
            form_data.append('lname', lname);
            form_data.append('username', username);
            form_data.append('email', email);
            form_data.append('remail', remail);
            form_data.append('pass', pass);
            form_data.append('cpass', cpass);
            form_data.append('checkbox', checkbox);
            form_data.append('image', file_data);

            let isChecked = $('#checkbox')[0].checked;
            if (isChecked == false) {
                // console.log("hello abhi");
                $("#check_error").html('<p class="text-danger">please checked</p>');
            } else {
                $("#check_error").html("");

            }

            $.ajax({
                url: "http://hestalabs.com/tse/Abhishek_mailman/reg_user.php",
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: form_data,
                type: "post",
                success: function(data) {
                    // console.log(data);

                    if(data.status == true && data.type== "user_registered"){
                        $("#f_error").html('');
                        $("#l_error").html('');
                        $("#img_error").html('');
                        $("#success_message").html('');
                        $("#success_message").html(data.message);
                    }

                    if(data.type == "form_error"){
                        $.each(data, function(index, value) {
                            console.log(index + "-" + value);
                            $("#" + index).text(value);
                        });
                    }
                   
                   
                   
                


                }

            });
        });

    });
</script>