<!DOCTYPE html>

<?php 
	include("head.html");
	include("_obtenerNuevasSol.php");
	
	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login.php");
	}
	

?>
<head>
	<script type="text/javascript">
		window.onload = function () {
		document.formSolicitud.nombre.focus();
		document.formSolicitud.addEventListener('submit', validarFormulario);
		}

		function validarFormulario(evObject) {
			evObject.preventDefault(); //Evita el envío del formulario hasta comprobar
			var todoCorrecto = true;
			var formulario = document.formSolicitud;
			
			if(formulario[0].value == null || formulario[0].value.length == 0 || /^\s*$/.test(formulario[0].value)){
				elem0.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem0.setAttribute('class','form-group has-success'); }
			
			if(formulario[1].value == null || formulario[1].value.length == 0 || /^\s*$/.test(formulario[1].value)){
				elem1.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem1.setAttribute('class','form-group has-success'); }

			if(formulario[2].value == null || formulario[2].value.length == 0 || /^\s*$/.test(formulario[2].value)){
				elem2.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem2.setAttribute('class','form-group has-success'); }

			if(formulario[3].value == null || formulario[3].value.length == 0 || /^\s*$/.test(formulario[3].value)){
				elem3.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem3.setAttribute('class','form-group has-success'); }

			if(formulario[4].value == null || formulario[4].value.length == 0 || /^\s*$/.test(formulario[4].value)){
				elem4.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem4.setAttribute('class','form-group has-success'); }

			if(formulario[5].value == null || formulario[5].value.length == 0 || /^\s*$/.test(formulario[5].value)){
				elem5.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem5.setAttribute('class','form-group has-success'); }

			if(formulario[7].value == null || formulario[7].value.length == 0 || /^\s*$/.test(formulario[7].value)){
				elem7.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem7.setAttribute('class','form-group has-success'); }


			if (todoCorrecto ==true) {
				formulario.submit();
			}else{
				alert ('Los campos no pueden estar vacíos o contener sólo espacios en blanco');
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
         		<li class='active'><a href='nuevaSolic'>Nueva Solicitud</a></li>");}?>
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
 	
 	<div class="container-fluid" style="height: 500px;">
 	<center><h2> Nueva Solicitud</h2></center>

 	<br>
 	<br>

 		<form action="_enviarSol.php" class="form-horizontal" role="form" method="post" name="formSolicitud">
 					
			  	<div class="form-group" id="elem0"> 
			      <label class="col-sm-2 control-label">Nombre</label> 
			      <div class="col-sm-9"> 
			         <input type="text" class="form-control" placeholder="Nombre" name="nombre" > 
			      </div> 
			   	</div> 

			   	<div class="form-group" id="elem1"> 
			      <label class="col-sm-2 control-label">Apellido Paterno</label> 
			      <div class="col-sm-9"> 
			         <input type="text" class="form-control"  placeholder="Apellido Paterno" name="apP"> 
			      </div> 
			   	</div> 

			   	<div class="form-group" id="elem2"> 
			      <label class="col-sm-2 control-label">Apellido Materno</label> 
			      <div class="col-sm-9"> 
			         <input type="text" class="form-control" placeholder="Apellido Materno" name="apM"> 
			      </div> 
			   	</div>

			   	<div class="form-group" id="elem3"> 
			      <label  class="col-sm-2 control-label">Numero de Control</label> 
			      <div class="col-sm-9"> 
			         <input type="number" class="form-control" placeholder="Numero de Control" name="ncontrol" step="1" min="00380001" max="9938999999"> 
			      </div> 
			   	</div>

			    <div class="form-group" id="elem4"> 
			      <label  class="col-sm-2 control-label">Promedio General</label> 
			      <div class="col-sm-9"> 
			         <input type="number" class="form-control" placeholder="Promedio General" name="prom" step="any" min="0" max="10"> 
			      </div> 
			   	</div>

			   	<div class="form-group" id="elem5"> 
			      <label  class="col-sm-2 control-label">Semestre</label> 
			      <div class="col-sm-9"> 
			         <input type="number" class="form-control" placeholder="Semestre" name="semestre" step="1" min="1" max="16">  
			      </div> 
			   	</div>

			   	<div class="form-group"> 
		      		<label class="col-sm-2 control-label">Carrera</label> 
			      	<div class="col-sm-9">
				      	<select class="form-control" name="carrera"> 
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

		    	<div class="form-group" id="elem7"> 
			    	<label  class="col-sm-2 control-label">Solicitud</label> 
			    	<div class="col-sm-9">
			    		<textarea class="form-control" rows="3" name="soli"></textarea> 
			    	</div>
				</div>
				
				<div class="form-group"> 
		      		<label class="col-sm-2 control-label">Carrera</label> 
			      	<div class="col-sm-9">
				      	<select class="form-control" name="mot"> 
				        	<option>Academicos</option> 				         	
				         	<option>Personales</option> 
				         	<option>Ortos</option>
				      	</select>
			      	</div> 
		    	</div>

				<div class="form-group"> 
			    	<div class="col-sm-offset-5 col-sm-10 "> 
				        <p><input type="submit" value="Capturar" class="btn btn-default"></p>
				    </div> 
			   </div> 
	     </form>
	   	<br>
	   	<div/>
	</div>
	<br>
	<br>
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>