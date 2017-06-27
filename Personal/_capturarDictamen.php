<?php
	if(!isset($_POST['folio'])){
		header('Location: index.php');
	}

	$folio = $_POST['folio'];
	$dictamen = $_POST['Dic'];
	$com = $_POST['Com'];
	$res = $_POST['res'];
	$status = 3;

	switch ($res) {
	    case 'Aprobado':
	        $status = 5;
	        break;
	    case 'Rechazado':
	        $status = 4;
	        break;
	}
	
	//echo ("**".$folio."<br>**". $dictamen."<br>**".$com."<br>**".$res."<br>**".$status);
	include("_conexion.php");
	$sql = "CALL `CapturarDictamen`('".$folio."','".$dictamen."','".$com."',".$status."); ";
	
	$result = mysql_query($sql,$conexion);
	
	if($result != null){
		while($row = mysql_fetch_assoc($result)):
			echo "Folio: "+$row['folio'];
			header('Location: solActivas.php');

		endwhile;
	}else{
		echo "Sin datos, No se pudo agregar la peticion";
		header('Location: _error.php');
	}
	
?>	