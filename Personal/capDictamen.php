<?php
	if(!isset($_POST['id'])){
		header('Location: index.php');
	}

	$folio = $_POST['id'];
	include("head.html");
	include("_conexion.php");
	
	$nombre;
	$solic;
	$sql = "CALL `ObtenerDatosSeguimiento`(".$folio.");";
	
	$result = mysql_query($sql,$conexion);
	if($result != null){
		while ($row = mysql_fetch_assoc($result)){
			$nombre = $row['nom_alumno']." ".$row['ape_paterno']." ".$row['ape_materno'];
			$solic = $row['peticion'];
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		window.onload = function () {
			document.formDictamenen.addEventListener('submit', validarFormulario);
		}
		function validarFormulario(evObject) {
			evObject.preventDefault(); //Evita el envío del formulario hasta comprobar
			var todoCorrecto = true;
			var formulario = document.formDictamenen;
			
			if(formulario[0].value == null || formulario[0].value.length == 0 || /^\s*$/.test(formulario[0].value)){
				elem0.setAttribute('class','form-group has-error ');
				todoCorrecto=false;

			}else {elem0.setAttribute('class','form-group has-success'); }
			if(formulario[1].value == null || formulario[1].value.length == 0 || /^\s*$/.test(formulario[1].value)){
				elem1.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem1.setAttribute('class','form-group has-success'); }

			if(!rd1.checked && !rd2.checked){
				todoCorrecto = false;
			}

			if (todoCorrecto ==true) {
				formulario.submit();
			}else{
				alert ('Los campos no pueden estar vacíos o contener sólo espacios en blanco');
			}
			
		}

		function redireccionar() {
			window.location="solActivas.php";
		}
	</script>
</head>

<body>
	<div class="container-fluid" >
		<br>
		<center><H2>Capturar Dictamen</H2></center>
		<br>
		<dl class="row">
			<dt class="col-sm-offset-3 col-sm-2">Folio:</dt>
		  	<dd class="col-sm-4"><?php echo($folio);?></dd>

		  	<dt class="col-sm-offset-3 col-sm-2">Nombre:</dt>
		  	<dd class="col-sm-4"><?php echo($nombre);?></dd>

		  	<dt class="col-sm-offset-3 col-sm-2">Solicita:</dt>
		  	<dd class="col-sm-4"><?php echo($solic);?></dd>
		</dl>
		<br>
		<form action="_capturarDictamen.php" class="form-horizontal" role="form" method="post" name="formDictamenen">
 					
			  	<div class="form-group" id="elem0"> 
			    	<label  class="col-sm-offset-1 col-sm-2 control-label">Dictamen:</label> 
			    	<div class="col-sm-7">
			    		<textarea class="form-control" rows="3" name="Dic"></textarea> 
			    	</div>
				</div> 

			    <div class="form-group" id="elem1"> 
			    	<label  class="col-sm-offset-1 col-sm-2 control-label">Comentarios:</label> 
			    	<div class="col-sm-7">
			    		<textarea class="form-control" rows="3" name="Com">Sin Comentarios</textarea> 
			    	</div>
				</div>

				<div class="form-group" id="elem2"> 
			    	<label  class="col-sm-offset-1 col-sm-2 control-label">Resultado:</label> 
			    	<div class="col-sm-7">
			    		<label class="radio-inline"><input type="radio" name="res" value="Aprobado" id="rd1"> Aprobado </label>
						<label class="radio-inline"><input type="radio" name="res" value="Rechazado" id="rd2"> Rechazado </label>
			    	</div>
				</div>

				<div class="form-group"> 
			    	<input type="hidden" name="folio" value="<?php echo($folio);?>">
			    </div>

				<div class="form-group"> 
			    	<div class="col-sm-offset-5 col-sm-10 "> 
				        <input type="submit" value="Capturar" class="btn btn-default" >
				        <input type="button" value="Cancelar" class="btn btn-default" onclick="redireccionar();">
				    </div> 
			   </div> 

			   

		</form>

	</div>
</body>
</html>