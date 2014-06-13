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
  <title>Ispis doktora | Zdravko Dren</title>

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
	 	<article class="sadrzaj" style="text-align: center;">
	 		<?php
	 			$imeDohvat=$_POST['ime'];
	 			$prezimeDohvat=$_POST['prezime'];
	 			$ime=mb_strtoupper($imeDohvat, 'UTF-8');
	 			$prezime=mb_strtoupper($prezimeDohvat, 'UTF-8');

				function get_data($url) {
					$ch = curl_init();
					$timeout = 5;
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					$data = curl_exec($ch);
					curl_close($ch);
					return $data;
				}

				 //echo $returned_content = get_data('http://stajp.vtszg.hr/~spredanic/DWA2/lab5/podaci.php');

				$string = get_data('http://stajp.vtszg.hr/~spredanic/DWA2/lab5/podaci.php');
				$json_a = json_decode($string, true);

				echo "<table border=1 style='border-colappse: colappse;'>";
				echo "<tr>";
				//echo "<td>ID</td>";
				//echo "<td>Područni ured</td>";
				//echo "<td>Šifra ustanove</td>";
				echo "<td>Naziv ustanove</td>";
				//echo "<td>ID broj</td>";
				echo "<td>Prezime</td>";
				echo "<td>Ime</td>";
				echo "<td>Broj osiguranika</td>";
				//echo "<td>Broj pošte</td>";
				//echo "<td>Naziv pošte</td>";
				echo "<td>Ulica</td>";
				echo "<td>Kućni broj</td>";
				echo "<td>Grad</td>";
				echo "</tr>";
				foreach ($json_a as $person_name => $person_a) {
					if ($person_a['ime']==$ime or $person_a['prezime']==$prezime) {
						echo "<tr>";
						//echo "<td> {$person_a['id']} </td>";
						//echo "<td> {$person_a['podrucni_ured']} </td>";
						//echo "<td> {$person_a['sifra_ustanove']} </td>";
						echo "<td> {$person_a['naziv_ustanove']} </td>";
						//echo "<td> {$person_a['id_broj']} </td>";
						echo "<td> {$person_a['prezime']} </td>";
						echo "<td> {$person_a['ime']} </td>";
						echo "<td> {$person_a['broj_osiguranika']} </td>";
						//echo "<td> {$person_a['broj_poste']} </td>";
						//echo "<td> {$person_a['naziv_poste']} </td>";
						echo "<td> {$person_a['ulica']} </td>";
						echo "<td> {$person_a['kucni_broj']} </td>";
						echo "<td> {$person_a['grad']} </td>";
					    echo "</tr>";
					}
				}
				echo "</table>";
	 		?>
	 		<br><br><button><a href="JSON.php">Povratak</a></button>
	 	</article>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>
</html>