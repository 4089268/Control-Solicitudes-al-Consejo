<?php 
			   	include("_conexion.php");
				$sql = "CALL `ObtenerNuevasSolicitudes`();";
				$result = mysql_query($sql,$conexion);
				if($result != null){
					while ($row = mysql_fetch_assoc($result)){
						echo("<tr>");
						echo("<th>".$row['nom_alumno']."<th>");
						echo("<th>".$row['ape_paterno']."<th>");
						echo("<th>".$row['ape_materno']."<th>");
						echo("<th>".$row['num_control']."<th>");
						echo("<th>".$row['nom_carrera']."<th>");
						echo("<th><p>".$row['peticion']."</p><th>");
						echo ("<button style='float:top; font-size: 10px;'>Validar</button>");
						echo ("<button style='font-size: 10px;'>Eliminar</button>");
						echo("</tr>")
					}
				}
		   	?>