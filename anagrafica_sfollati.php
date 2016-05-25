<?php
	include("include/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/x-icon" href="favicon.ico" />

    <title>PCGest | Main Page</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
		function filtra_tab()
		{
			var testo=document.getElementById("search_tbx").value;

			
			var $rows = $('#tb_sfollati .riga');
			var val = $.trim(testo).replace(/ +/g, ' ').toLowerCase();

			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
				return !~text.indexOf(val);
			}).hide();
		
		}
		
		function apri_scheda(id_user)
		{
			var scheda = window.open("scheda_utente.php?id="+id_user, "Scheda Utente", "width=400,height=500");
		}
	</script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
		  <a class="navbar-brand" href="#">PCGest | Dipartimento della Protezione Civile</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Ricerca...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="index.html">Overview</a></li>
            <li><a href="#">Info</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
		  <hr><h3>Campo</h3>
		  <ul class="nav nav-sidebar">
            <li class="active"><a href="anagrafica_sfollati.php">Anagrafica sfollati <span class="sr-only">(current)</span></a></li>
            <li><a href="mappa.php">Struttura campo</a></li>
          </ul>
        </div>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Anagrafica sfollati</h1>

		  <input type="text" id="search_tbx" name="search_tbx" onkeyup="filtra_tab();" class="form-control" placeholder="Filtra...">
          <!--<h2 class="sub-header">Section title</h2>-->
          <div class="table-responsive">
            <table id="tb_sfollati" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Cognome</th>
                  <th>CF</th>
                </tr>
              </thead>
              <tbody>
			<?php
				$query = "SELECT id, nome, cognome, codicefiscale FROM `sfollati`";
				if ($result = mysqli_query($conn, $query)) {
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr onclick='apri_scheda(".$row["id"].");' class='riga'><td>".$row["id"]."</td><td>".$row["nome"]."</td><td>".$row["cognome"]."</td><td>".$row["codicefiscale"]."</td></tr>";
					}
				}
			?>  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
