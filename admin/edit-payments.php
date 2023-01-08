<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {   
    if (isset($_POST['submit'])) {
       // $refno = $_POST['refno'];
        $id = intval($_GET['id']);
        //$userid=$_POST['userid'];
        $amount = $_POST['amount'];
       // $pay_date = $_POST['pay_date'];
        $balance=$_POST['balance'];
        $pay_type=$_POST['pay_type'];
        $refno=$_POST['refno']; 
        $sql = "UPDATE `payments` SET amount=:amount,balance=:balance,pay_type=:pay_type,refno=:refno WHERE id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':refno', $refno, PDO::PARAM_STR);
        $query->bindParam(':amount', $amount, PDO::PARAM_STR);
        $query->bindParam(':balance', $balance, PDO::PARAM_STR);
        $query->bindParam(':pay_type', $pay_type, PDO::PARAM_STR);
        //$query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Payments updated successfully');document.location = 'manage-payments.php';</script>";
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
               
                </main>



                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Payments</h3></div>
                                    <div class="card-body">
                                        <form method="post"> 
                                        <?php
                    $id = intval($_GET['id']);
                    $sql = "SELECT * from payments WHERE payments.id=:id";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                    foreach ($results

                    as $result) { ?>         
                                             
										
                                           
<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating">
<input type="number" name="amount" class="form-control text-right"  value="<?php echo htmlentities($result->amount);?>" step="0.0" required>
<label for="inputLastName">Amount to Pay<span class="required">?</span></label>
</div>
</div>

<div class="col-md-6"> <label for="inputPassword">REFN0</label>
<div class="form-floating mb-3 mb-md-0">
<input type="text" name="refno" value="<?php echo htmlentities($result->refno); ?>" required class="form-control"  />                                                       
</div>
</div>

</div>




<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<input type="number" name="balance" step="0.0" value="<?php echo htmlentities($result->balance); ?>" required class="form-control"  />
<label for="inputPassword">Balance</label>
</div>
</div>
<div class="col-md-6"> 
<label for="inputPassword">Pay Type</label>
<div class="form-floating mb-3 mb-md-0">
<select  name="pay_type" required>
<option value="">Select Payment Type </option>
<option value="Savings">Savings </option>
<option value="Shares">Contributions</option>
<option value="Shares">Shares</option>
<option value="Loans">Loans </option>
<option value="Penalty">penalty </option>
</select>
</div>
</div>
</div>

<div class="row mb-3">
<div class="col-md-6">
<div class="form-floating mb-3 mb-md-0">
<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block"/>

</div>
</div>
</div>
                                        </form>
                                        <?php }}?>
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