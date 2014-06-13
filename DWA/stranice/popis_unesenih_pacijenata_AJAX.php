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
	

</head>
<body onload="start()">
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
	 				<li class="margin-left"><a href="popis_unesenih_pacijenata_JSON.php">JSON</a></li>
	 				<li class="margin-left"><a href="#">AJAX</a></li>
	 			</ul>
	 		</nav><br><br><br><br>
	 		<div id="ajax" style="display: none;"></div>

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

	 		<button id="buttonDohvat" onClick="dohvati()" class="JSONbutton" style="margin-left: 10px;">Dohvati pacijente</button>
	 		<br><br><br>


	 	</article>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>

<script>
	function start() {
		document.getElementById("button1").disabled = true;
		document.getElementById("button1").className = "disabledButton";
		document.getElementById("button2").disabled = true;
		document.getElementById("button2").className = "disabledButton";
		document.getElementById("button3").disabled = true;
		document.getElementById("button3").className = "disabledButton";
		document.getElementById("button4").disabled = true;
		document.getElementById("button4").className = "disabledButton";
	}

	function dohvati() {
		document.getElementById("button3").disabled = false;
		document.getElementById("button3").className = "JSONbutton";
		document.getElementById("button4").disabled = false;
		document.getElementById("button4").className = "JSONbutton";
		document.getElementById("buttonDohvat").disabled = true;
		document.getElementById("buttonDohvat").className = "disabledButton";

		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
	    	xmlhttp=new XMLHttpRequest();
	  	} else { // code for IE6, IE5
	    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		xmlhttp.onreadystatechange=function() {
	    	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	    		document.getElementById("ajax").innerHTML=xmlhttp.responseText;
	   		}
		}
		xmlhttp.open("POST","../skripte/AJAX.php",true);
		xmlhttp.send();

		var i=0;
	}



	var theDiv = document.getElementById("ajax");
	if(theDiv.innerHTML.length != 0){
		var a = document.getElementById("ajax").innerHTML;
		var b = a.slice(2);
		document.write(b);
	}


	
	function prvi(prviVar){
		var theDiv = document.getElementById("ajax");
		if(theDiv.innerHTML.length != 0){
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
	}

	function sljedeci(z){
		var theDiv = document.getElementById("ajax");
		if(theDiv.innerHTML.length != 0){
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
	}

	function prethodni(z){
		var theDiv = document.getElementById("ajax");
		if(theDiv.innerHTML.length != 0){
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
	}

	function zadnji(){
		var theDiv = document.getElementById("ajax");
		if(theDiv.innerHTML.length != 0){
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
	}


</script>
</html>