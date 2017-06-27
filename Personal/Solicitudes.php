<!DOCTYPE html>

<?php 
	include("head.html");
	include("_obtenerNuevasSol.php");

	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login.php");
	}

	function imprimirBotones($Id){
		echo ("<th>
				<form name='form3".$Id."' method='post' action='editarDatosFinalizados.php'>
				 	<input type='hidden' name='id' value='".$Id."'/>
					<input type='submit' name='btnEditar' style='font-size: 10px; width:100%;' value='Editar Datos'/>
				</form>
				<form name='form4".$Id."' method='post' action='_generarPdfFinalizados.php'>
				 	<input type='hidden' name='id' value='".$Id."'/>
					<input type='submit' name='btnPdf' style='font-size: 10px; width:100%;' value='Generer PDF'/>
				</form>
				");
	}
?>


<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"> 
	   	<div class="collapse navbar-collapse navbar-ex1-collapse"> 
	      	<ul class="nav navbar-nav"> 
		      	<?php if($_SESSION['nivel']>1){ echo ("
         		<li><a href='nuevasSolicitudes'>Nuevas Solicitudes (".$nuevas.")</a></li>
         		<li><a href='nuevaSolic'>Nueva Solicitud</a></li>");}?>
         		<li><a href="solActivas">Solicitudes Activas</a></li> 
         		<li class="active"><a href="Solicitudes">Historial Solicitudes</a></li> 
         		<li><a href="Busqueda">Busar Solicitud</a></li> 
	         	<li><a href="index">Ver Calendario</a></li> 
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

		<center><H2> Historial Solicitudes </H2></center>
		
		<form class="navbar-form" role="search" action="Solicitudes.php"> 
         	<div class="form-group"> 
         		<input type="number" class="form-control" placeholder="Folio" name="fol">
         		<button type="submit" class="btn btn-default">Buscar</button> 
         	</div> 
        </form>     
	    
	    <br>
	    	

		<table class="table table-bordered table-striped "> 
		   	<thead> 
		      	<tr> 
		      		<th class="col-md-1"><H4>Folio</H4></th> 
		         	<th class="col-md-2"><H4>Nombre</H4></th> 
		         	<th class="col-md-1"><H4>No. Control</H4></th>
		         	<th class="col-md-1"><H4>Carrera</H4></th> 
		         	<th class="col-md-3"><H4>Solicita</H4></th>
		         	<th class="col-md-1"><H4>Reunion</H4></th>
		         	<th class="col-md-2"><H4>Dictamen</H4></th>
		         	<th class="col-md-1"><H4>Accion</H4></th>
		      	</tr> 
		   	</thead> 

		   	<tbody> 
		      	
		      	<?php 
			   		include("_conexion.php");
			   		$fol ="";
			   		if(isset($_GET['fol'])){
			   			$fol = $_GET['fol'];
			   			echo ($fol);
			   		}

					$sql = "CALL `ObtenerSolicitudesFinalizadas`('".$fol."');";
					$result = mysql_query($sql,$conexion);
					if($result != null){
						while ($row = mysql_fetch_assoc($result)){
							echo("<tr>");
							echo("<th><a href ='Descripcion.php?folio=".$row['id_peticion']."'>".$row['id_peticion']."</a></th>");
							echo("<th>".$row['nom_alumno']." ".$row['ape_paterno']." ".$row['ape_materno']."</th>");
							echo("<th>".$row['num_control']."</th>");
							echo("<th>".$row['nom_carrera']."</th>");
							echo("<th><p>".$row['peticion']."</p></th>");
							echo ("<th>".$row['fecha']."</th>");
							echo ("<th>".$row['dictamen']."</th>");
							if($_SESSION['nivel']>1){			 	
								imprimirBotones($row['id_peticion']);
							}else{
								echo("<th></th>");
							}
							echo("</tr>");
						}
					}
			   	?>
    			      	
		   	</tbody> 
		</table> 

	</div>

	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>