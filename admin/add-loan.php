<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
header('location: login.php');
} else
include('db.php');
 {
if (isset($_POST['submit'])) {
$userid=$_POST['userid'];
$type = $_POST['type'];
$amount = $_POST['amount'];
$status= 0;

$refno = $_POST['refno'];
$due_date = $_POST['due_date'];
$sql = "INSERT INTO loans(userid,refno,due_date,type,amount,status) VALUES(:userid,:refno,:due_date,:type,:amount,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':userid', $userid, PDO::PARAM_STR);
$query->bindParam(':amount', $amount, PDO::PARAM_STR);
$query->bindParam(':type', $type, PDO::PARAM_STR);
$query->bindParam(':refno', $refno, PDO::PARAM_STR);
$query->bindParam(':due_date', $due_date, PDO::PARAM_STR); 
$query->bindParam(':status', $status, PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if ($lastInsertId) {
    echo "<script>alert('Loan Application and approval successfull');document.location = 'active-loans.php';</script>";
} else {
    echo "<script>alert('Something went wrong')</script>";
}
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
<div class="card-header"><h3 class="text-center font-weight-light my-4">Create New Loan Application</h3></div>
<div class="card-body">
<form method="post">
<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<select  class="form-control" name="userid" required="true">
<option value="">Select Member </option>
<?php $ret="select id, fname,lname from users";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></option>
<?php }} ?>

</select>            
</div>
</div>
<div class="col-md-6">
<div class="form-floating">
<select class="form-control" name="type" required="true" id="category-dropdown">
<option value=""> Select Loan Type </option>
<?php $ret="select * from plans";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->type);?></option>
<?php }} ?>
</select>
<label for="inputFirstName">Loan Type</label>
</div>
</div>
</div>
<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">

<select class="form-control" id="sub-category-dropdown">
<option value="">Read Terms and Apply Loan</option>
</select>
<label for="inputLastName">Loan Terms</label>
</div>
</div>
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<input type="number" name="amount" required="true" min="100" max="5000" step="0.01" class="form-control"   />
<label for="inputPasswordConfirm">Amount</label>
</div>
</div>
</div>


<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<input type="text" name="refno" class="form-control" required="true" >
<label for="inputLastName">REFNO</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">

<input type="date" name="due_date" class="form-control" required="true">
<label for="inputLastName"><b>Due Date</b></label>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">Member Agreed with <a href="#">Terms and Conditions</a></label>
                </div>
</div>

<div class="mt-4 mb-0">
<div class="d-grid"><input type="submit" name="submit" class="btn btn-primary btn-block"></a></div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"  crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
$('#category-dropdown').on('change', function() {
var category_id = this.value;
$.ajax({
url: "get-cat.php",
type: "POST",
data: {
category_id: category_id
},
cache: false,
success: function(result) {
$("#sub-category-dropdown").html(result);
}
});
});
});
</script>

</body>
</html>