<?php 
	include("_obtenerNuevasSol.php");
	include("head.html");
	
	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login.php");
	}

	if(!isset($_GET['folio'])){
		header('Location: index.php');
	}

	$folio = $_GET['folio'];

	include("head.html");
	include("_conexion.php");
	
	$nombre;
	$numControl;
	$carrera;
	$semestre;
	$fechaSolicitud;
	$solic;
	$status;
	$razon;
	$dictamen;
	$fechaReunion;

	$sql = "CALL `ObtenerDatosSeguimiento`(".$folio.");";
		$result = mysql_query($sql,$conexion);
		if($result != null){
			while ($row = mysql_fetch_assoc($result)){
				$nombre = $row['nom_alumno']." ".$row['ape_paterno']." ".$row['ape_materno'];
				$numControl = $row['num_control'];
				$carrera = $row['nom_carrera'];
				$semestre = $row['semestre'];
				$fechaSolicitud = $row['fechaSolicitud'];
				$solic = $row['peticion'];
				switch ($row['status']) {
					case 1:
						$status = "Pendiente";
					break;
					case 2:
						$status = "Cancelada";
					break;
					case 3:
						$status = "En Proceso";
					break;
					case 4:
						$status = "Rechazada";
					break;
					case 5:
						$status = "Aprobada";
					break;
				}
				switch ($row['id_razon']) {
					case 1:
						$razon = "Academicos";
					break;
					case 2:
						$razon = "Personales";
					break;
					case 3:
						$razon = "Otros";
					break;
				}
				$dictamen = $row['dictamen'];
				if($row['fecha'] == '2000-01-01'){
					$fechaReunion = "Sin Capturar";
				}else{
					$fechaReunion = $row['fecha'];
				}
			}
		}
?>

<!DOCTYPE html>
	<html>
<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"> 
	   	<div class="collapse navbar-collapse navbar-ex1-collapse"> 
	      	<ul class="nav navbar-nav"> 
		      	<?php if($_SESSION['nivel']>1){ echo ("
         		<li><a href='nuevasSolicitudes.php'>Nuevas Solicitudes (".$nuevas.")</a></li>
         		<li><a href='nuevaSolic.php'>Nueva Solicitud</a></li>");}?>
         		<li><a href="solActivas.php">Solicitudes Activas</a></li> 
         		<li><a href="Solicitudes.php">Historial Solicitudes</a></li> 
         		<li><a href="Busqueda.php">Busar Solicitud</a></li> 
	         	<li><a href="index.php">Ver Calendario</a></li> 
	        </ul>

	       	<ul class="nav navbar-nav navbar-right">
	       		<li>
		      		<a href="configuracion.php" class="navbar-link"><span class="glyphicon glyphicon-cog"></span> Configuracion</a>
		      	</li>

		    	<li>
			      	<p class="navbar-text pull-right">
						<b>Conectado:</b> <?php echo($_SESSION['user']);?>
						<a href="_logout.php" class="navbar-link"><span class="glyphicon glyphicon-log-out" style="padding-right: 30px;"></span></a>
					</p>
		      	</li>
		    </ul>
		</div> 
	</nav>  

	<div class="container-fluid" >
		<br>
		<center><H2>Descripcion Solicitud</H2></center>
		
		<div class="col-sm-offset-2 col-sm-2"><h4>Folio:</h4></div>
		<div class="col-sm-6 well" ><?php echo($folio);?></div>
		
		<div class="col-sm-offset-2 col-sm-2"><h4>Nombre:</h4></div>
		<div class="col-sm-6 well" ><?php echo($nombre);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Numero de Control:</h4></div>
		<div class="col-sm-6 well" ><?php echo($numControl);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Carrera:</h4></div>
		<div class="col-sm-6 well" ><?php echo($carrera);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Semestre:</h4></div>
		<div class="col-sm-6 well" ><?php echo($semestre);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Fecha en la que se hizo la Solicitud:</h4></div>
		<div class="col-sm-6 well" ><?php echo($fechaSolicitud);?></div>
		
		<div class="col-sm-offset-2 col-sm-2"><h4>Solicita:</h4></div>
		<div class="col-sm-6 well"><?php echo($solic);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Status:</h4></div>
		<div class="col-sm-6 well" ><?php echo($status);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Razon de la Solicitud:</h4></div>
		<div class="col-sm-6 well" ><?php echo($razon);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Dictamen:</h4></div>
		<div class="col-sm-6 well" ><?php echo($dictamen);?></div>

		<div class="col-sm-offset-2 col-sm-2"><h4>Fecha de la Reunion:</h4></div>
		<div class="col-sm-6 well" ><?php echo($fechaReunion);?></div>

		</div>

		<br><br><br><div/>

</body>
</html>