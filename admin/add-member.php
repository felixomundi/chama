<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
header('location: login.php');
}else {
    if (isset($_POST['signup'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        
        $town = $_POST['town'];
        $contact = $_POST['contact'];
        $password = md5($_POST['password']);
        $status = 1;

        $sql = "INSERT INTO users(`fname`,`lname`,`email`,`password`,`status`,`town`,`contact`) VALUES(:fname,:lname,:email,:password,:status,:town,:contact)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);        
        $query->bindParam(':town', $town, PDO::PARAM_STR);
        $query->bindParam(':contact', $contact, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Member Registered successfully');document.location = 'members.php'</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Register member</title>

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check-availability.php",
                    data: 'email=' + $("#email").val(),
                    type: "POST",
                    success: function (data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {
                    }
                });
            }
        </script>

        <script type="text/javascript">
            function valid() {
                if (document.signup.password.value !== document.signup.passwordrepeat.value) {
                    alert("Password and Repeat Password field didn\'t match!!");
                    document.signup.passwordrepeat.focus();
                    return false;
                }
                return true;
            }
        </script>

        <script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check-availability.php",
                    data: 'email=' + $("#email").val(),
                    type: "POST",
                    success: function (data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {
                    }
                });
            }
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                function disablePrev() {
                    window.history.forward();
                }

                window.onload = disablePrev();
                window.onpageshow = function (evt) {
                    if (evt.persisted) disableBack()
                }
            });
        </script>

        <script type="text/javascript">
            var checkPass = function () {
                var password = document.getElementById('password').value;
                var repassword = document.getElementById('confirm_password').value;
                var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
                if (password !== "" || password !== null) {
                    if (password.match(regexpass)) {
                        document.getElementById('checkpass').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                        if (password === repassword) {
                            document.getElementById('message').style.color = 'green';
                            document.getElementById('message').innerHTML = 'password matched';
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('message').style.color = 'red';
                            document.getElementById('message').innerHTML = 'password not matching';
                            document.getElementById('submit').disabled = true;
                        }
                    } else {
                        document.getElementById('checkpass').innerHTML = 'Minimum len 8 & max len 12 where 1 uppercase & 1 digit mandatory';
                        document.getElementById('submit').disabled = true;
                    }
                } else {
                    document.getElementById('checkpass').innerHTML = 'Empty password';
                    document.getElementById('submit').disabled = true;
                }
            };

            var checkfname = function () {
                var fname = document.getElementById('fname').value;
                var fnamevalidation = /^[a-zA-Z ]{2,30}$/;

                if (fname === "" || fname === null || !fname.match(fnamevalidation) || fname.length < 2 || fname.length > 30) {
                    document.getElementById('checkfname').style.color = 'red';
                    document.getElementById('checkfname').innerHTML = 'invalid surname';
                    document.getElementById('submit').disabled = true;
                } else {
                    //var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
                    if (fname.match(fnamevalidation)) {
                        //document.getElementById('checkfname').style.color = 'green';
                        document.getElementById('checkfname').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                    }
                }
            };

            var checklname = function () {
                var lname = document.getElementById('lname').value;
                var lnamevalidation = /^[a-zA-Z]{2,50}$/;

                if (lname === "" || lname === null || !lname.match(lnamevalidation) || lname.length < 2 || lname.length > 15) {
                    document.getElementById('checklname').style.color = 'red';
                    document.getElementById('checklname').innerHTML = '';
                    document.getElementById('submit').disabled = true;
                } else {
                    //var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
                    if (lname.match(lnamevalidation)) {
                        //document.getElementById('checklname').style.color = 'green';
                        document.getElementById('checklname').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                    }
                }
            };

        </script>

        <script>
            function validate() {
                var fname = document.signup.fname.value;
                var lname = document.signup.lname.value;
                var email = document.signup.email.value;
                var pass = document.signup.password.value;
                var repass = document.signup.passwordrepeat.value;

                if (fname === "" || fname === null) {
                    document.getElementById('checkfname').innerHTML = 'Invalid Surname';
                    return false;
                }
                if (lname === "" || lname === null) {
                    document.getElementById('checklname').innerHTML = '';
                    return false;
                }
                if (email === "" || email === null) {
                    //document.getElementById('checkemail').innerHTML = 'Enter your email address';
                    return false;
                }
                if (pass === "" || pass === null) {
                    document.getElementById('checkpass').innerHTML = 'Invalid password';
                    return false;
                }
            }
        </script>

    </head>

    <body class="sb-nav-fixed">
    <div id="layoutSidenav">

    <?php include('includes/header.php');?>

<?php include('includes/sidebar.php');?>


            <div id="layoutSidenav_content" id="content-wrapper">
                <main>
                <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register New Member</h3></div>
                                    <div class="card-body">
                                <form class="user" method="post" name="signup" onsubmit="return validate();"
                                      novalidate>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="fname"
                                                   placeholder="First Name" name="fname" autocomplete="off"
                                                   onkeyup="checkfname();">
                                            <span id="checkfname" style="font-size:12px; color: red;"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text" id="lname"
                                                   placeholder="Other Names" name="lname" autocomplete="off"
                                                   onkeyup="checklname();">
                                            <span id="checklname" style="font-size:12px; color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                   
                                        <input class="form-control form-control-user" type="number" required="true" autocomplete="off"
                                               placeholder="Contact" name="contact" >
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="email" id="email"
                                               aria-describedby="emailHelp" autocomplete="off"
                                               placeholder="Email Address" name="email" onBlur="checkAvailability();">
                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                        <span id="checkemail" style="font-size:12px; color: red;"></span>
                                    </div>
                                    <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text"
                                                   placeholder="DOB" required="true" name="dob" required="true" autocomplete="off"
                                                  >
                                            
        </div>

                                  </div>
                                  <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" 
                                                   placeholder="Town" required="true" autocomplete="off" name="town"
                                                   >
                                            
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text"
                                                 autocomplete="off" 
                                                   placeholder="Address" required="true"  name="address">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="password" id="password"
                                                   placeholder="Password" autocomplete="off" name="password"
                                                   onkeyup="checkPass();">
                                            <span id="checkpass" style="font-size:12px; color: red;"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="password"
                                                   id="confirm_password" autocomplete="off" onkeyup='checkPass();'
                                                   placeholder="Repeat Password" name="passwordrepeat">
                                            <span id='message'></span>
                                            <span id="checkrepass" style="font-size:12px; color: red;"></span>
                                        </div>
                                    </div>
                                    

                                    <button class="btn btn-danger btn-block text-white btn-user" type="submit"
                                            name="signup" id="submit">Register Account
                                    </button>
                                    <hr>
                                </form>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                               
                               
                                
                                </main>


</div>
</div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    </html>
<?php } ?>