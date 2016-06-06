<?php
	include("include/connection.php");
	include("include/menuprinter.php");
	include("include/procedures.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
	<?php
		print_head("Personale", true);
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
			print_lateral_menu(24);
		?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Gestione personale</h1>
		  
		  <h2>Personale attivo</h2>
		  
			<div class="panel-group" id="tab_personale" role="tablist" aria-multiselectable="false">
			<?php
				$query = "SELECT p.id as id, p.nome as nome, p.cognome as cognome, p.tessera as tessera, s.nome as spec FROM `personale` AS p INNER JOIN `specializzazioni` AS s ON p.specializzazione=s.id";
				if ($result = mysqli_query($conn, $query)) {
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="TabHeading'.$row["id"].'">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#tab_personale" href="#collapse'.$row["id"].'" aria-expanded="false" aria-controls="collapse'.$row["id"].'">
					  '.$row["cognome"].' '.$row["nome"].'
									</a>
								</h4>
							</div>
							<div id="collapse'.$row["id"].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="TabHeading'.$row["id"].'">
							  <div class="panel-body">
								<div class="row">
									<div class="col-xs-4 col-md-2">
										<img src="./img/fototessera.png" class="img-rounded" style="width:90%;">
									</div>
									<div class="col-xs-8 col-md-10">
										Cognome: '.$row["cognome"].'<br>
										Nome: '.$row["nome"].'<br>
										Tessera: '.$row["tessera"].'<br>
										Specializzazione: '.$row["spec"].'<br>
										<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contatta</button>
										<button class="btn btn-default" type="button" data-toggle="modal" data-iddest="'.$row["id"].'" data-target="#MessageModal"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Cercapersone</button>
									</div>
								</div>
							  </div>
							</div>
						</div>';
					}
				}
			?>
			</div>
        </div>
      </div>
    </div>
	
	<div class="modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="MessageModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="MessageModalLabel">Cercapersone</h4>
				</div>
				<div class="modal-body">
					<form id="frm1">
					  <div id="alertOK" role="alert" class="alert alert-success" style="display: none"> 
						<a class="close" onclick="$('#alertOK').hide()">&times;</a>  
						<strong>Messaggio Inviato!</strong> Il destinatario lo ricever&agrave; entro qualche minuto.  
					  </div>
					  <div id="alertNO" role="alert" class="alert alert-danger" style="display: none"> 
						<a class="close" onclick="$('#alertNO').hide()">&times;</a>  
						<strong>Messaggio non inviato!</strong> Verificare il destinatario e ritentare.  
					  </div>
					  
					  <div class="form-group">
							<label for="recipientid" class="control-label">Destinatario:</label>
							<input type="text" class="form-control" id="recipientid" name="recipientid" readonly required value="">
					  </div>
					  <div class="form-group" id="message_grp">
							<label for="message" class="control-label">Messaggio:</label>
							<input type="text" required class="form-control" id="message" name="message" value="">
					  </div>
					  
					</form>
				</div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
				<button onclick="invia_messaggio();" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Invia</button>
			  </div>
			</div>
		</div>
	</div>
	
	<?php
		print_bottom();
	?>
	<script>
		$('#MessageModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget);
		  var recipient = button.data('iddest');
		  $('#alertOK').hide();
		  $('#alertNO').hide();
		  document.getElementById('recipientid').value=recipient; 
		  document.getElementById('message').value=""; 
		});
		
		function invia_messaggio()
		{
			var destinatario = document.getElementById('recipientid').value;
			var messaggio = document.getElementById('message').value;
			$("#message_grp").className = "form-control";
			
			if(destinatario!="" && messaggio!="")
			{
				$.post("message_sender.php",
				{
					recipient: destinatario,
					message: messaggio
				},
				function(data, status){
					if(data=="1")
					{
						$('#alertOK').show();
					}
					else
					{	
						$('#alertNO').show();
					}
				});	
			}
			else
				$("#message_grp").addClass("has-error");
		}
	</script>
  </body>
</html>
