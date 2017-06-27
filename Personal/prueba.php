<!DOCTYPE html>
<html>
<?php 
	include ("head.html");
?>
<head>
	<style type="text/css">

	section.modalDialog{
			background-color: rgba(0,0,0,0.5);
			bottom: 0;
			top: 0;
			left: 0;
			right: 0;
			opacity: 0;
			position: fixed;
			z-index: -2;
		}

		section.modalDialog:target{
			opacity: 1;
		}
		
		section.modal2{
			background-color: #ffffff;
			border-radius: 5px;
			color: #444444;
			margin: 10% auto;
			padding: 20px;
			position: relative;
			width: 700px;

			
		}

	</style>
</head>

<body>
	<div class="contenedor">
		<a href="#openmodal" class="open">Abrir Ventana</a>

		<section id="openmodal" class="modalDialog">
			<section class="modal2">
				<h3>Ventana Modal</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<input type="button" name="Cancelar" value="Cancelar" onclick="location.href='#close';">
			</section>			

		</section>
	</div>


	<div class="container-fluid">
		<br>
		<h1 align="center"> Hola_Mundo</h1>
		<br>
	</div>
	

</body>
</html>