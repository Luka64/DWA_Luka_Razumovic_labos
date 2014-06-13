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
  <title>Generiraj graf | Zdravko Dren</title>

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
		    	<a href="#" class="logo"><img src="../img/logo2.png" alt="Logo" width="200px" height="77px"></a>
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
 				<li><a href="osobni_podaci.php">Osobni podaci</a></li><br><br>
 				<li><a href="popis_pacijenata.php">Popis pacijenata</a></li>
 				<li><a href="unos_pacijenta.php">Dodaj novog pacijenta</a></li>
 				<li><a href="popis_unesenih_pacijenata.php">Popis unešenih pacijenata</a></li>
 				<li><a href="pdf_forma.php">Generiraj PDF</a></li>
 				<li><a href="#">Generiraj Graf</a></li>
 				<li><a href="JSON.php">Doktori</a></li>
 				<li><a href="temp.php">Mobile form</a></li>
 			</ul>
 		</nav>	
	 	<article class="sadrzaj">
	 		<h1>Omjer muškaraca i žena:</h1>
	 		<!--<button><a href="generirajGraf.php"><?php $_SESSION['graf']='pie' ?>Pie graf</a></button><br>
	 		<button><a href="generirajGraf.php"><?php $_SESSION['graf']='stupac' ?>Stupac graf</a></button>-->
	 		<?php/*
	 			if ($_SESSION['graf']=='pie') {
	 				header('Content-type: image/png');
			        $handle = imagecreate(100, 100);
			        $background = imagecolorallocate($handle, 255, 255, 255);
			        $red = imagecolorallocate($handle, 255, 0, 0);
			        $green = imagecolorallocate($handle, 0, 255, 0);
			        $blue = imagecolorallocate($handle, 0, 0, 255);
			        imagefilledarc($handle, 50, 50, 100, 50, 0, 90, $red, IMG_ARC_PIE);
			        imagefilledarc($handle, 50, 50, 100, 50, 90, 225 , $blue, IMG_ARC_PIE);
			        imagefilledarc($handle, 50, 50, 100, 50, 225, 360 , $green, IMG_ARC_PIE);
			        imagepng($handle);
	 			}elseif ($_SESSION['graf']=='stupac') {
	 				$db_host="localhost"; // Host name
			        $db_username="root"; // Mysql username
			        $db_password="root"; // Mysql password
			        $db_name="dwa"; // Database name
			        $tbl_name="uneseniPacijenti"; // Table uneseniPacijenti

			        //stvaranje mysql konekcije i odabir mysql baze podataka
			        $connection=mysql_connect($db_host, $db_username, $db_password)
			            or die("Neuspjelo spajanje na bazu podataka!");
			        $database_select=mysql_select_db($db_name, $connection)
			            or die("Pogreška pri odabiru baze podataka!");

			        mysql_query("SET NAMES 'utf8'");
			        mysql_query("SET CHARACTER SET utf8");
			        mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

			        $maleUpit = mysql_query("SELECT COUNT(idUneseniPacijenti) FROM unesenipacijenti WHERE spol='M'");
			        $male = mysql_fetch_array($maleUpit);
			        $femaleUpit = mysql_query("SELECT COUNT(idUneseniPacijenti) FROM unesenipacijenti WHERE spol='Ž'");
			        $female = mysql_fetch_array($femaleUpit);

			        // This array of values is just here for the example.

			            $values = array("$male[0]","$female[0]");

			        // Get the total number of columns we are going to plot

			            $columns  = count($values);

			        // Get the height and width of the final image

			            $width = 300;
			            $height = 200;

			        // Set the amount of space between each column

			            $padding = 5;

			        // Get the width of 1 column

			            $column_width = $width / $columns ;

			        // Generate the image variables

			            $im        = imagecreate($width,$height);
			            $gray      = imagecolorallocate ($im,0xcc,0xcc,0xcc);
			            $gray_lite = imagecolorallocate ($im,0xee,0xee,0xee);
			            $gray_dark = imagecolorallocate ($im,0x7f,0x7f,0x7f);
			            $white     = imagecolorallocate ($im,0xff,0xff,0xff);
			            
			        // Fill in the background of the image

			            imagefilledrectangle($im,0,0,$width,$height,$white);
			            
			            $maxv = 0;

			        // Calculate the maximum value we are going to plot

			            for($i=0;$i<$columns;$i++)$maxv = max($values[$i],$maxv);

			        // Now plot each column
			                
			                $column_height = ($height / 100) * (( $values[0] / $maxv) *100);

			                $x1 = 0*$column_width;
			                $y1 = $height-$column_height;
			                $x2 = ((1)*$column_width)-$padding;
			                $y2 = $height;

			                imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);
			                imagestring($im, 5, $x2-15, $y2-15, $male[0], $white);

			        // This part is just for 3D effect

			                imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
			                imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
			                imageline($im,$x2,$y1,$x2,$y2,$gray_dark);



			                $column_height = ($height / 100) * (( $values[1] / $maxv) *100);

			                $x1 = 1*$column_width;
			                $y1 = $height-$column_height;
			                $x2 = ((2)*$column_width)-$padding;
			                $y2 = $height;

			                imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);
			                imagestring($im, 5, $x2-15, $y2-15, $female[0], $white);

			        // This part is just for 3D effect

			                imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
			                imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
			                imageline($im,$x2,$y1,$x2,$y2,$gray_dark);

			        // Send the PNG header information. Replace for JPEG or GIF or whatever

			            header ("Content-type: image/png");
			            imagepng($im);
		 			}
	 		*/?>
	 		<form action="../skripte/graf.php" method="POST">
	 			<input type="hidden" value="omjer" name="graf">
				<input type="submit" value="Pie graf">
	 		</form>
	 		<br>
	 		<form action="../skripte/graf.php" method="POST">
	 			<input type="hidden" value="stupac" name="graf">
				<input type="submit" value="Stupac graf">
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