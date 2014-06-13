<?php
  session_start();
  if (!isset($_SESSION['idKorisnika'])) {
    header("location: ../index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	

  <link rel="shortcut icon" href="../img/favicon.ico" />

  
  <title>Popis pacijenata | Zdravko Dren</title>

  <!-- Učitavanje stilskih datoteka -->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/grid.css" />
  <link rel="stylesheet" href="../css/stil.css" />

  <!-- Fix za mobitele -->
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">

  <!-- Učitavanje ikona -->
  <!--<link rel="stylesheet" href="css/fontello.css">-->

	<?php
		include '../skripte/veza.php';

		//Ispis unešenih pacijenata
		$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name");
		$redovi=mysql_num_rows($dohvat);

		mysql_close($connection);
	?>
	

</head>
<body onload="prvi(0)">
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
 				<li><a href="osobni_podaci.php">Osobni podaci</a></li>

 				<br><br>
 				<li><a href="popis_pacijenata.php">Popis pacijenata</a></li>
 				<li><a href="unos_pacijenta.php">Dodaj novog pacijenta</a></li>
 				<li><a href="#">Popis unešenih pacijenata</a></li>
 				<li><a href="pdf_forma.php">Generiraj PDF</a></li>
 				<li><a href="generirajGraf.php">Generiraj Graf</a></li>
 				<li><a href="JSON.php">Doktori</a></li>
 				<li><a href="temp.php">Mobile form</a></li>
 			</ul>
 		</nav>	
	 	<article class="sadrzaj">
	 		<nav class="osobniPodaci">
	 			<ul>
	 				<li><a href="popis_unesenih_pacijenata.php">Tablica</a></li>
	 				<li class="margin-left"><a href="#">JSON</a></li>
	 				<li class="margin-left"><a href="popis_unesenih_pacijenata_AJAX.php">AJAX</a></li>
	 			</ul>
	 		</nav><br><br><br><br>
	 		<div onLoad="prvi(0)" style="visibility: hidden;"></div>
	 		Osoba #: <span id="id"></span><br>
	 		Ime: <span id="ime"></span><br>
	 		Prezime: <span id="prezime"></span><br>
	 		Krvna grupa: <span id="krvnaGrupa"></span><br><br>
	 		<span id="prvi" style="margin-left: 40px;"></span>/<span id="drugi"></span><br><br>
	 		<button id="button1" onClick="prvi(0)" class="JSONbutton">&lt;&lt;</button>
	 		<button id="button2" onClick="prethodni(--i)" class="JSONbutton">&lt;</button>
	 		<button id="button3" onClick="sljedeci(++i)" class="JSONbutton" style="margin-left: 10px;">&gt;</button>
	 		<button id="button4" onClick="zadnji()" class="JSONbutton" style="margin-left: 0px;">&gt;&gt;</button>
	 		<br><br><br>


	 	</article>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>
<script type="text/javascript">
	<?php
		$rs = array();
		while($rs[] = mysql_fetch_assoc($dohvat)) {
			// you don´t really need to do anything here.
		}
		echo "var a=". json_encode($rs).";";
	?>
	var i=0;
	var redovi = "<?= $redovi ?>"

	function prvi(prviVar){
		i=prviVar;
		document.getElementById("id").innerHTML=i+1;
		document.getElementById("ime").innerHTML=a[i].ime;
		document.getElementById("prezime").innerHTML=a[i].prezime;
		document.getElementById("krvnaGrupa").innerHTML=a[i].krvnaGrupa;
		document.getElementById("prvi").innerHTML=i+1;
		document.getElementById("drugi").innerHTML=redovi;
		document.getElementById("button1").disabled = true;
		document.getElementById("button1").className = "disabledButton";
		document.getElementById("button2").disabled = true;
		document.getElementById("button2").className = "disabledButton";
		document.getElementById("button3").disabled = false;
		document.getElementById("button3").className = "JSONbutton";
		document.getElementById("button4").disabled = false;
		document.getElementById("button4").className = "JSONbutton";
	}

	function sljedeci(z){
		if (z>=redovi){ i=red-1;};
		if (z<redovi){
			document.getElementById("id").innerHTML=z+1;
			document.getElementById("ime").innerHTML=a[z].ime;
			document.getElementById("prezime").innerHTML=a[z].prezime;
			document.getElementById("krvnaGrupa").innerHTML=a[z].krvnaGrupa;
			document.getElementById("prvi").innerHTML=z+1;
			document.getElementById("drugi").innerHTML=redovi;
			document.getElementById("button1").disabled = false;
			document.getElementById("button1").className = "JSONbutton";
			document.getElementById("button2").disabled = false;
			document.getElementById("button2").className = "JSONbutton";
		};
		if (z+1==redovi) {
			document.getElementById("button3").disabled = true;
			document.getElementById("button3").className = "disabledButton";
			document.getElementById("button4").disabled = true;
			document.getElementById("button4").className = "disabledButton";
		};
	}

	function prethodni(z){
		if (z<0){ i=0;};
		if (z>=0){
			document.getElementById("id").innerHTML=z+1;
			document.getElementById("ime").innerHTML=a[z].ime;
			document.getElementById("prezime").innerHTML=a[z].prezime;
			document.getElementById("krvnaGrupa").innerHTML=a[z].krvnaGrupa;
			document.getElementById("prvi").innerHTML=z+1;
			document.getElementById("drugi").innerHTML=redovi;
			//alert("Predhodni");
		};
		if (z==0) {
			document.getElementById("button1").disabled = true;
			document.getElementById("button1").className = "disabledButton";
			document.getElementById("button2").disabled = true;
			document.getElementById("button2").className = "disabledButton";
		};
		if (z<redovi) {
			document.getElementById("button3").disabled = false;
			document.getElementById("button3").className = "JSONbutton";
			document.getElementById("button4").disabled = false;
			document.getElementById("button4").className = "JSONbutton";
		};
	}

	function zadnji(){
		i=redovi-1;
		document.getElementById("id").innerHTML=i+1;
		document.getElementById("ime").innerHTML=a[i].ime;
		document.getElementById("prezime").innerHTML=a[i].prezime;
		document.getElementById("krvnaGrupa").innerHTML=a[i].krvnaGrupa;
		document.getElementById("prvi").innerHTML=i+1;
		document.getElementById("drugi").innerHTML=redovi;
		document.getElementById("button1").disabled = false;
		document.getElementById("button1").className = "JSONbutton";
		document.getElementById("button2").disabled = false;
		document.getElementById("button2").className = "JSONbutton";
		document.getElementById("button3").disabled = true;
		document.getElementById("button3").className = "disabledButton";
		document.getElementById("button4").disabled = true;
		document.getElementById("button4").className = "disabledButton";
	}
</script>
</html>