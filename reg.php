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
                        <input type="email" name="email" id="email" class="form-control mt-2" placeholder="abc@mailman.com">
                        <span id='email_error' class="text-danger"></span>
                        <input type="email" name="remail" id="remail" class="form-control mt-2" placeholder="Recovery Email Id">
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
                            <div class="col-md-6">
                            <input type="submit" name="submit" id="regbtn" class="btn btn-primary  m-2">
                            </div>
                            <div class="col-md-6">
                                <div id="spinner" class="text-primary"></div>
                                    <a id="cheked" class="btn btn-primary m-2 " href="index.php">Sign-in-Instead</a>
                                </div>
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

            var error = 0;

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
            form_data.append('cpass', cpass)
            form_data.append('checkbox', checkbox);
            form_data.append('image', file_data);

           


            var namereg = /^[A-Za-z]+$/;
            if (fname == '' || fname == null) {
                error++;
                $('#f_error').text('First name is required.');
            } else if (!namereg.test(fname)) {
                error++;
                $('#f_error').text('Only latter are Allowed');
            } else {
                $('#f_error').text('');
            }
            var lnamereg =  /^[A-Za-z]+$/;
            if(lname == '' ||  lname== null){
                error++;
                $("#l_error").text("Last name is Required");
            }else if(!lnamereg.test(lname)){
                error++;
                    $("#l_error").text("Only latter are Allowed");
            }else {
                $('#l_error').text('');
            }
            if(username == '' || username== null){
                error++;
                $("#user_error").text("Username is Required");
            }else if(username){
                $.ajax({
                    url: "check_email_username.php",
                    dataType: "json",
                    type: "post",
                    data: {
                        username: username
                    },
                    success: function(data) {
                        if (data.status == true) {
                            error++;
                            $("#user_error").html(data.msg);
                        } else {
                            $("#user_error").html("");
                        }
                    }
                });
            }
           
      var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (email == '' || email == null) {
        error++;
        $('#email_error').text('Email is required');
      } else if (!emailRegex.test(email)) {
        error++;
        $('#email_error').text('Enter Valid email id');
      } else if(email){
                $.ajax({
                    url: "check_email_username.php",
                    dataType: "json",
                    type: "post",
                    data: {
                        id: email
                    },
                    success: function(data) {
                        if (data.status == true) {
                            error++;
                            $("#email_error").html(data.msg);
                        } else {
                            $("#email_error").html("");
                        }
                    }
                });
            }

            var RecoveremailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (remail == '' || remail == null) {
                error++;
                $('#remail_error').text('Recovery Email is required');
            } else if (!RecoveremailRegex.test(email)) {
                error++;
                $('#remail_error').text('Enter Valid  Recover email id');
            } else {
                $('#remail_error').text('');

            }

          var passRegex =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{6,}/;
          if (pass == '' || pass == null) {
                error++;
                $('#pass_error').text('Password is required');
            } else if (!passRegex.test(pass)) {
                error++;
                $('#pass_error').text('Invalide Password');
            } else {
                $('#pass_error').text('');

            }

            if(cpass == '' || cpass== null){
                error++;
                $("#cpass_error").text('Confirmed password are Required');
            }else if(cpass != pass){
                error++;
                $("#cpass_error").text('Confirmed password are not match');
            }else{
                $("#cpass_error").text('');
            }

             let isChecked = $('#checkbox')[0].checked;
            if (isChecked == false) {
                error++;
                $("#check_error").html('<p class="text-danger">please checked</p>');
            } else {
                $("#check_error").html("");

            }
          


            //  if (error > 0) {
            //     return false;
            //  }


            // $.ajax({
            //     url: "reg_user.php",
            //     // dataType: "JSON",
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     dataType: "json",
            //     data: form_data,
            //     type: "post",
            //     success: function(data) {
            //         // console.log(data);

            //         if(data.status == true && data.type== "user_registered"){
            //             $("#f_error").html('');
            //             $("#l_error").html('');
            //             $("#img_error").html('');
            //             $("#success_message").html('');
            //             $("#success_message").html(data.message);
            //         }

            //         if(data.type == "form_error"){
            //             $.each(data, function(index, value) {
            //                 console.log(index + "-" + value);
            //                 $("#" + index).text(value);
            //             });
            //         }






            //     }

            // });
        });

    });
</script>