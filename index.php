
<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
include('db.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
} else {?>

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
<div class="container-fluid px-4">

<h1 class="mt-4">Dashboard</h1>

<?php  
                                     $email1 = $_SESSION['login'];
                                     $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
                                     $query1 = $dbh->prepare($sql1);
                                     $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
                                     $query1->execute();
                                     $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                     if ($query1->rowCount() > 0) {
                                         foreach ($results1 as $result1) {
                                             $uid = $result1->id;
                                         }
                                     }
 
                                     $sql = "SELECT sum(amount) from savings where savings.userid=:uid and savings.status=:status order by savings.id desc";
                                       
                                     $query = $dbh->prepare($sql);
                                     $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                     $query->bindParam(':status', $status, PDO::PARAM_STR);
                                     $query->execute();
                                     $total = $query->fetch(PDO::FETCH_NUM);{
                                         echo '
                                    
<div class="row">
<div class="col-xl-3 col-md-6">
<div class="card bg-primary text-white mb-4">
<div class="card-body">Personal Savings</div>
<div class="card-footer d-flex align-items-center justify-content-between">
<a class="small text-dark stretched-link" href="active-savings.php"> '.$total[0].' </a>
<div class="small text-white"><i class="fas fa-angle-right"></i></div>
</div>
</div>
</div>

';}?>
<?php
$email1 = $_SESSION['login'];
$sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':email1', $email1, PDO::PARAM_STR);
$query1->execute();
$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
if ($query1->rowCount() > 0) {
foreach ($results1 as $result1) {
$uid = $result1->id;
}
}

$status = 0;
$sql = "SELECT * FROM loans WHERE  loans.status=:status and loans.userid=:uid  ";
$query = $dbh->prepare($sql);
$query->bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$activeloans = $query->rowCount();
?>
<div class="col-xl-3 col-md-6">
<div class="card bg-primary text-white mb-4">
<div class="card-body">My Active Loans</div>
<div class="card-footer d-flex align-items-center justify-content-between">
<a class="small text-dark stretched-link" href="active-loans.php"><?php echo htmlentities($activeloans); ?></a>
<div class="small text-white"><i class="fas fa-angle-right"></i></div>
</div>
</div>
</div>


<?php
$email1 = $_SESSION['login'];
$sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':email1', $email1, PDO::PARAM_STR);
$query1->execute();
$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
if ($query1->rowCount() > 0) {
foreach ($results1 as $result1) {
$uid = $result1->id;
}
}

$status = 0;
$sql = "SELECT * FROM payments WHERE  payments.status=:status and payments.userid=:uid  ";
$query = $dbh->prepare($sql);
$query->bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$activeloans = $query->rowCount();
?>
<div class="col-xl-3 col-md-6">
<div class="card bg-primary text-white mb-4">
<div class="card-body">Personal Contributions</div>
<div class="card-footer d-flex align-items-center justify-content-between">
<a class="small text-dark stretched-link" href="manage-contributions.php"><?php echo htmlentities($activeloans); ?></a>
<div class="small text-white"><i class="fas fa-angle-right"></i></div>
</div>
</div>
</div>

<?php
$email1 = $_SESSION['login'];
$sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':email1', $email1, PDO::PARAM_STR);
$query1->execute();
$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
if ($query1->rowCount() > 0) {
foreach ($results1 as $result1) {
$uid = $result1->id;
}
}

$status = 2;
$sql = "SELECT * FROM loans WHERE  loans.status=:status and loans.userid=:uid order by loans.id desc ";
$query = $dbh->prepare($sql);
$query->bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$paidloans = $query->rowCount();
?>

<div class="col-xl-3 col-md-6">
<div class="card bg-warning text-white mb-4">
<div class="card-body">Paid Loans History</div>
<div class="card-footer d-flex align-items-center justify-content-between">
<a class="small text-dark stretched-link" href="cleared-loans.php"><?php echo htmlentities($paidloans); ?></a>
<div class="small text-white"><i class="fas fa-angle-right"></i></div>
</div>
</div>
</div>


<?php
$email1 = $_SESSION['login'];
$sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':email1', $email1, PDO::PARAM_STR);
$query1->execute();
$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
if ($query1->rowCount() > 0) {
foreach ($results1 as $result1) {
$uid = $result1->id;
}
}

$status = 3;
$sql = "SELECT * FROM loans WHERE  loans.status=:status and loans.userid=:uid order by loans.id desc ";
$query = $dbh->prepare($sql);
$query->bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$paidloans = $query->rowCount();
?>

<div class="col-xl-3 col-md-6">
<div class="card bg-danger text-white mb-4">
<div class="card-body">Pending Loans</div>
<div class="card-footer d-flex align-items-center justify-content-between">
<a class="small text-dark stretched-link" href="appended-loans.php"><?php echo htmlentities($paidloans); ?></a>
<div class="small text-white"><i class="fas fa-angle-right"></i></div>
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
<?php }?>