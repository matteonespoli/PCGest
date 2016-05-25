<?php
	include("include/connection.php");
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

    <title>PCGest | Login</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
		<?php
		
			class Box {
			  public $x = 0;
			  public $y = 0;
			  public $w = 0;
			  public $h = 0;
			  public $type = 0;
			  public $label="";
			  public $fill = '';
			}

			if(isset($_POST["map_json"]) && $_POST["map_json"]!="")
			{
				
				$boxes = array();
				
				$tempData = html_entity_decode($_POST["map_json"]);
				$data = json_decode($tempData, true);
				
				$query = "DELETE FROM `campo`;";
					if (!mysqli_query($conn, $query)) {
						echo("Error description: " . mysqli_error($conn));
					}
				
				foreach ($data as $key)
				{
					$o = new Box();
					$o->x=$key["x"];
					$o->y=$key["y"];
					$o->w=$key["w"];
					$o->h=$key["h"];
					$o->type=$key["type"];
					$o->label=$key["label"];
					$o->fill=$key["fill"];
					$boxes[] = &$o;
					
					$query = "INSERT INTO `campo` (x, y, w, h, tipo, label, fill) VALUES ('".$o->x."','".$o->y."','".$o->w."','".$o->h."','".$o->type."','".$o->label."','')";
					
					if (!mysqli_query($conn, $query)) {
						echo("Error description: " . mysqli_error($conn));
					}
				}
				echo "<h2>Mappa aggiornata</h2>";

			}
		?>
	</div>
  </body>
</html>
