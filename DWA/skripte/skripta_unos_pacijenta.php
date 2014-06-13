<?php
	
	include 'veza.php';

	//lokalne varijable
	$ime=$_POST['firstName'];
	$prezime=$_POST['lastName'];
	$spol=$_POST['gender'];
	$datumRodjenja=$_POST['birthDate'];
	$mjestoRodjenja=$_POST['birthPlace'];
	$mjestoStanovanja=$_POST['address'];
	$krv1=$_POST['slovo'];
	$krv2=$_POST['znak'];
	$krvnaGrupa=$krv1.$krv2;
	$tegobeDaNe=$_POST['illnes'];
	$tegobeOpis=$_POST['tegobbe'];
	$lijekovi=$_POST['vacine'];

	mysql_query("INSERT INTO $tbl_name (ime, prezime, spol, datumRodjenja, mjestoRodjenja, adresaStanovanja, krvnaGrupa, prijasnjeTegobe, tegobe, lijekovi) VALUES ('$ime', '$prezime', '$spol', '$datumRodjenja', '$mjestoRodjenja', '$mjestoStanovanja', '$krvnaGrupa', '$tegobeDaNe', '$tegobeOpis', '$lijekovi')");
	mysql_close($connection);
	header("location: unos_pacijenta.php");
?>