<?php
echo ("***generara pdf***");

require_once('lib/mpdf60/mpdf.php');
include("_conexion.php");

if(!isset($_POST['id'])){
	header('Location: index.php');
}
$folio = $_POST['id'];

$sql =  "CALL `ObtenerDatosSeguimiento`('".$folio."');";

$nombre;
$semestre;
$carrera;
$nControl;
$sol;

$result = mysql_query($sql,$conexion);

if($result != null){
	while ($row = mysql_fetch_assoc($result)){
		$nombre = $row['nom_alumno']." ".$row['ape_paterno']." ". $row['ape_materno'];
		$semestre = $row['semestre'];
		$nControl = $row['num_control'];
		$carrera = $row['nom_carrera'];
		$sol= $row['peticion'];
	}
}else{
	header('Location: _error.php');
}



$html = "
			<html>
			<head>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
				<title>Solicitud al Comite Academico</title>
				<style>
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
					<img align='center' src='img/logo.jpg' style='width: 100%; height: auto;'>
				<br>

				<h3 align=center>
					Solicitud para el análisis del Comité Académico
				</h3>

				<br>	<br>

				<p class='fecha'>Cd. Victoria, Tam., a ". date("d M Y")."</p>

				<br>
				<p class='destinatario'>ING. JOSÉ RAÚL RUIZ ZAVALA <br>Jefe de la División de Estudios Profesionales <br> P r e s e n t e </p>

				<h4>Folio: ".$folio."</h4>

				<br>

				<p class='contenido'>
					Alumno C.: <small><u>".$nombre."</u></small>, del semestre <small><u>".$semestre."</u></small>, de la Carrera de: <small><u>".$carrera."</u></small>, con número de Control: <small><u>".$nControl." </u></small>.<br>
					Solicita de la manera más atenta: <small><u>".$sol." </u></small>.
				</p>

				<br>	<br>

				<p class='contenido'>
					En reunión  del comité Académico en virtud de haber sido analizada la situación del estudiante concluyo en: <br>
					_______________________________________________________________________________________<br>
					_______________________________________________________________________________________<br>
					_______________________________________________________________________________________<br>
				</p>
				
				<br>
					
				<p class='contenido'> Con los comentarios: <br>
					_______________________________________________________________________________________<br>
					_______________________________________________________________________________________
				</p>

				<br> 
 			
			</div>

				<footer>
					c.c.p.	Interesado
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