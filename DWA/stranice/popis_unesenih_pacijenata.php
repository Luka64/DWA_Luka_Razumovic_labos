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
	 				<li><a href="#">Tablica</a></li>
	 				<li class="margin-left"><a href="popis_unesenih_pacijenata_JSON.php">JSON</a></li>
	 				<li class="margin-left"><a href="popis_unesenih_pacijenata_AJAX.php">AJAX</a></li>
	 			</ul>
	 		</nav><br><br><br><br>
	 		<input type="search" class="tableSearch" data-table="popisPacijenataTable" placeholder="Search"><br><br>
				<?php
					include '../skripte/veza.php';

					//Ispis unešenih pacijenata
					$dohvat=mysql_query("SELECT ime, prezime, spol, DATE_FORMAT(datumRodjenja, '%d.%m.%Y.') AS datumRodjenja, mjestoRodjenja, adresaStanovanja, krvnaGrupa, prijasnjeTegobe, tegobe, lijekovi FROM $tbl_name");
					$broj=mysql_num_rows($dohvat);
				    echo "<div>";
				    echo <<< EOT
				        <table border="1" class="popisPacijenataTable popis" style="border-collapse:collapse;" id="dataTable">
				        	<tr>
					            <td> Ime: </td>
					            <td> Prezime: </td>
					            <td> Spol: </td>
					            <td> Datum rođenja: </td>
					            <td> Mjesto rođenja: </td>
					            <td> Adresa stanovanja: </td>
					            <td> Krvna grupa: </td>
					            <td> Prijasnje tegobe: </td>
					            <td> Tegobe: </td>
					            <td> Lijekovi: </td>
				        	</tr>
EOT;

			        for($i=0; $i<$broj; $i++){
			        	$row=mysql_fetch_array($dohvat);
			        	echo <<< EOT
			          	<tr class='red'>
			            	<td> {$row['ime']} </td>
				            <td> {$row['prezime']} </td>
				            <td> {$row['spol']} </td>
				            <td> {$row['datumRodjenja']} </td>
				            <td> {$row['mjestoRodjenja']} </td>
				            <td> {$row['adresaStanovanja']} </td>
				            <td> {$row['krvnaGrupa']} </td>
				            <td> {$row['prijasnjeTegobe']} </td>
				            <td> {$row['tegobe']} </td>
				            <td> {$row['lijekovi']} </td>
			          	</tr>
EOT;
      				}
    				echo "</table></div>";

		
					mysql_close($connection);
				?>
			</table>
	 	</article>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>

	<script type="text/javascript">
	
	(function(document) {
	'use strict';
	var LightTableFilter = (function(Arr) {
		var _input;
		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}
		function _filter(row) {
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}
		return {
			init: function() {
				var inputs = document.getElementsByClassName('tableSearch');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);
	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});
})(document);
</script>
</body>
</html>