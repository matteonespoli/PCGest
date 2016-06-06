<?php
	include("include/connection.php");
	include("include/menuprinter.php");
	include("include/procedures.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
	<?php
		print_head("Home Page", true);
	?>
  </head>

  <body>
	<?php
		print_nav();
	?>
    
    <div class="container-fluid">
      <div class="row">
        
		<?php
			print_lateral_menu(11);
		?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Homepage</h1>

          <div class="row placeholders">
            <div class="img-hover col-xs-6 col-sm-3 placeholder">
              <img src="img/pc_logo.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Dipartimento della Protezione Civile</h4>
            </div>
            <div class="img-hover col-xs-6 col-sm-3 placeholder">
              <img src="img/pc_rl.png" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Protezione Civile Regione Lombardia</h4>
            </div>
            <div class="img-hover col-xs-6 col-sm-3 placeholder">
              <img src="img/pc_bg.png" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Protezione Civile Provincia di Bergamo</h4>
            </div>
            <div class="img-hover col-xs-6 col-sm-3 placeholder">
              <img src="img/pc_ana.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Protezione Civile Volontariato A.N.A.</h4>
            </div>
          </div>
		  <hr>
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
			
			<h2>
			   <?php echo 'Campo <b>"'.$nomecampo.'"</b> - Posizione: <b>'.$poscampo."</b> -  Postazione: <b>".getClientIpAddr()."</b>"; ?>
			</h2>
          
        </div>
      </div>
    </div>
	<?php
		print_bottom();
	?>
  </body>
</html>
