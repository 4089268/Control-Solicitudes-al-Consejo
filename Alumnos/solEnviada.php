<!DOCTYPE html>
<?php include ("header.html"); ?>

<body>
	<?php 
		session_start();
		if(!isset($_SESSION["folio"])){
				header('Location: index.php'); 
		}
	?>
	
	<div class="container" style="height: 500px;">

		<br>
		<br>
		
		<div class="jumbotron"> 
	      	<center><h2>Solicitud Enviada!</h2> </center>
	      	<br>
	      	<center>
	      	<h3>
			    	La Solicitud fue enviada excitosamente, dentro de un par de dias se llevara acabo una reunion para debatir sobre tu caso, podras seguir el estatus de tu peticion  a travez del siguiente folio:
			</h3> 
			<br>
	      	</center>
	      	<center><div style="background-color:grey; width: 50%;"><h2> <?php echo($_SESSION["folio"]); session_destroy();
	?> </h2></div></center>
	      	<br>
	      	<br>
	      	<center><p><a class="btn btn-primary btn-lg" role="button" HREF="index.php">Aceptar</a></p> </center>
	   	</div> 
				

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