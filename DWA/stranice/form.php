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
        <li><a href="JSON.php">Doktori</a></li>
        <li><a href="temp.php">Mobile form</a></li>
      </ul>
    </nav>
      <table border="0" style="border-collapse: collapse;">
        <tr>
          <td>
            <form id="check-user" class="ui-body ui-body-a ui-corner-all" data-ajax="false" method="post" action="../skripte/mobileScript.php">
            <label for="ime">Ime</label>
          </td>
          <td colspan="2">
            <input type="text" value="" name="ime" id="ime"/>
          </td>
        </tr>
        <tr>
          <td>
            <label for="prezime">Prezime: </label>
          </td>
          <td colspan="2">
            <input type="password" value="" name="prezime" id="prezime"/>
          </td>
        </tr>
        <tr>
          <td>
            <label for="slovo">Krvna grupa</label>
          </td>
          <td style="width: 66px;">
            <select name="slovo" id="slovo">
                <option value="">Slovo</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
              </select>
          </td>
          <td>
            <span style="margin-left: 10px;">
              <select name="znak" id="znak">
                <option value="">Znak</option>
                <option value="+">+ (pos)</option>
                <option value="-">- (neg)</option>
              </select>
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <span style="margin-left: 100px;">
              <input type="submit" data-theme="b" name="submit" id="submit" value="Submit">
              </form>
            </span>  
          </td>
        </tr>
      </table>
	</section>

	<footer class="row footer2">
	    <div class="footer-text">
	      <p>Copyright <b>ZDK, 2014</b></p>
	    </div>
	</footer>
</body>
</html>