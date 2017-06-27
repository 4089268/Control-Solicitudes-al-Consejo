<?php
	include("head.html");

	if(isset($_GET['x'])){
		echo("<script>alert('Usuario y/o Contraseña incorrectas');</script>");
	}
		
?>

<html>
<head>
	<script type="text/javascript">
		window.onload = function () {
		document.formLogin.addEventListener('submit', validarFormulario);
		}

		function validarFormulario(evObject) {
			evObject.preventDefault(); //Evita el envío del formulario hasta comprobar
			var todoCorrecto = true;
			var formulario = document.formLogin;
			
			if(formulario[0].value == null || formulario[0].value.length == 0 || /^\s*$/.test(formulario[0].value)){
				elem0.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem0.setAttribute('class','form-group has-success'); }
			if(formulario[1].value == null || formulario[1].value.length == 0 || /^\s*$/.test(formulario[1].value)){
				elem1.setAttribute('class','form-group has-error ');
				todoCorrecto=false;
			}else {elem1.setAttribute('class','form-group has-success'); }
			
			if (todoCorrecto ==true) {
				formulario.submit();
			}else{
				alert ('Los campos no pueden estar vacíos o contener sólo espacios en blanco');
			}
		}
	</script>
</head>

<body>


	<div class="container-fluid" style="">
		<center><img src="img/Logo.jpg"></center>
		
		<br>

	    <div class="col-md-offset-4 col-md-4" style="background-color: #999999">
            <form class="form-login form-horizontal" role="form""  method="post" action="_validarUsuario.php" name="formLogin"> 
	            <h4>Bienvenido</h4>

	            <div class="form-group" id="elem0"> 
		        <div class="col-sm-12">
		        	<span class="glyphicon glyphicon-user"></span> Cuenta 
		        	<input type="text" class="form-control" placeholder="" name="acnt" > 
		      	</div> 
		   		</div> 

		   		<div class="form-group" id="elem1"> 
		      	<div class="col-sm-12">
		      		<span class="glyphicon glyphicon-eye-open"></span> Contraseña
		       		<input type="password" class="form-control"  placeholder="" name="pass"> 
		      	</div> 
		   		</div> 
		   		
		   		<div class="form-group"> 
		      	<div class="col-sm-12"> 
		       		<center><input type="submit" value="LogIn" class="btn"></center>
		      	</div> 
		   		</div>
	            
	            <br>		            
		       	<div/>

            </form> 
        </div>
	</div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>



