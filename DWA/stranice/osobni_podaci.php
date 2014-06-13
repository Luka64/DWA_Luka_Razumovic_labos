<?php
  session_start();
  if (!isset($_SESSION['idKorisnika'])) {
    header("location: ../index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
			
			function skriveni_div (id) {
			
				var divelement=document.getElementById(id);
			
				if(divelement.style.display == 'none')
					divelement.style.display = 'block';
					
				else
					divelement.style.display = 'none';
					}
			
		</script>

  <!--<link rel="shortcut icon" href="img/favicon.ico" />-->
  
  <meta charset="UTF-8" />
  <title>Osobni podaci | Zdravko Dren</title>

  <link rel="shortcut icon" href="img/favicon.ico" />

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
 				<li><a href="popis_pacijenata.php">Popis pacijenata</a></li>
 				<li><a href="unos_pacijenta.php">Dodaj novog pacijenta</a></li>
 				<li><a href="popis_unesenih_pacijenata.php">Popis unešenih pacijenata</a></li>
 				<li><a href="pdf_forma.php">Generiraj PDF</a></li>
 				<li><a href="generirajGraf.php">Generiraj Graf</a></li>
 				<li><a href="JSON.php">Doktori</a></li>
 				<li><a href="temp.php">Mobile form</a></li>
 			</ul>
 		</nav>	
	 	<article class="sadrzaj">
	 		<nav class="osobniPodaci">
	 			<ul>
	 				<li><a href="#osobni_podaci">Osobni podaci</a></li>
	 				<li class="margin-left"><a href="#podaci_o_skolovanju">Podaci o školovanju</a></li>
	 				<li class="margin-left"><a href="#znanja_i_vjestine">Znanja i vještina</a></li>
	 			</ul>
	 		</nav><br><br><br><br>
	 		<p>ZKD j.d.o.o.<br>Zdravko Dren</p><br>
	 		<br>Za skrivanje/prikazivanje sadržaja, kliknite na naslove!

	 		<h4 onClick="skriveni_div('reklama_div');">Reklama:</h4>
	 		<div id='reklama_div' class="reklamaStil">Reklama</div><br><br>
	 		
	 		<h4 onClick="skriveni_div('osobni_podaci');">Osobni podaci:</h4>
	 		<div id='osobni_podaci'>Ime i prezime: Luka Razumović<br>Mjesto rođenja: Požega<br>Datum rođenja: 12.2.1993.</div>

	 		<br><h4 onClick="skriveni_div('podaci_o_skolovanju');">Podaci o školovanju:</h4>
	 		<div id='podaci_o_skolovanju'>Osnovna škola: Osnovna škola \"Mladost\", Jakšić<br>Srednja škola: Teknička škola, Požega<br>Fakultet: Tehničko veleučilište u Zagrebu, smjer Računarstvo</div>

	 		<br><h4 onClick="skriveni_div('znanja_i_vjestine');">Znanja i vještine:</h4>
			<div id='znanja_i_vjestine'>Položen vozački ispit, 'B' kategorije<br>- Poznavanje rada na računalu(Microsoft Office, rad sa MySQL bazama podataka, programiranje u PHP-u)</div>
	 	</article>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>
</html>