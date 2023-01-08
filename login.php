<?php
session_start();
include('includes/config.php');
if (!empty($_SESSION['login'])) {
    header("location: index.php");
} else {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT email,password FROM users WHERE email=:email and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $_SESSION['login'] = $_POST['email'];
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SMS</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


        <script type="text/javascript">
            function validate() {
                let email = document.userlogin.email.value;
                let pass = document.userlogin.password.value;
                if (email === "" || email === null && pass === "" || pass === null) {
                    //alert("Please provide your email and password");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                    //document.userlogin.password.focus() ;
                    return false;
                }
                if (email === "" || email === null) {
                    //alert("Please provide your email");
                    document.getElementById('emailcheck').innerHTML = 'Enter your email address';
                    document.userlogin.email.focus();
                    return false;
                } else {
                    var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (email.match(mailformat)) {
                        if (pass === "" || pass === null) {
                            //alert("Please provide your password");
                            document.getElementById('passwordcheck').innerHTML = 'Enter your password';
                            document.userlogin.password.focus();
                            return false;
                        }
                        return true;
                        // when password field is not empty
                    } else {
                        document.getElementById('emailcheck').innerHTML = 'Enter a correct email address';
                        document.userlogin.email.focus();
                        return false;
                    }
                }
            }
        </script>

    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        
                                    <form class="user" method="post" id="userform" name="userlogin"
                                              onsubmit="return validate();" novalidate>
                                            <div class="form-floating mb-3">
                                            <input type="email" class="form-control form-control-user"
                                                       id="email" aria-describedby="emailHelp" name="email"
                                                       autocomplete="off"
                                                       placeholder="Enter Email Address...">
                                                <span id="emailcheck" style="font-size: 12px; color: red;"></span>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input type="password" class="form-control form-control-user"
                                                       id="password" placeholder="Password" name="password"
                                                       autocomplete="off">
                                                <span id="passwordcheck" style="font-size: 12px; color: red;"></span>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                                                <button class="btn btn-success btn-block text-white btn-user" type="submit"
                                                    name="login">Login
                                            </button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php }?>