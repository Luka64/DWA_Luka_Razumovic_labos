<!doctype html>
<html>
<head>
	<!-- <meta charset="UTF-8"> -->
	<title>Generiraj PDF | Zdravko Dren</title>

	<link rel="shortcut icon" href="../img/favicon.ico" />

	<link rel="stylesheet" href="../css/style.css">

</head>
<body>
<div class="sadrzajWrapper">
	<h3>Preuzmite PDF</h3>

	<?php

		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$krv1=$_POST['slovo'];
		$krv2=$_POST['znak'];
		$krvnaGrupa=$krv1.$krv2;

		require('../FPDF/fpdf.php');


		class PDF extends FPDF
		{

		function Header()
		{
		    $this->SetFont('Arial','B',15);
		    $this->Cell(80);
		    $this->Cell(20,40,"Generirani PDF ",0,0,'C');
			$this->SetFont('Arial','B',9);
		    $this->Ln(20);
		}

		function Footer()
		{
		   
		}

		function LoadData($file)
		{
			
			$lines=file($file);
			$data=array();
			foreach($lines as $line)
			$data[]=explode(';',chop($line));
			return $data;
		}

		function BasicTable($header,$data)
		{ 

		$this->SetFillColor(51,204,102);
		$this->SetDrawColor(0,0,0);
		$w=array(20,20,20);

			
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			
			foreach ($data as $eachResult) 
			{ 
				$this->Cell(20,6,$eachResult["ime"],1);
				$this->Cell(20,6,$eachResult["prezime"],1);
				$this->Cell(20,6,$eachResult["krvnaGrupa"],1);
				$this->Ln();
				 	 	 	 	
			}
		}

		}

		$pdf=new PDF();
		$header=array('Ime','Prezime','Krvna grupa');

		include '../skripte/veza.php';

		$strSQL = "SELECT ime, prezime, krvnaGrupa FROM $tbl_name WHERE ime = '$ime' OR prezime = '$prezime' or krvnaGrupa = '$krvnaGrupa'";
		$objQuery = mysql_query($strSQL);
		$resultData = array();
		for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
			$result = mysql_fetch_array($objQuery);
			array_push($resultData,$result);
		}

		function forme()

		{
			echo "PDF uspjesno generiran. Preuzmite ga <a href=../pacijenti.pdf target='_blank'>OVDJE</a>";
		}


		$pdf->SetFont('Arial','',6);

		$pdf->AddPage();
		$pdf->Ln(35);
		$pdf->BasicTable($header,$resultData);
		forme();
		$pdf->Output("../pacijenti.pdf","F");

	?>
	</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>



</body>
</html>