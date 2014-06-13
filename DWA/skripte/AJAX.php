<?php
	include '../skripte/veza.php';

	//Ispis unešenih pacijenata
	$dohvat=mysql_query("SELECT ime, prezime, krvnaGrupa FROM $tbl_name");
	
	$rs = array();
	while($rs[] = mysql_fetch_assoc($dohvat)) {}
	$final = json_encode($rs);

	mysql_close($connection);

	echo $final;

?>