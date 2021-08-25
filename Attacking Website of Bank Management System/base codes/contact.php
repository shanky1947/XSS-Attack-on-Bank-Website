<?php include 'includes/dbconnect.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title>BMU BANK</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body>

    <!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">BMU BANK</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php">Contact us</a></li>
      </ul>
    </div>
  </div>
</nav>
    
    <div class="container">
          <h2>Contact us</h2>
        <?php
    
            $sel_sql = "SELECT * FROM branch";
            $run_sql = mysqli_query($con, $sel_sql);

            while($rows = mysqli_fetch_array($run_sql)){
                
                echo '
                    <div class="panel-group">
                        <div class="panel panel-primary">
                          <div class="panel-heading">'.$rows['branchname'].':</div>
                          <div class="panel-body">
                           <address class="address"><strong><pre>
                                BMU Bank,
                                '.$rows['branchaddress'].',
                                '.$rows['state'].',
                                '.$rows['pincode'].',
                                '.$rows['country'].'.
                                </pre></strong></address>
                            </div>
                    </div>
            
                </div>

                ';
            }
?>
    </div>
        

</body>
</html>
