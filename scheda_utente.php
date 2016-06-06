<?php
	include("include/connection.php");
	include("include/menuprinter.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
	<?php
		print_head("Scheda personale", false);
		
		if(isset($_POST["tb_nome"]))
		{
			$nome=$_POST["tb_nome"];
			$cognome=$_POST["tb_cognome"];
			$userid=$_POST["tb_userid"];
			$cf=$_POST["tb_cf"];
			$idgrp=$_POST["cbx_sangue"];
			$grpsanguigno = array("A+", "A-", "B+", "B-", "0+", "0-", "AB+", "AB-");
			
			$query = "UPDATE `sfollati` SET nome='$nome', cognome='$cognome', codicefiscale='$cf', grpsanguigno='".$grpsanguigno[($idgrp-1)]."' WHERE id='$userid';";
			if(!mysqli_query($conn, $query))
				echo "Errore nel DB".mysqli_error($conn);
		}
		else
		{
			if(!isset($_GET["id"]))
				echo '<script>window.close(); history.back();</script>';
		}
	?>
	<script>
		window.onunload = refreshParent;
		function refreshParent() {
			window.opener.location.reload();
		}
	</script>
  </head>
  <body>
  <h1 class="page-header">Scheda personale</h1>
	<div class="container">
		
		<?php
			if(isset($_POST["tb_nome"]))
			{
				echo '<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				  <span class="sr-only">Salvato:</span>
				  Dati aggiornati correttamente
				</div>';
			}
			
			$query = "SELECT id, nome, cognome, codicefiscale, grpsanguigno AS sangue FROM `sfollati` WHERE id='".$_GET["id"]."'";
			if ($result = mysqli_query($conn, $query)) {
				$row = mysqli_fetch_assoc($result);
				echo '<form method="POST" class="form-horizontal">';
				echo '<input type="hidden" id="tb_userid" name="tb_userid" value="'.$row["id"].'">';
				echo '<div class="form-group">
				  <label for="tb_nome" class="col-xs-3 control-label">Nome</label>
				  <div class="col-xs-9">
					<input type="text" id="tb_nome" name="tb_nome" class="form-control" placeholder="Nome" value="'.$row["nome"].'">
				  </div>
				</div>';
				
				echo '<div class="form-group">
				  <label for="tb_cognome" class="col-xs-3 control-label">Cognome</label>
				  <div class="col-xs-9">
					<input type="text" id="tb_cognome" name="tb_cognome" class="form-control" placeholder="Cognome" value="'.$row["cognome"].'">
				  </div>
				</div>';
				
				echo '<div class="form-group">
				  <label for="tb_cf" class="col-xs-3 control-label">Nome</label>
				  <div class="col-xs-9">
					<input type="text" id="tb_cf" name="tb_cf" class="form-control" placeholder="CF" value="'.$row["codicefiscale"].'">
				  </div>
				</div>';
				
				echo '<div class="form-group">
					<label for="cbx_sangue" class="col-xs-3 control-label">Gruppo sanguigno:</label>
					<div class="col-xs-9">
						<select id="cbx_sangue" name="cbx_sangue" class="form-control">
						  <option value="1" '.($row["sangue"]=="A+" ? "selected" : "").'>A+</option>
						  <option value="2" '.($row["sangue"]=="A-" ? "selected" : "").'>A-</option>
						  <option value="3" '.($row["sangue"]=="B+" ? "selected" : "").'>B+</option>
						  <option value="4" '.($row["sangue"]=="B-" ? "selected" : "").'>B-</option>
						  <option value="5" '.($row["sangue"]=="0+" ? "selected" : "").'>0+</option>
						  <option value="6" '.($row["sangue"]=="0-" ? "selected" : "").'>0-</option>
						  <option value="7" '.($row["sangue"]=="AB+" ? "selected" : "").'>AB+</option>
						  <option value="8" '.($row["sangue"]=="AB-" ? "selected" : "").'>AB-</option>
						</select>
					</div>
				</div>';
				
				echo '<br>';
				
				echo '<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aggiorna dati</button>';

				echo '</form>';
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