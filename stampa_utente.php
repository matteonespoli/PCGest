<?php
	include("include/connection.php");
	include("include/menuprinter.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
	<?php
		print_head("Scheda personale", false);
	?>
	<style>
		@media print {
			body {
				width: 6,2cm;
			}
		}
	</style>
  </head>
  <body>
	<div class="container">	
		<?php
			
			$query = "SELECT id, nome, cognome, codicefiscale, grpsanguigno AS sangue FROM `sfollati` WHERE id='".$_GET["id"]."'";
			if ($result = mysqli_query($conn, $query)) {
				$row = mysqli_fetch_assoc($result);
				echo '<center><h4><b>Protezione Civile</b></h4></center>';
				echo '<h4>Cognome: '.$row["nome"].'</h4>';
				echo '<h4>Nome: '.$row["cognome"].'</h4>';
				echo '<h4>GS: '.$row["sangue"].'</h4>';
				echo "<img src='https://chart.googleapis.com/chart?cht=qr&chl=www.google.com&chs=180x180&choe=UTF-8&chld=L|2' alt=''>";
				echo '<script>window.print();</script>';
			}
			else
				echo '<script>window.close(); history.back();</script>';
		?>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>