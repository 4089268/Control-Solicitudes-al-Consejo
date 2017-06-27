<!DOCTYPE html>

<?php 
	include("head.html");
	include("_obtenerNuevasSol.php");

	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login.php");
	}
	
	function imprimirBotones($Id){
		echo ("	<th>
					<form id='form1".$Id."' method='post' action='_validarNuevasPeticiones.php'>
					 	<input type='hidden' name='id' value='".$Id."'/>
						<input type='button' name='".$Id."' style='float:top; font-size: 10px; width:100%;' value='Validar' onclick='confirmarValidar(this)'/>
					</form>
					<form id='form2".$Id."' method='post' action='_cancelarPeticiones.php'>
					 	<input type='hidden' name='id2' value='".$Id."'/>
						<input type='button' name='".$Id."' style='float:top; font-size: 10px; width:100%;' value='Cancelar' onclick='confirmarCancelar(this)'/>
					</form>
			   	</th>");
	}

?>
<head>
	<script type="text/javascript">
		function confirmarValidar(btn) {
			var formid = "form1"+btn.name;
			var form = document.getElementById(formid);

			if (confirm('¿Esta seguro de VALIDAR esta Solicitud?')){ 
				form.submit();
		    } 
		}
		function confirmarCancelar(btn) {
			var formid = "form2"+btn.name;
			var form = document.getElementById(formid);

			if (confirm('¿Esta seguro de CANCELAR esta Solicitud?')){ 
				form.submit();
		    } 
		}
	</script>
</head>

<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"> 
	   	<div class="collapse navbar-collapse navbar-ex1-collapse"> 
	      	<ul class="nav navbar-nav"> 
		      	<?php if($_SESSION['nivel']>1){ echo ("
         		<li class='active'><a href='nuevasSolicitudes'>Nuevas Solicitudes (".$nuevas.")</a></li>
         		<li><a href='nuevaSolic'>Nueva Solicitud</a></li>");}?>
         		<li><a href="solActivas">Solicitudes Activas</a></li> 
         		<li><a href="Solicitudes">Historial Solicitudes</a></li> 
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

		<center><H2> Nuevas Solicitudes </H2></center>
		<br>
		<br>
		<table class="table table-bordered table-striped "> 
		   	<thead> 
		      	<tr> 
		         	<th class="col-xs-2"><H4>Nombre</H4></th> 
		         	<th class="col-xs-1"><H4>Apellido Paterno</H4></th> 
		         	<th class="col-xs-1"><H4>Apellido Materno</H4></th> 
		         	<th class="col-xs-1"><H4>No. Control</H4></th>
		         	<th class="col-xs-2"><H4>Carrera</H4></th> 
		         	<th class="col-xs-4"><H4>Solicita</H4></th>
		         	<th class="col-xs-1"><H4>Accion</H4></th>
		      	</tr> 
		   	</thead> 

		   	<tbody> 

		   	<?php 
		   		include("_conexion.php");
				$sql = "CALL `ObtenerNuevasSolicitudes`();";
				$result = mysql_query($sql,$conexion);
				if($result != null){
					while ($row = mysql_fetch_assoc($result)){
						echo("<tr>");
						echo("<th>".$row['nom_alumno']."</th>");
						echo("<th>".$row['ape_paterno']."</th>");
						echo("<th>".$row['ape_materno']."</th>");
						echo("<th>".$row['num_control']."</th>");
						echo("<th>".$row['nom_carrera']."</th>");
						echo("<th><p>".$row['peticion']."</p></th>");
						imprimirBotones($row['id_peticion']);
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