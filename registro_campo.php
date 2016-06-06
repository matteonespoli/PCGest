<?php
	include("include/connection.php");
	include("include/menuprinter.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
	<?php
		print_head("Registro di campo", true);
	?>
	<SCRIPT type="text/javascript" >
		function getScan(){
			location.href='zxing://scan/?ret='+encodeURI('http://10.10.20.4:8080/www/PCGest/registro_campo.php?lettura={CODE}');
		}
		
		function checkdata()
		{
			var userid=document.getElementById('userid').value;
			//$("input").prop('readonly', true);
			console.log("checking");
			$.ajax({
				url: "check_id.php?userid="+userid,
				type: 'GET',
				cache: false,
				timeout: 30000,
				success: function(data){
					console.log("data: "+data);
					//$("input").prop('readonly', false);
					if(data=="1")
					{
						$('#alertNO').hide();
						document.getElementById('frm1').submit();
					}
					else
					{
						$('#alertNO').show();
						document.getElementById('userid').focus;
					}
				}
			});
		}
	</SCRIPT>
  </head>

  <body>
	<?php
		print_nav();
	?>
    
    <div class="container-fluid">
      <div class="row">
        
		<?php
			print_lateral_menu(22);
			
			if(isset($_POST["userid"]))
			{
				$userid=$_POST["userid"];
				$tipo= $_POST["typeRadio"]=="in" ? "1" : "0";
				$query = "INSERT INTO `registroinout` (id_persona, data, ora, tipo) VALUES('".$userid."', CURDATE(), CURTIME(), '".$tipo."');";
				if(!mysqli_query($conn, $query))
					echo "Errore nel DB".mysqli_error($conn);
			}			
		?>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Registro di campo</h1>
			<div class="row">
				<button type="button" class="btn btn-success btn-lg col-xs-12 col-md-6" data-toggle="modal" data-tipo="in" data-target="#RegistroModal">
  <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Ingresso
</button>
				<button type="button" class="btn btn-danger btn-lg col-xs-12 col-md-6" data-toggle="modal" data-tipo="out" data-target="#RegistroModal">
  <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Uscita
</button>
			</div>
			<br>
			<h4>Live update <input id="switch-live" type="checkbox" checked></h4>
			<br>
			<!--<h2 class="sub-header">Section title</h2>-->
			<table id="tb_registro" class="table table-striped table-hover">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Tipo</th>
					  <th>Nome</th>
					  <th>Cognome</th>
					  <th>Data e ora</th>
					</tr>
				  </thead>
				  <tbody>
				<?php
					/*$query = "SELECT r.id AS id, s.nome AS nome, s.cognome AS cognome, DATE_FORMAT(r.data,'%d/%m/%Y') AS data, DATE_FORMAT(r.ora,'%H:%i:%s') AS ora, r.tipo AS tipo FROM `sfollati` AS s INNER JOIN `registroinout` AS r ON s.id=r.id_persona ORDER BY id DESC";
					if ($result = mysqli_query($conn, $query)) {
						while($row = mysqli_fetch_assoc($result))
						{
							echo "<tr class='";
							if($row["tipo"]=="1")
								echo "success";
							else
								echo "danger";
							echo "' onclick='apri_scheda(".$row["id"].");' class='riga'><td>".$row["id"]."</td><td><span class='glyphicon glyphicon-arrow-".($row["tipo"]=="1"?"down":"up")."' aria-hidden='true'></span></td><td>".$row["nome"]."</td><td>".$row["cognome"]."</td><td>".$row["data"]." ".$row["ora"]."</td></tr>";
						}
					}*/
					
				?>  
				  </tbody>
			</table>
        </div>
      </div>
    </div>
	<br>
	
	<div class="modal fade" id="RegistroModal" tabindex="-1" role="dialog" aria-labelledby="RegistroModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="RegistroModalLabel">Registro</h4>
				</div>
				<div class="modal-body">
					<div id="alertNO" role="alert" class="alert alert-danger" style="display: none"> 
						<a class="close" onclick="$('#alertNO').hide()">&times;</a>  
						<strong>Errore</strong> Identificativo non trovato  
					 </div>
					<form id="frm1" method="POST" autocomplete="off">
					  <div class="radio">
						  <label>
							<input type="radio" name="typeRadio" id="typeRadio1" value="in" <?php echo (isset($_GET["inout"]) && $_GET["inout"]=="1") ? "checked" : ""; ?>>
							IN
						  </label>
					  </div>
					  <div class="radio">
						  <label>
							<input type="radio" name="typeRadio" id="typeRadio2" value="out" <?php echo (isset($_GET["inout"]) && $_GET["inout"]=="0") ? "checked" : ""; ?>>
							OUT
						  </label>
					  </div>
					  <div class="form-group">
							<label for="userid" class="control-label">Codice:</label>
							<input type="text" class="form-control" id="userid" name="userid" value="<?php echo (isset($_GET["lettura"]) && isset($_GET["inout"])) ? $_GET["lettura"] : ""; ?>">
					  </div>
					</form>
				</div>
			  <div class="modal-footer">
			    <button onclick="getScan();" type="button" class="btn btn-warning visible-xs-inline">
					<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Scanner</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
				<button onclick="checkdata();" type="button" class="btn btn-primary">Salva</button>
			  </div>
			</div>
		</div>
	</div>
	
    <?php
		print_bottom();
	?>
	
	<script>
		$('#RegistroModal').on('show.bs.modal', function (event) {	
		  $('#alertNO').hide();
		  
		  var button = $(event.relatedTarget);
		  var recipient = button.data('tipo');
		  
		  if(recipient=="in")
			document.getElementById('typeRadio1').checked=true;
		  else
			document.getElementById('typeRadio2').checked=true;  
		});
		
		$('#RegistroModal').on('shown.bs.modal', function () {
		  $("#userid").focus();
		});
		
		$(function(argument) {
		  $('[type="checkbox"]').bootstrapSwitch();
		})
		
		update_registro();
		
		var livedata=setInterval(function(){ 
			update_registro();
		}, 6000);
		
		$('#switch-live').on('switchChange.bootstrapSwitch', function(event, state)  {
		  if(state)
		  {
			livedata=setInterval(function(){ 
				update_registro();
			}, 6000);
		  }
		  else
			clearTimeout(livedata);
		});
		
		$('#frm1').on('keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
			console.log("send");
			checkdata();
			e.preventDefault();
			return false;
		  }
		});
		
		function update_registro()
		{
			$.get("registro_update.php", function(data, status){
				var json_obj = jQuery.parseJSON(data);
				
				var tabella='';
				
				for (var i = 0; i < json_obj.length; i++) {
					var row=json_obj[i];
					tabella+= "<tr class='";
								if(row["tipo"]=="1")
									tabella+= "success";
								else
									tabella+= "danger";
								tabella+= "' onclick='apri_scheda("+row["id"]+");' class='riga'><td>"+row["id"]+"</td><td><span class='glyphicon glyphicon-arrow-"+(row["tipo"]=="1"?"down":"up")+"' aria-hidden='true'></span></td><td>"+row["nome"]+"</td><td>"+row["cognome"]+"</td><td>"+row["data"]+" "+row["ora"]+"</td></tr>";
				}			
				$('#tb_registro tbody').html(tabella);
				//document.getElementsByClassName('page-header')[0].innerHTML+=".";
				//alert(json_obj[0].id);
				//alert("Data: " + data + "\nStatus: " + status);
			});
		}
		<?php
			if (isset($_GET["lettura"]) && isset($_GET["inout"]))
			{
				echo "$('#RegistroModal').modal('show');";
			}
		?>
	</script>
	
  </body>
</html>
