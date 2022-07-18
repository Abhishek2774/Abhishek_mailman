<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location:http://hestalabs.com/tse/Abhishek_mailman/index.php");
}
include "autoload.php";
$gobj = new Database();
$Reg_user_session_email = $_SESSION['email'];
$profile = $gobj->desh_profile('Reg_userid', $Reg_user_session_email); // fetch profile data
include 'header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>MailMan</title>
<style>
  .wrapper {
    width: 100%;
  }

  .sidebar {
    min-height: 790px;
    background: lightblue;
    width: 15%;
    float: left;
  }

  .sidebar li a {
    text-decoration: none;

    /* /* color: black; */
    /* box-sizing: border-box;
        display: block; */

  }

  .content {
    min-height: 500px;
    width: 85%;
    box-sizing: border-box;
    float: right;
  }

  .dropdown-menu {
    right: 0px !important;
    left: auto !important;
  }

  .footer {
    background: lightsalmon;
    clear: both;
    padding: 15px 10px;
    text-align: center;
  }
</style>
</head>

<body>
  <div class="wrapper">
    <div class="topnav">
      <nav class="navbar navbar-expand-sm bg-dark navbar-light py-4 static-top shadow ">
        <h3 style="color:white">MailMan</h3>
        <form class="form-inline mx-auto" id="search">
          <input type="text" class="form-control mr-sm-2 navbar-search" id="search" placeholder="Search">
        </form>
        <div class="profile">
          <p style="color: white" class="mr-sm-2 mt-3 pr-4 "><?php echo $profile['username']; ?></p>
        </div>

        <div class="btn-group">
          <img src="<?php echo $profile['image']; ?>" alt="not found" width="50" height="50" class="rounded-circle border border-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-lg" href="#one">Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="sidebar py-5">
      <ul>
        <li class="btn btn-warning flex"><button type="button" data-toggle="modal" data-target="#exampleModal">Compose</button></li>
        <li class="pt-4" id="inbox">Inbox</li>
        <li class="pt-2" id="sent">Sent</li>
        <li class="pt-2" id="draft">Draft</li>
        <li class="pt-2" id="trash">Trash</li>
      </ul>
    </div>

    <div class="content mt-5">
      <hr>
      <div class="card mx-5 flex">
        <div class="card-body flex">
          <div id="table-data">
            <table class="table table-hover flex>
            <thead>
              <tr>
                <th class=" col">
              <div class='d-flex m-2'>
                <input type="checkbox" id="checkall">
                <button type="button" style="display:none" class="btn btn-outline-primary read  btn-sm ml-3">Mark read</button>
                <button type="button" style="display:none" class="btn btn-outline-secondary unread btn-sm ml-2">Mark unread</button>
                <button type="button" style="display:none" class="btn btn-outline-success btn-sm del ml-2">Delete</button>
              </div>
              </th>
              <th scope="col"></th>
              <th scope="col">xyz@gmail.mailer.com</th>
              <th scope="col">Email Subject</th>
              <th scope="col">YY/MM/DD</th>
              <th scope="col"></th>
              </tr>
              </thead>
              <tbody id="load-table">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      MailMan@Mailer.com
    </div>

  </div>

  <!-- compose model -->
  <!-- Modal -->
  <div class="modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div id="form-data">
            <div class="card-header">
              New Message<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="card-body">
              <form enctype="multipart/form-data">
                <div id="error-data"></div>
                <span id="error_msg" style="display:none">Email has been Send</span>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">To <input type="text" id="toemail" name="toemail" class="border-0"></li>
                  <div class="text-danger" id="err_toemail"></div>
                  <li class="list-group-item">CC<input type="text" id="ccemail" name="ccemail" class="border-0"></li>
                  <li class="list-group-item">BCC<input type="text" id="bccemail" name="bccemail" class="border-0"></li>
                  <li class="list-group-item">Subject<input type="text" id="subject" name="subject" class="border-0"></li>
                  <li class="list-group-item"><textarea class="form-control border-0 " id="msg" name="msg" rows="10" placeholder="Message Body"></textarea></li>
                </ul>
            </div>
            <div class="card-footer">
              <div class="justify-content-between px-4 row">
                <label for="inputTag" class="py-2">+Attechments<input id="inputTag" type="file" style="display:none"></label>
                <button class="btn btn-primary px-2" id="btnsend">Send</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- profile model -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="card">
        <div class="card-header">
          Profile <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="row py-5">
            <div class="col-sm-8 order-1">
              <table class="table border">
                <tr>
                  <td>
                    <h4><?php echo $profile['fname']; ?></h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4><?php echo $profile['email']; ?></h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4><?php echo $profile['remail']; ?></h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4><?php echo $profile['username']; ?></h4>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-sm-4 order-2">
              <img src="<?php echo $profile['image']; ?>" width="150px" height="150px" class="rounded-circle border border-primary" alt="NOT found">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <a href="Edit_profile.php" class="pl-5">Edit Profile</a>
            <a href="new_password.php" class="pl-3">Change Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</html>
<!-- html End -->

<script>
  $(document).ready(function() {




    // click on any row get Id 

    // $(document).on("click", ".rowclick", function() {
    //   $("#load-table").html("");
    //   var trval = $(this).attr("data-id");
    //   // alert(trval);
    //   $.ajax({
    //     url: "show_email_one.php",
    //     type: "post",
    //     dataType: 'json',
    //     data: {
    //       id: trval
    //     },
    //     success: function(data) {
    //       if (data.status == false) {
    //         $("#load-table").html("<h3>" + data.msg + "</h3>");
    //       } else {
    //         var table;
    //         $.each(data, function(index, value) {
    //           table += '<div class="container">';
    //           table += '<div class="row">';
    //           table += '<div class="card w-100">';
    //           table += '<h5 class="card-header">' + value.subject + '</h5>';
    //           table += ' <div class="card-body ">';
    //           table += '<div class="row p-5">';
    //           table += '<div class="col-sm-4">';
    //           table += '<p>from:-' + value.sender_email + '</p>';
    //           table += '<p>To:-' + value.reciver_email + '</p>';
    //           table += '</div>';
    //           table += '<div class="col-sm-4"></div>';
    //           table += '<div class="col-sm-4">' + value.datetime + '</div>';
    //           table += '</div>';

    //           table += '<div class="row p-5">';
    //           table += '<div class="col-sm-4">';
    //           table += '<h4>' + value.attechment + '</h4>';
    //           table += '<p>hello.pnj</p>';
    //           table += '</div>';
    //           table += '<div class="col-sm-4"></div>';
    //           table += '<div class="col-sm-4"></div>';
    //           table += '</div>';

    //           table += '</div>';
    //           table += ' </div>';
    //           table += '</div>';
    //           table += '</div>';

    //         });

    //         $("#load-table").append(table);
    //       }
    //     }
    //   });

    // });



    $(document).on("click", ".check", function(e) {
      var isChecked = $(this).is(':checked');
      var check_id = $(this).attr("data-id");

      if (isChecked == true) {
        $(".del, .read, .unread").show();
        $(".del").click(function() {
          $.ajax({
            url: "Trash_email_by_sender.php",
            type: "post",
            data: {
              id: check_id
            },
            success: function(data) {
              document.location.reload();
            }
          });
        });

      } else {
        $(".del, .read, .unread").hide();
      }

    });


    $(document).on("click", ".check", function(e) {

      var isChecked = $(this).is(':checked');
      var check_id = $(this).attr("data-id");

      if (isChecked == true) {
        $(".del, .read, .unread").show();

        $(".del").click(function() {
          $.ajax({
            url: "Trash_email_by_reciver.php",
            type: "post",
            data: {
              id: check_id
            },
            success: function(data) {
              document.location.reload();
            }
          });
        });

      } else {
        $(".del, .read, .unread").hide();
      }

    });







    // Trash Email by Sender
    $(document).on("click", ".attrIdsender", function(e) {
      var id = $(this).attr("data-id");
      $.ajax({
        url: 'Trash_email_by_sender.php',
        type: 'post',
        data: {
          id: id
        },
        success: function(responce) {
          // alert("update");
          document.location.reload();
        }
      })
    });

    // Trash Email by Reciver

    $(document).on("click", ".attrIdreciver", function(e) {
      var id = $(this).attr("data-id");

      $.ajax({
        url: 'Trash_email_by_reciver.php',
        type: 'post',
        data: {
          id: id
        },
        success: function(responce) {
          // alert("update");
          document.location.reload();
        }
      })
    });

    // compose part to send Email....................start

    $("#toemail").on('change', function() {
      var toemail = $(this).val();
      $.ajax({
        url: "check_reciver.php",
        type: "post",
        dataType: "json",
        data: {
          reciver_email: toemail
        },
        success: function(data) {
          if (data.status) {
            $("#err_toemail").text("");
          } else {
            $("#err_toemail").text(data.msg);
          }

        }
      });
    });

    $("#btnsend").click(function() {
      event.preventDefault();
      var toemail = $("#toemail").val();
      var ccemail = $("#ccemail").val();
      var bccemail = $("#bccemail").val();
      var subject = $("#subject").val();
      var message = $("#msg").val();
      var file_data = $('#inputTag').prop('files')[0];
      var form_data = new FormData();

      form_data.append('file', file_data);
      form_data.append('tomaile', toemail);
      form_data.append('ccemaile', ccemail);
      form_data.append('bccmaile', bccemail);
      form_data.append('subject', subject);
      form_data.append('msg', message);


      if (toemail == '') {
        alert("Email-Id is required");
        return false;
      }
      if (IsEmail(toemail) == false) {
        alert("Email-Id is Invalid");
        return false;
      }
      if (subject == '') {
        alert("Subject is required");
        return false;
      }
      if (msg == '') {
        alert("msg is required");
        return false;
      }

      $.ajax({
        url: "inbox_mail_send.php",
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        success: function(data) {
          $("#error_msg").show();
          $("#form-data").trigger("reset");
          setTimeout(function() {
            $(".card").hide();
            $('.modal-backdrop').removeClass();
            document.location.reload();
          }, 2000);
          sendbuttonload();
        }

      });
    });
    // Compose Email.................End


    // inbox Email coding........................Start

    function Inboxemail(page) {
      $("#load-table").html("");
      $.ajax({
        url: "inbox_fetch_mails.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $("#load-table").html(data);
        }
      });
    }
    // click on inbox button 

    $("#inbox").click(function() {
      Inboxemail();
      $(document).on("click", "#pagination a", function(e) {
        event.preventDefault();
        var page_id = $(this).attr("id");
        Inboxemail(page_id);
      });
    });

    // Inbox Email Coding..................End

    // Send Email coding...................................Start
    function sendbuttonload(page) {
      $("#load-table").html("");
      $.ajax({
        url: "fetch_send_emails.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $("#load-table").html(data);
        }
      });
    }

    $("#sent").click(function() {
      sendbuttonload();
      $(document).on("click", "#pagination a", function(e) {
        event.preventDefault();
        var page_id = $(this).attr("id");
        sendbuttonload(page_id);
      });
    });
    // Send Email Coding................End

    // draft Email coding................................Start

    $("#draft").click(function() {
      alert("draft click");
    });

    // draft Email coding................................End
    $(".close").click(function() {
      event.preventDefault();
      var toemail = $("#toemail").val();
      var ccemail = $("#ccemail").val();
      var bccemail = $("#bccemail").val();
      var subject = $("#subject").val();
      var message = $("#msg").val();
      var file_data = $('#inputTag').prop('files')[0];
      var form_data = new FormData();

      form_data.append('file', file_data);
      form_data.append('tomaile', toemail);
      form_data.append('ccemaile', ccemail);
      form_data.append('bccmaile', bccemail);
      form_data.append('subject', subject);
      form_data.append('msg', message);

      if (toemail == '' || ccemail == '' || bccemail == '' || subject == '' || message == '') {

        //  $(".card").hide();
        // $('.modal-backdrop').removeClass();

      } else {

      }




      $.ajax({
        url: "draft_message.php",
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        success: function(responce) {

        }

      });

    });



    //Trash Email fetch ......................................... Start

    $("#trash").click(function() {
      $("#load-table").html("");
      $.ajax({
        url: "fetch_trash_data.php",
        type: "POST",
        dataType: 'JSON',
        success: function(data) {
          if (data.status == false) {
            $("#load-table").append("<tr><td><h3>Data Not Found</h3></td></tr>");
          } else {
            $.each(data, function(key, value) {
              $("#load-table").append("<tr><td><input type='checkbox' class='table-check' value='check'></td><td>" + value.reciver_email + "</td><td>" + value.subject + "</td><td>" + value.datetime + "</td></tr>");
            });


          }
        }
      });

    });




    //demo click on checkbox of lable

    $(document).on("click", ".table-check", function() {
      var check = $(this).val();
      alert(check);

    });

    //Trash Email coding.........................................End


    // Searching Email Coding...............................................Start

    $(".navbar-search").on("keyup", function() {
      var search_term = $(this).val();
      $.ajax({
        url: "live_search.php",
        type: "POST",
        data: {
          search: search_term
        },
        success: function(data) {
          $("#load-table").html(data);
        }
      });
    });

  });
  // Searching Email Coding...............................................End

  // Check Emails Validate or not function ......................................Start

  function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
      return false;
    } else {
      return true;
    }
  }
  // Check Emails Validate or not function ......................................End
</script>