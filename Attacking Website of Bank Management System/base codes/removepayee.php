<?php
session_start();
include 'includes/dbconnect.php';
	$id = $_SESSION['usr_id'];

	$success = "";
	if(isset($_POST['submit'])){


			$payee_no = $_POST['accno'];

			$sql1 = "DELETE FROM payee WHERE accno = '$payee_no'";
			$run1 = mysqli_query($con, $sql1);

			$temp = mysqli_affected_rows($con);

			if($temp>0){

				$success = "Payee removed successfully!";
			}else{

				$success = "You don't have a payee with that account number!";
			}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BMU Bank</title>
	<link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">BMU Bank</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<div style="color: blue;" class="container-fluid">

<h3>Welcome, <?php echo $_SESSION['usr_name']; ?></h3>
</div>

<div style="width: 50px; height: 50px;"></div>
<div class="col-lg-2">
	<ul class="navbar navbar-default nav" style="height: 650px;">

		<li><a href="accountdetails.php"><span style="margin-left: 25px; margin-top:20px; font-size: 20px;"><b>Account details</b></span></a></li>
		<li><a href="transactions.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>My Transactions</b></span></a></li>
		<li><a href="transfer.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Transfer Amount</b></span></a></li>
		<li><a href="payee.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Register a payee</b></span></a></li>
		<li><a href="removepayee.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Remove Payee</b></span></a></li>
		<li><a href="loanpayment.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Pay loans</b></span></a></li>
		<li><a href="loantransactions.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Loan payments</b></span></a></li>
		<li><a href="customerloans.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Loan info</b></span></a></li>
		</ul>
		</div>

<div class="container">
	<article class="row">
		<section class="col-lg-8">
			<div class="page-header">
				<h2>Remove a Payee</h2>
			</div>

	<form class="form-horizontal" action="removepayee.php" method="post" role="form">
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">Payee Name *</label>
						<div class="col-sm-8">
							<input type="text" name="accname" class="form-control" placeholder="Enter your name" id="accname" required>
						</div>
				</div>
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Account number *</label>
						<div class="col-sm-8">
							<input type="text" name="accno" class="form-control" placeholder="Enter account number" id="accnumber" required>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
						<input type="submit" id="submit" name="submit" value = "Submit" class="btn btn-block btn-danger">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
						<h4><?php echo $success ?></h4>
					</div>
				</div>
</form></section></article></div>
		

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

