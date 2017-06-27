<?php 
	include("head.html");
	include("_obtenerNuevasSol.php");

	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login.php");
	}
?>

<!DOCTYPE html>
<body>
	
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"> 
	   	<div class="collapse navbar-collapse navbar-ex1-collapse"> 
	      	<ul class="nav navbar-nav"> 
		      	<?php if($_SESSION['nivel']>1){ echo ("
         		<li><a href='nuevasSolicitudes'>Nuevas Solicitudes (".$nuevas.")</a></li>
         		<li><a href='nuevaSolic'>Nueva Solicitud</a></li>");}?>
         		<li><a href="solActivas">Solicitudes Activas</a></li> 
         		<li><a href="Solicitudes">Historial Solicitudes</a></li> 
         		<li class="active"><a href="Busqueda">Busar Solicitud</a></li> 
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

	<div class="container-fluid" style="height: 500px;">
 	<center><h2> Busqueda Personalizada</h2></center>
 	<br>
 	<br>

 		<form action="Busqueda.php" class="form-horizontal" role="form" method="post">
 				
 				<input type="hidden" name="per" value="1">

			  	<div class="form-group"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Nombre</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control" name="nombre" >
			      </div> 
			   	</div> 

			   	<div class="form-group"> 
			      <label class=" col-sm-offset-1 col-sm-2 control-label">Apellido Paterno</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control"  name="apP"> 
			      </div> 
			   	</div> 

			   	<div class="form-group"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Apellido Materno</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control" name="apM"> 
			      </div> 
			   	</div>

			    <div class="form-group"> 
			      <label  class="col-sm-offset-1 col-sm-2 control-label">Promedio General</label> 
			      <div class="col-sm-7"> 
			      		<div class="col-sm-7">
				    		<label class="radio-inline"><input type="radio" name="promCom" value="1" id="rd1" checked>Igual Que </label>
				    		<label class="radio-inline"><input type="radio" name="promCom" value="2" id="rd1">Menor que</label>
							<label class="radio-inline"><input type="radio" name="promCom" value="3" id="rd2">Mayor que </label>
			    		</div>
			         	<input type="number" class="form-control" value="" name="prom" step="any" min="0" max="10"> 
			      </div> 
			   	</div>

			   	<div class="form-group"> 
			      <label  class="col-sm-offset-1 col-sm-2 control-label">Semestre</label> 
			      <div class="col-sm-7">
			      		<div class="col-sm-7">
				    		<label class="radio-inline"><input type="radio" name="semCom" value="1" id="rd1" checked>Igual Que </label>
				    		<label class="radio-inline"><input type="radio" name="semCom" value="2" id="rd1">Menor que</label>
							<label class="radio-inline"><input type="radio" name="semCom" value="3" id="rd2">Mayor que </label>
			    		</div>
			         	<select class="form-control" name="sem"> 
				      		<option selected> 1º</option> 
				        	<option>2º</option>
				        	<option>3º</option> 
				        	<option>4º</option> 
				        	<option>5º</option> 
				        	<option>6º</option> 
				        	<option>2º</option> 
				        	<option>2º</option> 
				        	<option>9º</option> 
				        	<option>10º</option> 
				        	<option>11º</option> 
				        	<option>12º</option> 
				        	<option>13º</option> 
				        	<option>14º</option>
				      	</select>
			      </div> 
			   	</div>
			   	
			   	<div class="form-group"> 
		      		<label class="col-sm-offset-1 col-sm-2 control-label">Carrera</label> 
			      	<div class="col-sm-7">
				      	<select class="form-control" name="carrera"> 
				      		<option selected> Todas</option> 
				        	<option>Ing. en Gestión Empresarial </option> 
				         	<option>Ing. en Sistemas Computacionales</option> 
				         	<option>Ing. en Energías Renovables</option> 
				         	<option>Ing. Electrónica</option> 
				         	<option>Ing. Civil</option> 
				         	<option>Ing. Industrial</option> 
				         	<option>Lic. en Biología </option> 
				         	<option>Lic. en Informatica </option> 
				      	</select>
			      	</div> 
		    	</div>

				<div class="form-group"> 
			    	<label  class="col-sm-offset-1 col-sm-2 control-label">Status:</label> 
			    	<div class="col-sm-7">
			    		<select class="form-control" name="status"> 
				      		<option selected>Todas</option> 
				        	<option>Pendiente</option>
				        	<option>Cancelada</option> 
				        	<option>En_proceso</option> 
				        	<option>Rechazada</option> 
				        	<option>Aprobada</option> 
				      	</select>
			      	</div>
				</div>

				<div class="form-group"> 
			    	<div class="col-sm-offset-5 col-sm-2 "> 
				        <input type="submit" value="Buscar" class="btn btn-default">
				    </div>
				 </div> 
	     </form>

	   	<br>
		<br>

		<table class="table table-bordered table-striped "> 
		   	<thead> 
		      	<tr> 
		      		<th class="col-md-1"><H4>Folio</H4></th> 
		         	<th class="col-md-2"><H4>Nombre</H4></th> 
		         	<th class="col-md-1"><H4>No. Control</H4></th>
		         	<th class="col-md-2"><H4>Carrera</H4></th> 
		         	<th class="col-md-3"><H4>Solicita</H4></th>
		         	<th class="col-md-1"><H4>Reunion</H4></th>
		         	<th class="col-md-2"><H4>Dictamen</H4></th>
		         	
		      	</tr> 
		   	</thead> 

		   	<tbody> 
		   	<?php
		   		if(isset($_POST['per'])){
					$nombre = $_POST['nombre'];
					$app = $_POST['apP'];
					$apm = $_POST['apM'];
					$prom = $_POST['prom'];
					$promCom = $_POST['promCom'];
					$sem = $_POST['sem'];
					$semCom = $_POST['semCom'];
					$carrera = $_POST['carrera'];
					$status = $_POST['status'];

					include("_conexion.php");
					$sql = "CALL `BusquedaPerzonalizada`('".$nombre."', '".$app."','".$apm."');";

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
							echo("</tr>");
						}
					}

					//echo ("<tr>->".$nombre ."<br>->".$app."<br>->".$apm."<br>->".$prom."<br>->".$promCom."<br>->".$sem."<br>->".$semCom."<br>->".$carrera."<br>->".$status."</tr>");

				}
		   	?>
	    	</tbody> 
		</table> 

		<br><br><div/>


	</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>

	