<?php
session_start();
include 'includes/dbconnect.php';


	$id = $_SESSION['usr_id'];
	$success = "";

	if(isset($_POST['submit'])){

			$name = $_POST['payee'];

			$sql1 = "SELECT * FROM accounts WHERE accname = '$name'";
			$run1 = mysqli_query($con, $sql1);

			$row1 = mysqli_fetch_array($run1);

			$accno = $row1['accno'];
			$payeebalance = $row1['accbalance'];
			$amount = $_POST['amount'];

			if($amount>0){
				
					$total = $payeebalance + $amount;

					$sql2 = "UPDATE accounts
								SET accbalance = $total
								WHERE accno = '$accno'";

					$run2 = mysqli_query($con, $sql2);
					$date = date('y-m-d');

					$sql3 = "SELECT * FROM accounts WHERE id = $id";
					$run3 = mysqli_query($con, $sql3);

					$row2 = mysqli_fetch_array($run3);
					$owner_no = $row2['accno'];
					$owner_balance = $row2['accbalance'];

					if($owner_balance>=$amount){


						$owner_updated = $owner_balance - $amount;

						$sql4 = "UPDATE accounts
								SET accbalance = $owner_updated
								WHERE accno = '$owner_no'";
						$run4 = mysqli_query($con, $sql4);

						$sql5 = "INSERT INTO transactions(payee_name, amount, from_acc, trans_date) VALUES('".$name."', '".$amount."','".$owner_no."', '".$date."')";
						$run5 = mysqli_query($con, $sql5);

						$success = "Transferred succesfully!";
					}else{

						$success = "You don't have enough balance!";
					}

			}else{

				$success = "Don't be smart!";
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
							<h2>Transfer amount</h2>
						</div>
					<form class="form-horizontal" action="transfer.php" method="post" role="form">
						<div class="form-group">
							<label for="name" class="col-sm-3 control-label">Select a payee *</label>
								<div class="col-sm-8">
									<select class="form-control" name="payee" id="acctype">
									<?php 

										$id = addslashes($_SESSION['usr_id']);
										$in_sql = "SELECT * FROM accounts WHERE id = $id";
										$ru_sql = mysqli_query($con, $in_sql);

										$rows = mysqli_fetch_array($ru_sql);
										$from_acc = $rows['accno'];

										$ins_sql = "SELECT * FROM payee WHERE registered_in = '$from_acc'";
										$run_sql = mysqli_query($con,$ins_sql);

									while($rows = mysqli_fetch_array($run_sql)){


										echo '

										<option>'.$rows['name'].'</option>

											';
										}

								?>

									</select>
					</div></div>
					<div class="form-group">
						<label for="number" class="col-sm-3 control-label">Enter amount*</label>
							<div class="col-sm-8">
								<input type="text" name="amount" class="form-control" placeholder="Enter the balance" id="amount" required>
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


	


		

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

