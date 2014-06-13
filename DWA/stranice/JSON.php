<?php
  session_start();
  if (!isset($_SESSION['idKorisnika'])) {
    header("location: ../index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <!--<link rel="shortcut icon" href="img/favicon.ico" />-->
  
  <meta charset="UTF-8" />
  <title>Doktori | Zdravko Dren</title>

  <link rel="shortcut icon" href="../img/favicon.ico" />

  <!-- Učitavanje stilskih datoteka -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/grid.css" />
  <link rel="stylesheet" href="../css/stil.css" />

  <!-- Fix za mobitele -->
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">

  <!-- Učitavanje ikona -->
  <!--<link rel="stylesheet" href="css/fontello.css">-->

</head>
<body>
	<header>
		<div class="row header">
			<div class="logo">
		    	<a href="../osobni_podaci.php" class="logo"><img src="../img/logo2.png" alt="Logo" width="200px" height="77px"></a>
		   	</div>
		   	<div class="logout row">
				<?php
					echo "<div style='margin-right: 10px; color: #FFF;'>".$_SESSION['ime']." ".$_SESSION['prezime']." "."<a href='../skripte/logout.php' class='logout-button'><button><b>Odjava</b></button></a></div>";
				?>
		   	</div>
	    </div>
 	</header>

 	<section class="row" style="margin-top: 80px;">
 		<nav class="navigacija">
 			<ul>
 				<li><a href="popis_pacijenata.php">Popis pacijenata</a></li>
 				<li><a href="unos_pacijenta.php">Dodaj novog pacijenta</a></li>
 				<li><a href="popis_unesenih_pacijenata.php">Popis unešenih pacijenata</a></li>
 				<li><a href="pdf_forma.php">Generiraj PDF</a></li>
 				<li><a href="generirajGraf.php">Generiraj Graf</a></li>
 				<li><a href="#">Doktori</a></li>
 				<li><a href="temp.php">Mobile form</a></li>
 			</ul>
 		</nav>	
	 	<article class="sadrzaj">
	 		<h2>Ispis doktora</h2>
	 		<form action="ispis_doktora.php" method="POST">
	 			<label for="ime">Ime:</label>
	 			<input type="text" name="ime" id="ime"><br>
	 			<label for="prezime">Prezime:</label>
	 			<input type="text" name="prezime" id="prezime"><br><br>
	 			<input type="submit" value="Ispiši!">
	 		</form>
	 	</article>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>
</html>