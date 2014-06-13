 <?php

 	include 'veza.php';
	
	//uzimanje i spremanje varijabli username i password POST metodom
	$username=$_POST['username'];
	$password=$_POST['password'];
	//pretvaranje passworda u md5 string radi veće sigurnosti
	$passwordMD5=md5($password);


	//Dohvat id korisnika
	$idUpit=mysql_query("SELECT idAccount FROM $tbl3_name WHERE username = '$username' AND pass = '$passwordMD5'");
	$fetch_idUpit=mysql_fetch_array($idUpit);
	$idKorisnika=$fetch_idUpit[0];


	//Dohvat imena i prezimena korisnika
	$idUpit=mysql_query("SELECT ime, prezime FROM $tbl3_name WHERE username = '$username' AND pass = '$passwordMD5'");
	$fetch_idUpit=mysql_fetch_array($idUpit);
	$ime=$fetch_idUpit[0];
	$prezime=$fetch_idUpit[1];


	//Na temelju id-a, tj. korisničkog imena i lozinke, korisnika preusmjeravamo na određenu stranicu
	if (isset($idKorisnika)){
		session_start();
		$_SESSION['ime']=$ime;
		$_SESSION['prezime']=$prezime;
		$_SESSION['idKorisnika']=$idKorisnika;
		header("Location: ../stranice/osobni_podaci.php");
	}else{
		header("Location: ../stranice/neispravanUnos.php");
	}
	mysql_close($connection);
?>