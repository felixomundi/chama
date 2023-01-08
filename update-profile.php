<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
}
if(isset($_POST['updateprofile']))
                      {
                      $fname=$_POST['fname'];
                      $lname=$_POST['lname'];
                      $contact=$_POST['contact'];
                      $dob=$_POST['dob'];
                      $kin=$_POST['kin'];
                      $address=$_POST['address'];                    
                      $email=$_SESSION['login'];
                      $sql="update users set fname=:fname,lname=:lname,contact=:contact,kin=:kin,dob=:dob,address=:address where email=:email";
                      $query = $dbh->prepare($sql);
                      $query->bindParam(':fname',$fname,PDO::PARAM_STR);
                      $query->bindParam(':lname',$lname,PDO::PARAM_STR);
                      $query->bindParam(':contact',$contact,PDO::PARAM_STR);
                      $query->bindParam(':dob',$dob,PDO::PARAM_STR);
                      $query->bindParam(':address',$address,PDO::PARAM_STR);
                      $query->bindParam(':kin',$kin,PDO::PARAM_STR);
                      $query->bindParam(':email',$email,PDO::PARAM_STR);
                      $query->execute();
                      $msg="Profile Updated Successfully";
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

        <title>Update User Profile</title>

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
              rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    
<body class="sb-nav-fixed">
    <div id="layoutSidenav">

    <?php include('includes/header.php');?>

<?php include('includes/sidebar.php');?>


            <div id="layoutSidenav_content" id="content-wrapper">
                <main>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Update profile</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                           

                            <?php
                    $email = $_SESSION['login'];
                    $sql2 = "SELECT *  FROM `users` WHERE `email`=:email;";
                    $query = $dbh->prepare($sql2);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            
                    ?> <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold"><?php echo $result->username;?>'s&nbsp;Profile </p>
                                            </div>
                                            <div class="card-body">





                                            <form  method="post">

<div class="form-group">
<label class="control-label">First Name</label>
<input class="form-control white_bg" name="fname" value="<?php echo htmlentities($result->fname);?>" id="fullname" type="text"  required="true">
</div>

<div class="form-group">
<label class="control-label">Last Name</label>
<input class="form-control white_bg" name="lname" value="<?php echo htmlentities($result->lname);?>" id="fullname" type="text"  required="true">
</div>

<div class="form-group">
<label class="control-label">Email Address</label>
<input class="form-control white_bg" value="<?php echo htmlentities($result->email);?>" name="email" id="email" type="email" required readonly>
</div>
<div class="form-group">
<label class="control-label">Phone Number</label>
<input class="form-control white_bg" name="contact" value="<?php echo htmlentities($result->contact);?>" id="phone-number" type="text" required="true">
</div>
<div class="form-group">
<label class="control-label">Date of Birth&nbsp;(dd/mm/yyyy)</label>
<input class="form-control white_bg" value="<?php echo htmlentities($result->dob);?>" name="dob" placeholder="dd/mm/yyyy" id="birth-date" type="text" required="true">
</div>
<div class="form-group">
<label class="control-label">Your Address</label>
<input class="form-control white_bg" name="address" rows="4" required="true" value="<?php echo htmlentities($result->address);?>">
</div>
<div class="form-group">
<label class="control-label">Next Of Kin</label>
<input class="form-control white_bg"  id="county" name="kin" value="<?php echo htmlentities($result->kin);?>" type="text" required="true">
</div>


<div class="form-group">
<button type="submit" class="btn btn-primary" name="updateprofile" class="btn">Save Changes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
</div>

                                                                                         



                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">



                                                            <div class="form-group">
                                                                <label for="insertimage1"><strong>Change Profile
                                                                                                  image</strong></label>
                                                                                                  <img
src="photo/<?php echo $result->profilepic; ?>"
width="300" height="200" style="border:solid 1px #000"><br><br>
<a href="change-profile.php?userid=<?php echo $result->id ?>">Click to Change
profile Image</a>
                                                            </div>


                                                            
                                                        </div>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.container-fluid -->

                    
<?php }}?>

               
</div>
                        </div>
                    </div>
                </main>


            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

    </html>