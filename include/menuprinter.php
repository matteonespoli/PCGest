<?php
	function print_bottom()
	{
		echo'
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write(\'<script src="../../assets/js/vendor/jquery.min.js"><\/script>\')</script>
		<script src="./bootstrap/js/bootstrap.min.js"></script>
		<script src="./bootstrap/js/bootstrap-switch.js"></script>';
	}
	function print_head($titolo, $dash)
	{
		echo '
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
			<meta name="description" content="">
			<meta name="author" content="">
			<link rel="icon" type="image/x-icon" href="favicon.ico" />

			<title>PCGest | '.$titolo.'</title>

			<!-- Bootstrap core CSS -->
			<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<!-- Bootstrap Switches CSS -->
			<link href="./bootstrap/css/bootstrap-switch.css" rel="stylesheet">';
			
			if($dash==true)
			{ echo '
				<!-- Custom styles for this template -->
				<link href="dashboard.css" rel="stylesheet">';
			}
			
			echo '<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->';
	}

	function print_nav()
	{
		echo '<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  
			  <a class="navbar-brand" href="#">PCGest | <span class="hidden-xs hidden-sm">Dipartimento della</span> Protezione Civile</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Dashboard</span></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profilo <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li>
								<div class="row">
									<div class="col-xs-3">
										<img src="img/profile.png" style="width: 50px" class="img-circle">
									</div>
									<div class="col-xs-9 text-center">
										<a href="#"><h4>Nespoli<br>Matteo</h4></a>
									</div>
								</div>
							</li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
						</ul>
					</li>
					<li><a href="settings.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Impostazioni</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Help</a></li>
				  </ul>
			  <!--<form class="navbar-form navbar-right">
				<input type="text" class="form-control" placeholder="Ricerca...">
			  </form>-->
			</div>
		  </div>
		</nav>';
	}
	
	function print_lateral_menu($id_active)
	{
		echo '
		<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li '.($id_active == 11 ? 'class="active"' : '').'>
				<a href="index.php">Homepage '.($id_active == 11 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
            <li '.($id_active == 12 ? 'class="active"' : '').'>
				<a href="overview.php">Overview '.($id_active == 12 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
            <li '.($id_active == 13 ? 'class="active"' : '').'>
				<a href="#">Analytics '.($id_active == 13 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
            <li '.($id_active == 14 ? 'class="active"' : '').'>
				<a href="#">Export '.($id_active == 14 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
          </ul>
		  
		  <hr><h3>Campo</h3>
		  <ul class="nav nav-sidebar">
            <li '.($id_active == 21 ? 'class="active"' : '').'>
				<a href="anagrafica_sfollati.php">Anagrafica sfollati '.($id_active == 21 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
			<li '.($id_active == 22 ? 'class="active"' : '').'>
				<a href="registro_campo.php">Registro di campo '.($id_active == 22 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
            <li '.($id_active == 23 ? 'class="active"' : '').'>
				<a href="mappa.php">Struttura campo '.($id_active == 23 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
			<li '.($id_active == 24 ? 'class="active"' : '').'>
				<a href="personale.php">Gestione personale '.($id_active == 24 ? '<span class="sr-only">(current)</span>' : '').'</a>
			</li>
          </ul>
        </div>';
	}
?>