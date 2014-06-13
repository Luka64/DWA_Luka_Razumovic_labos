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
  <!--<meta name="viewport" content="width = device-width, initial-scale = 1.0">-->

  <!-- Učitavanje ikona -->
  <!--<link rel="stylesheet" href="css/fontello.css">-->

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

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
 		<nav style="width: 250px; float: left;">
 			<ul data-role="listview" data-ajax="false" data-inset="true" data-theme="a">
			    <li><a href="popis_pacijenata.php">Popis pacijenata</a></li>
			    <li><a href="unos_pacijenta.php">Dodaj novog pacijenta</a></li>
			    <li><a href="popis_unesenih_pacijenata.php">Popis unešenih pacijenat</a></li>
			    <li><a href="pdf_forma.php">Generiraj PDF</a></li>
			    <li><a href="generirajGraf.php">Generiraj Graf</a></li>
			    <li><a href="JSON.php">Doktori</a></li>
			    <li><a href="#">Mobile form</a></li>
			</ul>
 		</nav>	
	 	
        <div data-role="content">
            <form id="check-user" class="ui-body ui-body-a ui-corner-all" data-ajax="false" method="post" action="../skripte/m_mobileScript.php">
                <fieldset>
                    <div data-role="fieldcontain">
                        <label for="ime">Ime</label>
                        <input type="text" value="" name="ime" id="ime"/>
                    </div>                                 
                    <div data-role="fieldcontain">                                     
                        <label for="prezime">Prezime</label>
                        <input type="password" value="" name="prezime" id="prezime"/>
                    </div>
                    <div data-role="fieldcontain">                                     
                        <label for="slovo">Krvna grupa</label>
                        <select name="slovo" id="slovo">
                        	<option value="">Slovo</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="AB">AB</option>
							<option value="O">O</option>
						</select>
                    </div>
                    <div data-role="fieldcontain">                                     
                        <label for="znak"></label>
						<select name="znak" id="znak">
							<option value="">Znak</option>
							<option value="+">+ (pos)</option>
							<option value="-">- (neg)</option>
						</select>
                    </div>
                    <input type="submit" data-theme="b" name="submit" id="submit" value="Submit">
                </fieldset>
            </form>                             
        </div>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>
</html>