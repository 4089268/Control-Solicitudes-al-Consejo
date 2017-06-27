<!DOCTYPE html>
<?php include ("header.html"); ?>

<head>
	<script type="text/javascript">
		window.onload = function () {
		document.formSegumiento.addEventListener('submit', validarFormulario);
		}

		function validarFormulario(evObject) {
			evObject.preventDefault(); //Evita el envío del formulario hasta comprobar
			var todoCorrecto = true;
			var formulario = document.formSegumiento;
			

			if(formulario[0].value == null || formulario[0].value.length == 0 || /^\s*$/.test(formulario[0].value)){
				formdiv.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
				alert ('Los campos no pueden estar vacíos o contener sólo espacios en blanco');
			}else {
				formdiv.setAttribute('class','form-group has-success');
				formulario.submit();
			}
			
		}
	</script>
</head>

<body>
	
	<div class="container" style="height: 410px;">

	<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

		<div id="myModal" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Folio Incorrecto</h4>
		      </div>
		      <div class="modal-body">
		        <p>El folio que ingreso no exite dentro de la base de datos.<br>Intente con otro numero folio.</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
			</div>
		</div>
		
		<center><h3>Seguimiento de la Solicitud</h3></center>	

		<br>
		<br>		

		<form class="form-horizontal" action="_seguimiento.php" method="post" role="form" name="formSegumiento">
			<div class="form-group" id="formdiv"> 
		      <label class="col-sm-2 control-label">Folio</label> 
		      <div class="col-sm-10"> 
		         <input type="number" name="folio" class="form-control" placeholder="Folio" step="1" max="9912319999
		         "> 
		      </div> 
		   </div> 

			<div class="form-group"> 
		      <div class="col-sm-offset-2 col-sm-10"> 
		         <input class="btn btn-primary btn-lg" type="submit" value="Enviar" name="btn_enviar">
		      </div> 
		   </div>
		</form>
		<br>

		<center><a><h4>He olvidado mi folio</h4></a></center>
	</div>


	<footer style="background-color: #555555;color:#eeeeee;font-size: 10PX; font-weight: bold;">
		<div class="container">
			<center>Instituto Tecnologico de Cd. Victoria Boulevard Emilio Portes Gril #1301 Pte. AP. 175 C.P. 87010 Cd. Victoria Tamaulipas</center>
			<center>Tel. 01(834)153-2000</center>
			<center>R.F.C. TNM140723GFA</center>
		</div>
	</footer>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>