<?php
	include("include/connection.php");
	include("include/menuprinter.php");
	include("include/procedures.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
	<?php
		print_head("Overview", true);
	?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
  </head>

  <body>
	<?php
		print_nav();
	?>
    
    <div class="container-fluid">
      <div class="row">
        
		<?php
			print_lateral_menu(12);
		?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Overview</h1>

			<?php
				$query = "SELECT name, value FROM `settings` WHERE name='NomeCampo' OR name='PosCampo'";
				if ($result = mysqli_query($conn, $query)) {
					while($row = mysqli_fetch_assoc($result))
					{
						if($row["name"]=="NomeCampo")
							$nomecampo=$row["value"];
						else if($row["name"]=="PosCampo")
							$poscampo=$row["value"];
					}
				}
			?>
			
			<h3>
			   <?php echo 'Campo <b>"'.$nomecampo.'"</b> - Posizione: <b>'.$poscampo."</b> -  Postazione: <b>".getClientIpAddr()."</b>"; ?>
			</h3>
			<hr>
			
			<h3>Situazione attuale:</h3>
			<div class="row">
				<div class="col-sm-4">
				<?php		
						$query = "SELECT COUNT(id) as Totale FROM `sfollati`";
						$presenze= array(0,0,0);
						if ($result = mysqli_query($conn, $query)) {
							$row = mysqli_fetch_assoc($result);
							$presenze[0]=$row["Totale"];
						}
						
						echo "<h4><b>Totale sfollati: ".$presenze[0]."</b></h4>";
						
						$query = "SELECT r.tipo as tipo FROM `sfollati` AS s INNER JOIN `registroinout` AS r ON s.id=r.id_persona WHERE r.id IN (SELECT MAX(`id`) FROM `registroinout` GROUP BY `id_persona`)";
						
						if ($result = mysqli_query($conn, $query)) {
							while($row = mysqli_fetch_assoc($result))
							{
								if($row["tipo"]=="1")
									$presenze[1]++;
								else
									$presenze[2]++;
							}
						}
						
						echo "<ul><li><h4>Presenti: <b>".$presenze[1]."</b></h4>";
						echo "</li><li><h4>Assenti: <b><a href='#assenti'>".$presenze[2]."</a></b></h4>";
						echo "</li><li><h4>Dispersi: <b><a href='#dispersi'>".($presenze[0]-($presenze[1]+$presenze[2]))."</a></b></h4></li></ul>";
						
					?>
				</div>
				<div class="col-sm-8">
					<div id="piechart" style="width: 900px; height: 350px;"></div>
				</div>
			</div>

				<h3 id="assenti">Assenti:</h3>
				<?php
					
					$query = "SELECT s.id as id, s.nome as nome, s.cognome as cognome, r.tipo as tipo FROM `sfollati` AS s INNER JOIN `registroinout` AS r ON s.id=r.id_persona WHERE r.id IN (SELECT MAX(`id`) FROM `registroinout` GROUP BY `id_persona`)";
					if ($result = mysqli_query($conn, $query)) {
						while($row = mysqli_fetch_assoc($result))
						{
							if($row["tipo"]!="1")
								echo "<p><a href='anagrafica_sfollati.php#sfollato".$row["id"]."'>".$row["nome"]." ".$row["cognome"]."</a></p>";
						}
					}
				?>
				<br>
				
				<h3 id="dispersi">Dispersi:</h3>
				<?php
					
					$query = "SELECT id, nome, cognome FROM `sfollati` WHERE id NOT IN (SELECT `id_persona` FROM `registroinout`)";
					if ($result = mysqli_query($conn, $query)) {
						while($row = mysqli_fetch_assoc($result))
						{
							echo "<p><a href='anagrafica_sfollati.php#sfollato".$row["id"]."'>".$row["nome"]." ".$row["cognome"]."</a></p>";
						}
					}
				?>
				
				<script type="text/javascript">
				  google.charts.load('current', {'packages':['corechart']});
				  google.charts.setOnLoadCallback(drawChart);
				  function drawChart() {

					var data = google.visualization.arrayToDataTable([
					  ['P/A',     "Numero" ],
					  ['Presenti',     <?php echo $presenze[1]; ?>],
					  ['Assenti',      <?php echo $presenze[2]; ?>],
					  ['Dispersi',     <?php echo ($presenze[0]-($presenze[1]+$presenze[2])); ?>]
					]);

					var options = {
					  //title: 'Grafico presenze',
					  chartArea:{left:50,top:50,bottom:10}
					};

					var chart = new google.visualization.PieChart(document.getElementById('piechart'));

					chart.draw(data, options);
				  }
				</script>
        </div>
      </div>
    </div>
	<?php
		print_bottom();
	?>
  </body>
</html>
