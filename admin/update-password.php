<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);

        $email = $_SESSION['alogin'];

        $sql = "SELECT `password` FROM `admin` WHERE email=:email AND password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "UPDATE `admin` SET password=:newpassword WHERE email=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>alert('Your password has successfully updated')</script>";
        } else {
            echo "<script>alert('Your current password is not correct')</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>n">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SMS</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
                    alert("New password and Confirm password field didn\'t match!!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>

        <script>
            var checkPass = function () {
                var password = document.getElementById('newpass').value;
                var repassword = document.getElementById('confirmpass').value;
                var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
                if (password !== "" || password !== null) {
                    if (password.match(regexpass)) {
                        document.getElementById('newpassmsg').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                        if (password === repassword) {
                            document.getElementById('confirmpassmsg').style.color = 'green';
                            document.getElementById('confirmpassmsg').innerHTML = 'password matched';
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('confirmpassmsg').style.color = 'red';
                            document.getElementById('confirmpassmsg').innerHTML = 'password not matching';
                            document.getElementById('submit').disabled = true;
                        }
                    } else {
                        document.getElementById('newpassmsg').innerHTML = 'Minimum len 8 & max len 12';
                        document.getElementById('submit').disabled = true;
                    }
                } else {
                    document.getElementById('newpassmsg').innerHTML = 'Empty password';
                    document.getElementById('submit').disabled = true;
                }
            };
        </script>

        <script>
            function validate() {
                var currentpass = document.chngpwd.password.value;
                var newpass = document.chngpwd.newpassword.value;
                var confirmpass = document.chngpwd.confirmpassword.value;

                if (currentpass === "" || currentpass === null) {
                    document.getElementById('passmsg').style.color = 'red';
                    document.getElementById('passmsg').innerHTML = 'Invalid current password';
                    return false;
                }
                if (newpass === "" || newpass === null) {
                    document.getElementById('newpassmsg').innerHTML = 'Invalid new password';
                    return false;
                }
                if (confirmpass === "" || confirmpass === null) {
                    document.getElementById('confirmpassmsg').innerHTML = 'Invalid confirm password';
                    return false;
                }
            }
        </script>

    </head>

    <body class="sb-nav-fixed">
        <div id="layoutSidenav">

        <?php include('includes/header.php');?>

<?php include('includes/sidebar.php');?>



            <div id="layoutSidenav_content">
                
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Password</h3></div>
                                    <div class="card-body">
                                                <form method="post" name="chngpwd" onSubmit="return validate();"
                                                      novalidate>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="pass"><strong>Current
                                                                                          Password</strong></label>
                                                                <input class="form-control" id="pass" type="password"
                                                                       name="password" autocomplete="off" required>
                                                                <span id="passmsg" style="font-size: 12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="newpass"><strong>New
                                                                                             Password</strong></label>
                                                                <input class="form-control" id="newpass" type="password"
                                                                       name="newpassword" autocomplete="off"
                                                                       onkeyup="checkPass();" required>
                                                                <span id="newpassmsg" style="font-size: 12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="confirmpass"><strong>Confirm
                                                                                                 Password</strong></label>
                                                                <input class="form-control" id="confirmpass" type="password"
                                                                       name="confirmpassword" autocomplete="off"
                                                                       onkeyup="checkPass();" required>
                                                                <span id="confirmpassmsg"
                                                                      style="font-size: 12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="submit">Update
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            


</div>
</div>
</div>
</div>
</div>
</main>
</div>
</div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
                
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    </body>

    </html>
<?php } ?>