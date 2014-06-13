<?php

  session_start();
  include 'veza.php';

  if (!isset($_SESSION['idKorisnika'])) {
    header("location: index.php");
  }
  
  $imeVar=$prezimeVar=$slovoVar=$znakVar=$krvVar=0;

  if (!empty($_POST['ime'])) {
  	$ime=$_POST['ime'];
  	$ime=mysql_real_escape_string($ime, $connection);
  	$imeVar=1;
  }
  if (!empty($_POST['prezime'])) {
  	$prezime=$_POST['prezime'];
  	$prezime=mysql_real_escape_string($prezime, $connection);
  	$prezimeVar=1;
  }

  if (!empty($_POST['slovo'])) {
  	$slovo=$_POST['slovo'];
  	$slovo=mysql_real_escape_string($slovo, $connection);
	$slovoVar=1;
	//echo "";
  }
  if (!empty($_POST['znak'])) {
  	$znak=$_POST['znak'];
  	$znak=mysql_real_escape_string($znak, $connection);
  	$znakVar=1;
  	//echo "";
  }


  if ($slovoVar==1 AND $znakVar==1) {
  	$krvVar=1;
  	$krv=$slovo.$znak;
  }

  //SQL upit prema unešenim parametrima
  if ($imeVar==1 && $prezimeVar==1 && $krvVar==1) {
  	//sve
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE ime = '$ime' AND prezime = '$prezime' AND krvnaGrupa = '$krv'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }elseif ($imeVar==0 && $prezimeVar==1 && $krvVar==1) {
  	//prezime, krvna grupa
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE prezime = '$prezime' AND krvnaGrupa = '$krv'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }elseif ($imeVar==1 && $prezimeVar==0 && $krvVar==1) {
  	//ime, krvna grupa
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE ime = '$ime' AND krvnaGrupa = '$krv'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }elseif ($imeVar==1 && $prezimeVar==1 && $krvVar==0) {
  	//ime, prezime
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE ime = '$ime' AND prezime = '$prezime'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }elseif ($imeVar==1 && $prezimeVar==0 && $krvVar==0) {
  	//ime
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE ime = '$ime'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }elseif ($imeVar==0 && $prezimeVar==1 && $krvVar==0) {
  	//prezime
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE prezime = '$prezime'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }elseif ($imeVar==0 && $prezimeVar==0 && $krvVar==1) {
  	//krvna grupa
  	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE krvnaGrupa = '$krv'");
	$redovi=mysql_num_rows($dohvat);
	mysql_close($connection);
  }else{
  	header ('location: ../stranice/form.php');
  }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ispis pacijenata</title>
</head>
<body onload="prvi(0)">
 
            <div style="visibility: hidden;"></div>
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