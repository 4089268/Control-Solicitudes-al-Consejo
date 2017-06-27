<?php 
	include("head.html");
	include("_obtenerNuevasSol.php");
	include("_conexion.php");

	if(!isset($_POST['id'])){
		header('Location: index.php');
	}
	$folio = $_POST['id'];
	$nombre;
	$apP;
	$apM;
	$ncontrol;
	$carr;
	$pet;
	$prom;
	$sem;

	$sql = "CALL `ObtenerDatosSeguimiento`(".$_POST['id'].");";
	$result = mysql_query($sql,$conexion);
	if($result != null){
		while ($row = mysql_fetch_assoc($result)){
			$nombre = $row['nom_alumno'];
			$apP = $row['ape_paterno'];
			$apM = $row['ape_materno'];
			$ncontrol = $row['num_control'];
			$carr = $row['id_carrera'];
			$pet = $row['peticion'];
			$prom =$row['prom_general'];
			$sem=$row['semestre'];
	}
	}else{
		header('Location: index.php');
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
			window.location="solActivas.php";

		}
	</script>
</head>

<body>

	<div class="container-fluid" style="height: 500px;">
 	<center><h2> Editando Datos</h2></center>
 	<center><h3> Folio <?php echo($_POST['id']);?></h3></center>
 	<br>
 	<br>

 		<form action="_editarDatos.php" class="form-horizontal" role="form" method="post" name="formSolicitud">
 				<input type="hidden" name="folio" value="<?php echo ($folio); ?>">

			  	<div class="form-group" id="elem0"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Nombre</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control" value="<?php echo($nombre);?>" name="nombre" >
			      </div> 
			   	</div> 

			   	<div class="form-group" id="elem1"> 
			      <label class=" col-sm-offset-1 col-sm-2 control-label">Apellido Paterno</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control"  value="<?php echo($apP);?>" name="apP"> 
			      </div> 
			   	</div> 

			   	<div class="form-group" id="elem2"> 
			      <label class="col-sm-offset-1 col-sm-2 control-label">Apellido Materno</label> 
			      <div class="col-sm-7"> 
			         <input type="text" class="form-control" value="<?php echo($apM);?>" name="apM"> 
			      </div> 
			   	</div>

			   	<div class="form-group" id="elem3"> 
			      <label  class="col-sm-offset-1 col-sm-2 control-label">Numero de Control</label> 
			      <div class="col-sm-7"> 
			         <input type="number" class="form-control" value="<?php echo($ncontrol);?>" name="ncontrol" step="1" min="00380001" max="9938999999"> 
			      </div> 
			   	</div>


			    <div class="form-group" id="elem4"> 
			      <label  class="col-sm-offset-1 col-sm-2 control-label">Promedio General</label> 
			      <div class="col-sm-7"> 
			         <input type="number" class="form-control" value="<?php echo($prom);?>" name="prom" step="any" min="0" max="10"> 
			      </div> 
			   	</div>

			   	<div class="form-group" id="elem5"> 
			      <label  class="col-sm-offset-1 col-sm-2 control-label">Semestre</label> 
			      <div class="col-sm-7"> 
			         <input type="number" class="form-control" value="<?php echo($sem);?>" name="semestre" step="1" min="1" max="16">  
			      </div> 
			   	</div>
			   	
			   	<div class="form-group"> 
		      		<label class="col-sm-offset-1 col-sm-2 control-label">Carrera</label> 
			      	<div class="col-sm-7">
				      	<select class="form-control" name="carrera"> 
				        	<option <?php if($carr == 1){echo "selected";}?> >Ing. en Gestión Empresarial </option> 
				         	<option <?php if($carr == 2){echo "selected";}?> >Ing. en Sistemas Computacionales</option> 
				         	<option <?php if($carr == 3){echo "selected";}?> >Ing. en Energías Renovables</option> 
				         	<option <?php if($carr == 4){echo "selected";}?> >Ing. Electrónica</option> 
				         	<option <?php if($carr == 5){echo "selected";}?> >Ing. Civil</option> 
				         	<option <?php if($carr == 6){echo "selected";}?> >Ing. Industrial</option> 
				         	<option <?php if($carr == 7){echo "selected";}?> >Lic. en Biología </option> 
				         	<option <?php if($carr == 8){echo "selected";}?> >Lic. en Informatica </option> 
				      	</select>
			      	</div> 
		    	</div>

		    	<div class="form-group" id="elem7"> 
			    	<label class="col-sm-offset-1 col-sm-2 control-label">Solicitud</label> 
			    	<div class="col-sm-7">
			    		<textarea class="form-control" rows="3" name="soli"><?php echo($pet);?></textarea> 
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
		<br>
		<div/>	   	
	</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>