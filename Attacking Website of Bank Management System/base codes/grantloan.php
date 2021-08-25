<?php
session_start();
include 'includes/dbconnect.php';
	
	$success = "";

	if(isset($_POST['submit'])){

			$accno = $_POST['accno'];
			

			$in_sql = "SELECT * FROM accounts WHERE accno = '$accno'";
			$ru_sql = mysqli_query($con, $in_sql);
			$temp = mysqli_affected_rows($con);
			if($temp>0){

				$success = "Loan granted successfully!";
			}else{

				$success = "Account number doesn't exist!";
			}

			$rows = mysqli_fetch_array($ru_sql);

			$balance = $rows['accbalance'];

		
			$ltype = $_POST['ltype'];
			$lamount = $_POST['lamount'];

			if($lamount>0){

				$total = $balance + $lamount;

				$ins_sql = "UPDATE accounts
								SET accbalance = $total
								WHERE accno = '$accno'";

					$run_sql = mysqli_query($con, $ins_sql);

				$linterest = $_POST['linterest'];
				$ldate = date('y:m:d');
				$ins_sql = "INSERT INTO loan (accno, loantype, loanamt, loan_rem, interest, loandate) VALUES ('".$accno."', '".$ltype."', '".$lamount."', '".$lamount."', '".$linterest."', '".$ldate."')";
				$run_sql = mysqli_query($con,$ins_sql);


			}else{

				$success = "You're fired!";
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script></head>
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
				<li><a href="register.php">Sign Up</a></li>
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
				<h2>Grant loan</h2>
			</div>
			<form class="form-horizontal" action="grantloan.php" method="post" role="form">
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Account no *</label>
						<div class="col-sm-8">
							<input type="text" name="accno" class="form-control" placeholder="Enter account no" id="loanid" required>
						</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">Loan type *</label>
						<div class="col-sm-8">
							<input type="text" name="ltype" class="form-control" placeholder="Enter the loan type" id="loantype" required>
						</div>
				</div>
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Loan amount *</label>
						<div class="col-sm-8">
							<input type="text" name="lamount" class="form-control" placeholder="Enter the amount" id="loanamount" required>
						</div>
				</div>
				
				<div class="form-group">
					<label for="number" class="col-sm-3 control-label">Interest(%) *</label>
						<div class="col-sm-8">
							<input type="text" name="linterest" class="form-control" placeholder="Enter interest percentage" id="linterest" required>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
					<input type="submit" name="submit" value = "Submit" class="btn btn-block btn-primary">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-8">
					<h4><?php echo $success ?></h4>
					</div>
				</div>
				


	</article>
	

</div>

</body>
</html>