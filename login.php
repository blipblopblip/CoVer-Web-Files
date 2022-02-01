<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cover Plus</title>	
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
</head>
<body>
	
<div class="container">
  <!-- Instructions -->
  <div class="row">
    <div class="alert alert-success col-md-12" role="alert" id="notes">
      <h4>NOTES</h4>
      <ul>
        <li>Please enter your registered birthday to Cover Plus. Enter that below to access your Account.</li>
        <li>If somehow, you did not receive the attachment then Email <b>coverplustest@gmail.com</b></li>
      </ul>
    </div>
  </div>
  <!-- Verification Entry Jumbotron -->
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron text-center">
        <h4>Please enter your birthday with the following format for verification</h4>
        <form method="POST" action="authenticate.php" role="form">
          <div class="col-md-9 col-sm-12">
            <div class="form-group form-group-lg">
			<?php
				if(isset($_SESSION["error"])){
					$error = $_SESSION["error"];
					echo"</br>";
					echo "<center><p style='color:red;'>$error</p></center>";
				}
			?>  
          <input type="text" placeholder="yyyy-MM-dd" class="form-control col-md-6 col-sm-6 col-sm-offset-2" name="bday" required>
          <input class="btn btn-primary btn-lg col-md-2 col-sm-2" type="submit" name="login" value="Verify">
          <input type="hidden" class="form-control col-md-6 col-sm-6 col-sm-offset-2" name="key1" value="<?php echo $_GET['key1'];?>">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php
    unset($_SESSION["error"]);
?>