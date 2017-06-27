<?php
	include("_conexion.php");

	$dia  = date("Y-m-d");
	/*
	SET @p0='12380809'; 
	SET @p1='sinNombre'; 
	SET @p2='sinApellido'; 
	SET @p3='sinApellido2'; 
	SET @p4='4'; 
	SET @p5='7.9'; 
	SET @p6='2016-12-17'; 
	SET @p7='rgresar a primero'; 
	SET @p8='1'; 
	SET @p9='8'; 
	CALL `NuevaSol`(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9); */
	$carrera = 1;
	switch ($_POST["carrera"]) {
	    case 'Ing. en Gestión Empresarial':
	        $carrera = 1;
	        break;
	    case 'Ing. en Sistemas Computacionales':
	        $carrera = 2;
	        break;
	    case 'Ing. en Energías Renovables':
	        $carrera = 3;
	        break;
	    case 'Ing. Electrónica':
	        $carrera = 4;
	        break;
	    case 'Ing. Civil':
	        $carrera = 5;
	        break;
	    case'Ing. Industrial':
	        $carrera = 6;
	        break;
	    case 'Lic. en Informatica':
	        $carrera = 7;
	        break;
	}

	switch ($_POST["mot"]) {
	    case 'Academicos':
	        $razon = 1;
	        break;
	    case 'Personales':
	        $razon = 2;
	        break;
	    case 'Otros':
	        $razon = 3;
	        break;
	}

	$nombre =  $_POST["nombre"];
	$apP =  $_POST["apP"];
	$apM =  $_POST["apM"];
	$ncontrol = $_POST["ncontrol"];
	$prom = $_POST["prom"];
	$semestre = $_POST["semestre"];
	$soli = $_POST["soli"];


	echo($nombre ."<br>".$apP ."<br>".$apM ."<br>".$ncontrol ."<br>".$prom ."<br>".$semestre ."<br>".$carrera."<br>". $soli."<br>". $razon. "<br><br>");

	$sql = "CALL NuevaSol(".$ncontrol.",'".$nombre."','".$apP."','".$apM."','".$carrera."' , ".$prom.",'".$dia."' ,'".$soli."',".$razon.", ".$semestre."); ";

	$result = mysql_query($sql,$conexion);
	
	if($result != null){
		while($row = mysql_fetch_assoc($result)):
			echo "Folio: "+$row['folio'];
			session_start();
			$_SESSION["folio"] = $row['folio'];
			header('Location: solEnviada.php');

		endwhile;
	}else{
		echo "Sin datos";
		header('Location: errorBaseDatos.php');
	}


?>