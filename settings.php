<?php
	include("include/connection.php");
	include("include/menuprinter.php");
	
	if(isset($_POST["largcampo"]))
	{
		$impostazioni["Wcampo"]=$_POST["largcampo"];
		$impostazioni["Hcampo"]=$_POST["lungcampo"];
		
		foreach($impostazioni as $x => $x_value) {
			$query="UPDATE `settings` SET value='".$x_value."' WHERE name='".$x."';";
			mysqli_query($conn, $query);
		}
	}
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/x-icon" href="favicon.ico" />

    <title>PCGest | Settings</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	<?php
		print_nav();
	?>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Settings</h1>
			<?php
				$impostazioni = array();
				$query = "SELECT name, value FROM `settings`";
				if ($result = mysqli_query($conn, $query)) {
					while($row = mysqli_fetch_assoc($result))
					{
						$impostazioni[$row["name"]] = $row["value"];
					}
				}
			?> 	
			<form class="form-inline" method="POST">
			  <h3>Dimensioni campo:</h3>
			  <div class="form-group">
				<label for="largcampo">Larghezza</label>
				<input type="number" class="form-control" name="largcampo" id="largcampo" value="<?php echo $impostazioni["Wcampo"]; ?>">
			  </div>
			  <div class="form-group">
				<label for="lungcampo">Lunghezza</label>
				<input type="number" class="form-control" name="lungcampo" id="lungcampo" value="<?php echo $impostazioni["Hcampo"]; ?>">
			  </div>

			  <h3>Dimensioni campo:</h3>
			  <div class="form-group">
				<label for="exampleInputName2">Larghezza</label>
				<input type="number" class="form-control" id="exampleInputName2" value="0">
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail2">Lunghezza</label>
				<input type="number" class="form-control" id="exampleInputEmail2" value="0">
			  </div>
			  <br><br>
			  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salva impostazioni</button>
			</form>
			
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
