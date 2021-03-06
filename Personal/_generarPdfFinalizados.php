<?php
echo ("***generara pdf***");

require_once('lib/mpdf60/mpdf.php');

include("_conexion.php");

if(!isset($_POST['id'])){
	header('Location: _error.php');
}
$folio = $_POST['id'];

$sql =  "CALL `ObtenerDatosSeguimiento`('".$folio."');";

$nombre;
$carrera;
$nControl;
$sol;
$autori;


$result = mysql_query($sql,$conexion);

if($result != null){
	while ($row = mysql_fetch_assoc($result)){
		$nombre = $row['nom_alumno']." ".$row['ape_paterno']." ". $row['ape_materno'];
		$nControl = $row['num_control'];
		$carrera = $row['nom_carrera'];
		$sol= $row['peticion'];
		if($row['status'] == 5){
			$autori = "AUTORIZA";
		}
		if($row['status'] == 4){
			$autori = "RECHAZA";
		}
	}
}else{
	header('Location: _error.php');
}

$html = "	<html>
				<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
					<title></title>
					<style type='text/css'>

						h3,h4{font-family:'Arial','sans-serif'; }

						.fecha{
							font-family:'Arial','sans-serif';
							font-size: 12px;
						}
						.destinatario{
							font-family:'Arial','sans-serif';
							font-size: 14px;
						}

						.contenido{
							font-family:'Arial','sans-serif';
							font-size: 14px;
						}
						.firma{
							font-family:'Arial','sans-serif';
							font-size: 18px;
							font-weight: bold;
						}
						
						footer{	
							font-size: 9px; 
						}

						</style>
				</head>

				<body>
					
					<div style='text-align:justify; height:90%;'>
						<div>
							<img align='center' src='img/logo.jpg' style='width: 100%; height: auto;'>
						</div>

						<br>

						<h3 align=center>
							INSTITUTO TECNOLÓGICO DE CD. VICTORIA
						</h3>
						<h4 align='center'>
							DICTAMEN OFICIAL
						</h4>

						<br>

						<p class='fecha'>Cd. Victoria, Tam., a ". date("d M Y")."</p>

						<br>

						<p class='destinatario'>	Dra.  Araceli Maldonado Reyes <br>Subdirectora Académica <br> P r e s e n t e </p>

						<h4>Folio: ".$folio."</h4>

						<p class='contenido'>
							Por este conducto y atendiendo la recomendación del Comité Académico comunico a usted, que se <u>".$autori."</u> la solicitud del interesado: <u>".$nombre."</u>, de la carrera  de <u>".$carrera." </u> , con número de control <u>".$nControl."</u> que solicito: <u>".$sol."</u>. 
							<br>Sin otro particular por el momento, quedo de Usted.
						</p>

						<br>	<br>
						<p class='contenido' align=center> Atentamente</p>
						
						<br><br>
						
						<p class='firma' align='center'> _______________________________<br> Ing. Fidel Aguillón Hernández <br> Director </p>

						<h5> c.c.p.	Interesado </h5>
											
					</div>

					<footer>
						<p align=center>
							Bldv. Emilio Portes Gil No. 1301 Pte. C.P. 87010 Cd. Victoria, Tamaulipas <br>
							Tels. (834) 153 2000, Ext. 180.  e-mail: direccion@itvictoria.edu.mx <br>
							www.itvictoria.edu.mx
						</p>
					</footer>

				</body>
				</html>";

$mpdf = new mPDF('c','A4');
$mpdf->writeHTML($html);
$mpdf->Output('Solicitud.pdf','I');

?>