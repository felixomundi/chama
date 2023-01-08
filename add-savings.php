<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
} else{
//include('db.php'); {
if (isset($_POST['submit'])) {
//$uid=$_POST['userid'];
$username=$_POST['username'];    
$amount = $_POST['amount'];   
//$date = $_POST['pay_date'];
$refno=$_POST['refno'];
$email3 = $_SESSION['login'];

$sql3 = "SELECT `id` FROM `users` WHERE `email`=:email3";
$query3 = $dbh->prepare($sql3);
$query3->bindParam(':email3', $email3, PDO::PARAM_STR);
$query3->execute();
$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
if ($query3->rowCount() > 0) {
foreach ($results3 as $result3) {
$uid = $result3->id;
}
}    
$status=1;


$sql = "INSERT INTO savings(userid,username,refno,amount,status) VALUES(:uid,:username,:refno,:amount,:status)";
        $query = $dbh->prepare($sql);
        //$query->bindParam(':pay_date', $pay_date, PDO::PARAM_STR);
        $query->bindParam(':amount', $amount, PDO::PARAM_STR);
        $query->bindParam(':refno', $refno, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Savings added successfully');document.location = 'manage-savings.php';</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }}
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



<div id="layoutSidenav_content">
<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header"><h3 class="text-center font-weight-light my-4">Add Savings</h3></div>
<div class="card-body">
<form action="#" method="post">

<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<input type="number" name="amount" class="form-control text-right"  class="field-short" required="true" step="0.0" min="10" max="10000">
<label for="inputLastName">Savings Amount</label>
</div>
</div>

<?php
$email = $_SESSION['login'];
$sql2 = "SELECT fname,lname,id FROM users WHERE email=:email ";
$query = $dbh->prepare($sql2);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
foreach ($results as $result2) {
$username = $result2->fname . " " . $result2->lname;
?>
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">  
<input class="form-control" type="hidden" id="name" required
name="username" value="<?php echo htmlentities($username); }}?>">
 
<input class="form-control" name="refno" id="inputPassword" required type="text" placeholder="Enter REFNO" />

<label for="inputPassword">REFNO</label>
</div>
</div>


</div>
</div>


<div class="mt-4 mb-0">
<div class="d-grid"><input type="submit" name="submit" class="btn btn-primary btn-block" ></div>
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
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
<?php } ?>