<!DOCTYPE html>

<?php 
	include("head.html");
	include("_obtenerNuevasSol.php");

	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login?x=o");
	}

	//Calenadrio ------>
	/*require_once('bdd.php');

	$sqlc = "SELECT id, title, start, end FROM events ";

	$req = $bdd->prepare($sqlc);
	$req->execute();

	$events = $req->fetchAll();
	*/

?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">      

    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet' />

    <!-- Custom CSS -->
    <style>
	   	#calendar {
			max-width: 800px;
		}

		.col-centered{
			float: none;
			margin: 0 auto;
		}
	</style>
</head>


<body>

	<nav class="navbar navbar-default navbar-fixed-top " role="navigation"> 
	   	<div class="collapse navbar-collapse navbar-ex1-collapse"> 
	      	<ul class="nav navbar-nav"> 
		      	<?php if($_SESSION['nivel']>1){ echo ("
         		<li><a href='nuevasSolicitudes'>Nuevas Solicitudes (".$nuevas.")</a></li>
         		<li><a href='nuevaSolic'>Nueva Solicitud</a></li>");}?>
         		<li><a href="solActivas">Solicitudes Activas</a></li> 
         		<li><a href="Solicitudes">Historial Solicitudes</a></li> 
         		<li><a href="Busqueda">Busar Solicitud</a></li> 
	         	<li class="active"><a href="index">Ver Calendario</a></li> 
	        </ul>

	       	<ul class="nav navbar-nav navbar-right">
	       		<li>
		      		<a href="configuracion" class="navbar-link"><span class="glyphicon glyphicon-cog"></span> Configuracion</a>
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

		<center><h2> Agenda</h2></center>

		<br>

		<div class="row">
           	<div id="calendar" class="col-centered"> </div>
       	</div>

       	<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="form-horizontal">

			  			<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><a href="http://localhost:8080/SistemaWeb_Personal/Descripcion.php?folio=1612170002">Edit Event</a></h4>
			 			</div>

			  			<div class="modal-body">
			  				<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Nombre</label>
									<div class="col-sm-10">
				  						<input type="text" name="title" class="form-control" id="title" placeholder="Title">
									</div>
				  			</div>
				  			<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Folio</label>

								<div class="col-sm-10">
				  						<a href="www.google.com">hola mundo<a>
								</div>						
				
				  			</div>	    	
				  
				  			<input type="hidden" name="id" class="form-control" id="id">
						</div>

			  			<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>							
			  			</div>
					</form>
				</div>
		  	</div>
		</div>

	</div>

	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>

	<script>
		$(document).ready(function() {		
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				defaultDate: '<?php echo(date("Y-m-d"));?>',
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				selectable: true,
				selectHelper: true,
				eventRender: function(event, element) {
					element.bind('dblclick', function() {
						$('#ModalEdit #id').val(event.id);
						$('#ModalEdit #title').val(event.title);
						
						$('#ModalEdit').modal('show');
					});
				},
				eventDrop: function(event, delta, revertFunc) { // si changement de position
					edit(event);
				},
				eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
					edit(event);
				},
				
				events: [
				<?php foreach($events as $event): 
				
					$start = explode(" ", $event['start']);
					$end = explode(" ", $event['end']);
					if($start[1] == '00:00:00'){
						$start = $start[0];
					}else{
						$start = $event['start'];
					}
					if($end[1] == '00:00:00'){
						$end = $end[0];
					}else{
						$end = $event['end'];
					}
				?>
					{
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['title']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						
					},
				<?php endforeach; ?>
				]
			});
			
			function edit(event){
				start = event.start.format('YYYY-MM-DD HH:mm:ss');
				if(event.end){
					end = event.end.format('YYYY-MM-DD HH:mm:ss');
				}else{
					end = start;
				}
				
				id =  event.id;
				
				Event = [];
				Event[0] = id;
				Event[1] = start;
				Event[2] = end;
				
				$.ajax({
				 url: 'editEventDate.php',
				 type: "POST",
				 data: {Event:Event},
				 success: function(rep) {
						if(rep == 'OK'){
							alert('Saved');
						}else{
							alert('Could not be saved. try again.'); 
						}
					}
				});
			}
			
		});

	</script>

</body>

</html>