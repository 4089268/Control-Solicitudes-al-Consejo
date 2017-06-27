<!DOCTYPE html>
<?php include ("header.html"); ?>
<body>
	<?php
		session_start();
		if(!isset($_SESSION["ncontrol"])){
				header('Location: seguimiento.php'); 
		}
	
	?>
	
	<div class="container">
		
		<br>
		<br>
		
		<div class="row">
			<div class="col-sm-offset-2 col-sm-8">
				<table class="table table-striped "> 
					<caption>Solicitud</caption> 
				   
			      	<tr> 
			        	<td><h4>Folio</h4></td> 
			         	<td><h5><?php echo $_SESSION["folio"]; ?></h5></td>
			      	</tr>

			      	<tr> 
			        	<td><h4>Nombre</h4></td> 
			         	<td><h5><?php echo $_SESSION["nombre"]; echo" "; echo $_SESSION["apP"];  echo" ";  echo $_SESSION["apM"]; ?></h5></td>
			      	</tr>

			      	<tr> 
			        	<td><h4>Carrera</h4></td> 
			         	<td><h5><?php echo $_SESSION["carrera"];?></h5></td>
			      	</tr>

		      		<tr> 
			        	<td><h4>Numero de Control</h4></td> 
			         	<td><h5><?php echo $_SESSION["ncontrol"];?></h5></td>
			      	</tr> 

			      	<tr> 
			        	<td><h4>Semestre</h4></td> 
			         	<td><h5><?php echo $_SESSION["semestre"];?></h5></td>
			      	</tr> 

			      	<tr> 
			        	<td><h4>Fecha Solicitud</h4></td> 
			         	<td><h5><?php echo $_SESSION["fechaSolicitud"];?></h5></td>
			      	</tr> 

			      	<tr> 
			        	<td><h4>Solicitud</h4></td> 
			         	<td><h5><?php echo $_SESSION["peticion"];?></h5></td>
			      	</tr> 

			      	<?php 
				      	switch ($_SESSION["status"]) {
				      		case 1:
				      			echo ("<tr><td><h4>Estatus</h4></td><td><h4 style='color: #7FB4C3;'>Pendiente</h4></td></tr>");
				      	
				      			break;
				      		case 2:
				      			echo ("<tr><td><h4>Estatus</h4></td><td><h4 style='color: #E86546;'>Cancelada</h4></td></tr>");
				      			echo ("<tr><td><h4>Comentarios</h4></td><td><h5>".$_SESSION['coment']."</h5></td></tr>");
				      			break;
				      		case 3:
				      			echo ("<tr><td><h4>Estatus</h4></td><td><h4 style='color: #3A579B;'>En Proceso</h4></td></tr>");
				      			echo ("<tr><td><h4>Comentarios</h4></td><td><h5>".$_SESSION['coment']."</h5></td></tr>");
				      			break;
				      		case 4:
				      			echo ("<tr><td><h4>Estatus</h4></td><td><h4 style='color: #E8AA46;'>Rechazada</h4></td></tr>");
				      			echo ("<tr><td><h4>Comentarios</h4></td><td><h5>".$_SESSION['coment']."</h5></td></tr>");
				      			echo ("<tr><td><h4>Dictamen</h4></td><td><h5>".$_SESSION['dictamen']."</h5></td></tr>");
				      			break;		
				      		case 5:
				      			echo ("<tr><td><h4>Estatus</h4></td><td><h4 style='color: #57C33B;'>Aprobada</h4></td></tr>");
				      			echo ("<tr><td><h4>Comentarios</h4></td><td><h5>".$_SESSION['coment']."</h5></td></tr>");
				      			echo ("<tr><td><h4>Dictamen</h4></td><td><h5>".$_SESSION['dictamen']."</h5></td></tr>");
				      		break;
				      		  		
				      		default:
				      			header('Location: seguimiento.php');
				      			break;
				      	}
			      	?>

				</table> 
			</div>
		</div>

 		<br>
		<center><p><a class="btn btn-primary btn-lg" role="button" HREF="index.php">Salir</a></p> </center>
		<br>				
	</div>

	<div class="clearfix"></div>
	<?php session_destroy();?>


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