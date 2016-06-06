<?php
	include("include/connection.php");
	include("include/menuprinter.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php
		print_head("Anagrafica Sfollati", true);
	?>
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
			var scheda = window.open("scheda_utente.php?id="+id_user, "Scheda Utente", "left=100,top=100,width=400,height=500");
		}
		
		function apri_stampa(id_user)
		{
			var scheda = window.open("stampa_utente.php?id="+id_user, "Scheda Utente", "left=100,top=100,width=400,height=500");
		}
	</script>
  </head>

  <body>

    <?php
		print_nav();
	?>

    <div class="container-fluid">
      <div class="row">
        
		<?php
			print_lateral_menu(21);
		?>
				
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Anagrafica sfollati</h1>
		  
		  <div class="input-group form-group">
			<span class="input-group-addon" id="sizing-addon2">Ricerca</span>
			<input type="text" id="search_tbx" name="search_tbx" onkeyup="filtra_tab();" class="form-control" aria-describedby="sizing-addon2" placeholder="Filtra...">
          </div>
	
		  <!--<h2 class="sub-header">Section title</h2>-->
          <div class="table-responsive">
            <table id="tb_sfollati" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Cognome</th>
				  <th>Sesso</th>
                  <th>Codice Fiscale</th>
				  <th>Tenda</th>
                </tr>
              </thead>
              <tbody>
			<?php
				$query = "SELECT s.id AS id, nome, cognome, sesso, codicefiscale, label FROM `sfollati` AS s INNER JOIN `campo` AS c ON s.idtenda=c.id";
				if ($result = mysqli_query($conn, $query)) {
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr id='sfollato".$row["id"]."' onclick='apri_scheda(".$row["id"].");' class='riga'><td>".$row["id"]."</td><td>".$row["nome"]."</td><td>".$row["cognome"]."</td><td>".$row["sesso"]."</td><td>".$row["codicefiscale"]."</td><td>".$row["label"]."</td></tr>";
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
