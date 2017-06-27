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
				<form id='form1".$Id."' method='post' action='_cancelarPeticiones.php'>
				 	<input type='hidden' name='id' value='".$Id."'/>
					<input type='button' name='".$Id."' style='font-size: 10px; width:100%;' value='Cancelar' onClick='confirmarCancelarPeticion(this)'/>
				</form>

				<button style='font-size: 10px; width:100%; color:black;' data-toggle='modal' data-target='#ModalFecha'>Cambiar Fecha</button>

				<form name='form3".$Id."' method='post' action='editarDatos.php'>
				 	<input type='hidden' name='id' value='".$Id."'/>
					<input type='submit' name='btnEditar' style='font-size: 10px; width:100%;' value='Editar Datos'/>
				</form>
				<form name='form4".$Id."' method='post' action='_generarPdf.php'>
				 	<input type='hidden' name='id' value='".$Id."'/>
					<input type='submit' name='btnPdf' style='font-size: 10px; width:100%;' value='Generer PDF'/>
				</form>
				<form name='form5".$Id."' method='post' action='capDictamen.php'>
				 	<input type='hidden' name='id' value='".$Id."'/>
					<input type='submit' name='btnDict' style='font-size: 10px; width:100%;' value='Capturar Dictamen'/>
				</form> </th>"
				);
	}

?>

<head>
	<script type="text/javascript">
		function confirmarCancelarPeticion(btn) {
			var formid = "form1"+btn.name;
			var form = document.getElementById(formid);

			if (confirm('¿Esta seguro de cancelar esta Solicitud?')){ 
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
         		<li><a href='nuevasSolicitudes'>Nuevas Solicitudes (".$nuevas.")</a></li>
         		<li><a href='nuevaSolic'>Nueva Solicitud</a></li>");}?>
         		<li class="active"><a href="solActivas">Solicitudes Activas</a></li> 
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
 		<center><H2> Solicitudes Activas </H2></center>
		
	    <br>
	    	
		<table class="table table-bordered table-striped "> 
		   	<thead> 
		      	<tr> 
		      		<th class="col-md-1"><H4>Folio</H4></th> 
		         	<th class="col-md-2"><H4>Nombre</H4></th> 
		         	<th class="col-md-1"><H4>No. Control</H4></th>
		         	<th class="col-md-2"><H4>Carrera</H4></th> 
		         	<th class="col-md-4"><H4>Solicita</H4></th>
		         	<th class="col-md-1"><H4>Reunion</H4></th>
		         	<th class="col-md-1"><H4>Accion</H4></th>
		      	</tr> 
		   	</thead> 

		   	<tbody> 
		   		<?php 
			   		include("_conexion.php");
					$sql = "CALL `ObtenerSolicitudesActivas`();";
					$result = mysql_query($sql,$conexion);
					if($result != null){
						while ($row = mysql_fetch_assoc($result)){
							echo("<tr>");
							echo("<th><a href ='Descripcion.php?folio=".$row['id_peticion']."'>".$row['id_peticion']."</a></th>");
							echo("<th>".$row['nom_alumno']." ".$row['ape_paterno']." ".$row['ape_materno']."</th>");
							echo("<th>".$row['num_control']."</th>");
							echo("<th>".$row['nom_carrera']."</th>");
							echo("<th><p>".$row['peticion']."</p></th>");
							if($row['fecha'] = '200-01-01'){
								echo("<th>Sin Capturar</th>");
							}else{
								echo("<th>".$row['fecha']."</th>");
							}
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

		<div class="modal fade" id="ModalFecha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="form-horizontal">

			  			<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Asiganar Fecha</h4>
			 			</div>

			  			<div class="modal-body">
			  				<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Fecha</label>
									<div class="col-sm-10">
				  						<input type="datetime-local" name="title" class="form-control" id="fehca">
									</div>
				  			</div>
				  			<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Folio</label>

								<div class="col-sm-10">
				  						<a href="http://localhost:8080/SistemaWeb_personal/Descripcion.php?folio=1702020001">1702020001<a>
								</div>						
				
				  			</div>	    	
				  
				  			<input type="hidden" name="id" class="form-control" id="id">
						</div>

			  			<div class="modal-footer">
			  				<button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button>	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>							
			  			</div>
					</form>
				</div>
		  	</div>
		</div>
	</div>

	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>