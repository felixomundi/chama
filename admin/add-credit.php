<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
header('location: login.php');
} else
include('db.php'); {
if (isset($_POST['submit'])) {


$mid = $_POST['mid'];    
$amount = $_POST['amount'];
$status=1; 
$date = $_POST['credit_date'];
$refno=$_POST['refno'];
$source=$_POST['source'];
$balance=$_POST['balance'];
$status=1;
$query=mysqli_query($con, "INSERT INTO credit (mid,amount,refno,source,balance,credit_date,status) VALUES('$mid','$amount','$refno','$source','$balance',now(),'$status')");

if ($query) {
echo "<script>alert('Credit record  Added');</script>";
echo "<script type='text/javascript'> document.location ='manage-credit.php'; </script>";
} else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
}}}

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
<style type="text/css">
.form-style-1 {
margin:10px auto;
max-width: 400px;
padding: 20px 12px 10px 20px;
font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-1 li {
padding: 0;
display: block;
list-style: none;
margin: 10px 0 0 0;
}
.form-style-1 label{
margin:0 0 3px 0;
padding:0px;
display:block;
font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],

.form-style-1 input[type=password],
textarea, 
select{
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
border:1px solid #BEBEBE;
padding: 7px;
margin:0px;
-webkit-transition: all 0.30s ease-in-out;
-moz-transition: all 0.30s ease-in-out;
-ms-transition: all 0.30s ease-in-out;
-o-transition: all 0.30s ease-in-out;
outline: none;	
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=file]:focus,
.form-style-1 input[type=email]:focus,

.form-style-1 input[type=password]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
-moz-box-shadow: 0 0 8px #88D5E9;
-webkit-box-shadow: 0 0 8px #88D5E9;
box-shadow: 0 0 8px #88D5E9;
border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
width: 49%;
}

.form-style-1 .field-long{
width: 100%;
}
.form-style-1 .field-select{
width: 100%;
}
.form-style-1 .field-textarea{
height: 100px;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
background: #4B99AD;
padding: 8px 15px 8px 15px;
border: none;
color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
background: #4691A4;
box-shadow:none;
-moz-box-shadow:none;
-webkit-box-shadow:none;
}
.form-style-1 .required{
color:red;
}
</style>


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
<div class="card-header"><h3 class="text-center font-weight-light my-4">Add Credit Record</h3></div>
<div class="card-body">
<form method="post">
<div class="row mb-3">
<div class="col-md-6"><label>Debit To</label>
<div class="form-floating mb-3 mb-md-0">
<select  name="mid" required>
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
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->fname);?><?php echo htmlentities($result->lname);?></option>
<?php }} ?>

</select> 
</div>
</div>


<div class="col-md-6"><label>Credit  Source</label>
<div  class="form-floating mb-3 mb-md-0">
<select name="source" id="cars">
<option value="shares">Shares</option>
<option value="total savings">Total Savings</option>
<option value="payments">Payments</option>
</select>

</div></div> </div>


<div class="row mb-3">
<div class="col-md-6"> <label>Balance in Source</label>
<div  class="form-floating mb-3 mb-md-0">
<input type="number" name="balance"  step="0.01" required class="form-control"  placeholder="Enter Balance" />
</div>
</div>

<div class="col-md-6"> <label>Amount</label>
<div class="form-floating mb-3 mb-md-0">
<input type="number" name="amount"  step="0.01" class="form-control"  placeholder="Enter Amount" />

</div>
</div>
</div>


<div class="row mb-3">
<div class="col-md-6"><label for="inputPassword">REFNO</label>
<div class="form-floating mb-3 mb-md-0">
<input type="text" name="refno" required  placeholder="Enter REFNO" class="form-control" />

</div>
</div>
<div class="col-md-6"> <label for="inputPasswordConfirm">Date</label>
<div class="form-floating mb-3 mb-md-0">
<input type="date" name="credit_date" required   class="form-control"  />

</div>
</div>
</div>
<div class="mt-4 mb-0">
<div class="d-grid"><input type="submit" name="submit" class="btn btn-primary btn-block"></div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>