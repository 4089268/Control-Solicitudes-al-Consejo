<?php
	include("head.html");
	include("_conexion.php");

	$jefeEP = "";
	$subDireAcad = "";
	$director = "";

	$sql = "Select * From `configuracion`";

	$result = mysql_query($sql,$conexion);
	if($result != null){
		$row = mysql_fetch_assoc($result);

		$jefeEP = $row['jefeEP'];
		$subDireAcad = $row['subDirAcadem'];
		$director = $row['director'];		
	}

?>

<!DOCTYPE html>
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
		function redireccionar() {
			window.location="index.php";

		}
	</script>
</head>

<body>
	<div class="container-fluid" style="height: 500px;">
 	<center><h2> Configuracion</h2></center>
 	<br>
 	<br>
 		<form action="_editarDatos.php" class="form-horizontal" role="form" method="post" name="formSolicitud">
 				<div class="form-group" id="elem0"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Jefe de la División de Estudios Profesionales</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control" value="<?php echo($jefeEP);?>" name="nombre" >
			      </div> 
			   	</div> 

			   	<div class="form-group" id="elem1"> 
			      <label class=" col-sm-offset-1 col-sm-2 control-label">Subdirectora Académica</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control"  value="<?php echo($subDireAcad);?>" name="apP"> 
			      </div> 
			   	</div> 

			   	<div class="form-group" id="elem2"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Director</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control" value="<?php echo($director);?>" name="apM"> 
			      </div> 
			   	</div>

			   	<div class="form-group" id="elem2"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Encabezado</label> 
			      <div class="col-sm-7"> 
			      		<img src="img/Logo.jpg" style="width:500px; height: auto;">
			         	<input type="file" class="form-control" name="apM"> 
			      </div> 
			   	</div>



			   	<div class="form-group"> 
			    	<div class="col-sm-offset-4 col-sm-2 "> 
				        <input type="submit" value="Actualizar" class="btn btn-default">
				    </div>
				    <div class="col-sm-offset-2  col-sm-2 "> 
				    	<input type="button" value="Cancelar" class="btn btn-default" onclick="redireccionar()">
				    </div>
			   </div> 
	     </form>
	   	
	</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>