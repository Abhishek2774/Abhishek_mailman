
['user'=>'$uname,'email'=>'abhi@gmail.com','fname'=>'abhi','lname'=>'kumar','pass'=>'abhi123','cpass'=>'abhi@123','dob'=>'2001-07-10','image'=>'aa.jpg','semail'=>'rohit@gamil','t_condition'=>'on']

// registration form 

<div class="container">
    <div class="model">
        <h1>Ragistration Here</h1>
   <form action="#" method="POST">

    <div class="row">
            <div class="col-6">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="uname" required="true">
                    </div>
             </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required="true">
                    </div>
                </div>
</div>
     <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" class="form-control" name="fname" required="true"> 
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" class="form-control" name="lname" required="true">
            </div>
        </div>
</div>
  <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="pass" required="true">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Confirm password</label>
                <input type="text" class="form-control" name="cpass" required="true">
            </div>
        </div>
</div>
<div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">D.O.B</label>
                <input type="date" class="form-control" name="dob" required="true">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Profile</label>
                <input type="file" class="form-control" name="file" >
            </div>
        </div>
</div>
<div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Secondry Email</label>
                <input type="text" class="form-control" name="semail" required="true">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <div class="box">
                    <input name="checkbox" type="checkbox"/ required="true">
                    <label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>
                </div>
        </div>
        </div>
 </div>
 <div class="row">
        <div class="col-6">
            <div class="form-group">
                   <input type="submit" name="submit" class="btn btn-primary" style="float:right">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                  <a href="login.php">Login</a>
            </div>
        </div>
        </div>
    </div>
   </form>
    </div>
    </div>

    // ajax jquery 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    // associate array
    //  $data = [
    //         'fname' => $_POST["fname"],
    //         'lname' => $_POST["lname"],
    //         'username' => $_POST["username"],
    //         'email' => $_POST["email"],
    //         'remail' => $_POST["remail"],
    //         'remail' => $_POST["remail"],
    //         'pass' => $_POST["pass"],
    //         'cpass' => $_files["cpass"],
    //         'checkbox' => $_POST["checkbox"]
            
    //     ];
        

    <div class="topnav">
    <nav class="navbar navbar-expand-sm bg-dark navbar-light py-4 static-top shadow ">
        <h3 style="color:white">MailMan</h3>
        <form class="form-inline mx-auto" id="search" >
        <input class="form-control mr-sm-2 navbar-search" type="text" placeholder="Search">
        </form>
        <div class="profile">
        <p  style="color: white" class="mr-sm-2 mt-3 pr-4 ">Abhi</p>
        </div>
        <img src="image/login.jpeg" alt="not found" width="50" height="50" class="rounded-circle border border-warning">
    </nav>
</div>


    ?>
    echo json_encode(array("msg"=> "data are not fatch", "status"=> false));


    //
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
            array_push($result, "Email is required ");
            }elseif(Validate::is_email($remail)){
            array_push($result,"Invalide Email");
            }elseif(Validate::is_valid_password($pass)){
                array_push($result, " Password should be at least 8 characters in <br> length and should include at least one upper case letter,<br> one number, and one special character.';");
            }elseif(Validate::ic_conf_pass($pass,$cpass)){
                array_push($result,"Password are not Match");
            }elseif(Validate::is_profile($image)){
                array_push($result, "Only PNG and JPG are allowed. <br> and size shuld not be exceeds 2MB");
            }elseif(Validate::check($checkbox)){
                array_push($result,"Please click on checkBox");
            }else{
                // call here to insert data in database
            }
            
         }


    if(Validate::required($email) || Validate::is_email($email)){
        array_push($result, "Email is required && Invalide Email");
        }else{
        echo $email = $_POST['email'];
        }
        
    if(Validate::required($fname) || Validate::is_alphanum($fname)){
        array_push($result, "name is required & shuld be alphabetic");   
    }else{
        echo $fname = $_POST['fname'];
    }
    if(Validate::required($lname) || Validate::is_alphanum($lname)){
        array_push($result, "last name is required & shuld be alphabetic");
    }else{
        echo $lname = $_POST['lname'];
    }
    if(Validate::is_alphanum($username) || Validate::required($username) || Validate::requiredis_specil_ch($username)){
        array_push($result, " username is required & shuld be alphabetic No specila Charecter allowed");
    }else{
        echo $username = $_POST['username'];
    }


    //
    // $data = [
        //             'fname' => $_POST["fname"],
        //             'lname' => $_POST["lname"],
        //             'username' => $_POST["username"],
        //             'email' => $_POST["email"],
        //             'remail' => $_POST["remail"],
        //             'remail' => $_POST["remail"],
        //             'pass' => $_POST["pass"],
        //             'cpass' => $_files["cpass"],
        //             'checkbox' => $_POST["checkbox"]
                    
        //         ];

                // echo "<pre>";
                // print_r($data);

                // if($gobj->fetch_email('Reg_user',$email)){
                //     $result = $gobj->getResult();
                //     }



                /////////////

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
                        if($result = $gobj->getResult()){
        
                        }
                
                    }

                    if($gobj->fetch_email('Reg_userid',$email)){
                        $result = $gobj->getResult();
                 }else{
            
                    echo "okk";   
            
                 } 
                

                 /////////
                 include "autoload.php";
$gobj = new Database();
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
      echo $email = $_POST['email'];
     }
}

/////////////
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

///////////////////
event.preventDefault();
      var toemail = $("#toemail").val();
      var subject = $("#subject").val();
      var msg = $("#msg").val();

      if(IsEmail(toemail)==false){
                alert("invalid Email");
                return false;
            }

            ?>

............................
fetch data from dbms and show 

// loadtable();

// function loadtable() {
//   $("#load-table").html("");
//   $.ajax({
//     url: "http://localhost/mailman/fetch_data_table.php",
//     type: "GET",
//     success: function(data) {
//       if (data.status == false) {
//         $("#load-table").append("<tr><td><h3>Data Not Found</h3></td></tr>");
//       } else {
//         $.each(data, function(key, value) {
//           $("#load-table").append("<tr><td><input type='checkbox'></td><td>" + value.reciver_email + "</td><td>" + value.subject + "</td><td>" + value.datetime + "</td></tr>");
//         });

//       }
//     }
//   });

// }
......................................
<?php foreach($result as $item){ echo $item; }?>

..........................................................................................

// ajax pagination...............start

// function paginationload(page) {
//   $("#load-table").html("");
//   $.ajax({
//     url: "ajax_pagination.php",
//     type: "POST",
//     data: {
//       page_no: page
//     },
//     success: function(data) {
//       $("#load-table").html(data);
//     }
//   });
// }
// paginationload();
// $(document).on("click", "#pagination a", function(e) {
//   event.preventDefault();
//   var page_id = $(this).attr("id");
//   paginationload(page_id);
// });
//ajax pagination......................End

...................................................  
echo   $fname = $_POST['fname'];
      echo    $lname = $_POST['lname'];
      echo   $remail= $_POST['remail'];
        $image = $_FILES['file'];
print_r($image);

.................................. 
select * from All_emails 
where ((sender_status=0 and reciver_status=1) or (sender_status=1 and reciver_status=0)or (sender_status=0 and reciver_status=0)) and sender_email="abhihesta@mailman.com"

.......................................... 
$(".del").click(function(){
        $.ajax({
            url : "Trash_email_by_reciver.php",
            type:"post",
            data:{id : check_id},
            dataType: "json",
            success:function(data){
              document.location.reload();
            }
        });
    });

    ........................................... 
    <div class="container">
  <h2>Panel Heading</h2>
  <div class="panel panel-default">
    <div class="panel-heading">Panel Heading</div>
    <div class="panel-body">Panel Content</div>
  </div>
</div>