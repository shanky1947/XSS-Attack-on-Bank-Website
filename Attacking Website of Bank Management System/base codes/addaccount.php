<?php
session_start();
include 'includes/dbconnect.php';

	$success = "";

	if(isset($_POST['submit'])){

		$accname = $_POST['accname'];
		$accno = $_POST['accno'];
		$accifsc = $_POST['accifsc'];
		$accemail = $_POST['accemail'];
		$accpassword = $_POST['accpassword'];
		$acctype = $_POST['acctype'];
		$accbalance = $_POST['accbalance'];
		$accdate = date('y-m-d');
		$ins_sql = "INSERT INTO accounts(accname, accno, accifsc, accemail, accpassword, acctype, accbalance, accdate) VALUES ('".$accname."', '".$accno."', '".$accifsc."', '".$accemail."', '".md5($accpassword)."', '".$acctype."', '".$accbalance."', '".$accdate."')";
		$run_sql = mysqli_query($con,$ins_sql);

		$temp = mysqli_affected_rows($con);
		if($temp>0){

			$in_sql = "INSERT INTO users(name, email, password) VALUES ('".$accname."', '".$accemail."', '".md5($accpassword)."')";
			$ru_sql = mysqli_query($con,$in_sql);

			$success = "Account added successfully!";
		}else{

			$success = "Something went wrong!";
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
			<a class="navbar-brand" href="admin.php">Admin Dashboard</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="login.php">Login</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<div style="width: 50px; height: 50px;"></div>
<div class="col-lg-2">
	<ul class="navbar navbar-default nav" style="height: 650px;">

		<li><a href="addaccount.php"><span style="margin-left: 25px; margin-top:20px; font-size: 20px;"><b>Add an account</b></span></a></li>
		<li><a href="deleteaccount.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Close an account</b></span></a></li>
		<li><a href="grantloan.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Grant Loan</b></span></a></li>
		<li><a href="viewaccounts.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>View accounts</b></span></a></li>
		<li><a href="depositmoney.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Deposit money</b></span></a></li>
		<li><a href="withdrawmoney.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>Withdraw Money</b></span></a></li>
		<li><a href="viewloans.php"><span style="margin-left: 25px; margin-top: 20px; font-size: 20px;"><b>View loans</b></span></a></li>
		</ul>
		</div>

<div class="container">
	<article class="row">
		<section class="col-lg-8">
			<div class="page-header">
				<h2>Add an account</h2>
			</div>
			<form class="form-horizontal" action="addaccount.php" method="post" role="form">
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">Full Name *</label>
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
					<label for="number" class="col-sm-3 control-label">IFSC Code *</label>
						<div class="col-sm-8">
							<input type="text" name="accifsc" class="form-control" placeholder="Enter IFSC Code" id="accifsc" required>
						</div>
				</div>
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Email-address *</label>
						<div class="col-sm-8">
							<input type="email" name="accemail" class="form-control" placeholder="Enter Email-address" id="accemail" required>
						</div>
				</div>
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Password *</label>
						<div class="col-sm-8">
							<input type="password" name="accpassword" class="form-control" placeholder="Enter password" id="accpassword" required>
						</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">Account type *</label>
						<div class="col-sm-8">
							<select class="form-control" name="acctype" id="acctype">
								<option>Savings</option>
								<option>Current</option>

							</select>
						</div>
				</div>
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Account balance *</label>
						<div class="col-sm-8">
							<input type="text" name="accbalance" class="form-control" placeholder="Enter the balance" id="accbalance" required>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
					<input type="submit" id="submit" name="submit" value = "Submit" class="btn btn-block btn-primary">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
					<h4><?php echo $success ?></h4>
					</div>
				</div>
				


	</article></form></section></article></div>
</body>
</html>