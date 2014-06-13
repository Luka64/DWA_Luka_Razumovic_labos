<!DOCTYPE html>
<html>
<head>

  <!--<link rel="shortcut icon" href="img/favicon.ico" />-->
  
  <meta charset="UTF-8" />
	<title>Prijava | Zdravko Dren</title>

	<link rel="shortcut icon" href="img/favicon.ico" />

  <!-- Učitavanje stilskih datoteka -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/grid.css" />
  <link rel="stylesheet" href="css/stil.css" />

  <!-- Fix za mobitele -->
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">

  <?php
    session_start();

    $_SESSION['graf']=null;
  ?>

  <!-- Učitavanje ikona -->
  <!--<link rel="stylesheet" href="css/fontello.css">-->

</head>
<body>

 	<section class="row">
 		<div class="login-screen">
 			<div class="logo">
 				<img src="img/logo.png">
 				<p>Dominica sancta, quid remediis sunt.</p>
 			</div>
	 		<form action="skripte/login.php" method="POST">
	 			<label for="username">Korisničko ime:</label><br>
	 				<input type="text" name="username" id="username" style="margin-bottom: 20px;"><br>
	 			<label for="password">Lozinka:</label><br>
	 				<input type="password" name="password" id="password"><br>
	 			<input type="submit" name="login" value="Prijava" style="margin-left: 58px; margin-top: 20px;">
	 		</form>
 		</div>
 	</section>

 	<footer class="row footer">
 		<div class="footer-text">
 			<p>Copyright <b>ZDK, 2014</b></p>
 		</div>
 	</footer>
</body>
</html>