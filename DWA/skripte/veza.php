<?php
	$db_host="localhost"; // Host name
	$db_username="root"; // Mysql username
	$db_password="root"; // Mysql password
	$db_name="dwa"; // Database name
	$tbl_name="uneseniPacijenti"; // Table uneseniPacijenti
	$tbl2_name="pacijenti"; // Table pacijenti
	$tbl3_name="account"; // Table account

	//stvaranje mysql konekcije i odabir mysql baze podataka
	$connection=mysql_connect($db_host, $db_username, $db_password)
		or die("Neuspjelo spajanje na bazu podataka!");
	$database_select=mysql_select_db($db_name, $connection)
		or die("Pogreška pri odabiru baze podataka!");

	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

?>