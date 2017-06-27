<?php
	echo ("***Validar Usuario*** <br>");

	if(!isset($_POST['acnt'])){
		header("location: login.php");
	}

	$acount = $_POST['acnt'];
	$pass = $_POST['pass'];

	//echo ($acount."<br>".$pass);

	include("_conexion.php");
	$sql = "CALL `ValidarUsuario`('".$acount."', '".$pass."');";
	$result = mysql_query($sql, $conexion);

	if($result != null){
		$row = mysql_fetch_assoc($result);

		session_start();
		$_SESSION['user']  = $row['nombre'];
		$_SESSION['nivel'] = $row['nivel'];
		header('Location: index.php');
						
	}else{
		header("location: login.php?x=i");
	}
?>