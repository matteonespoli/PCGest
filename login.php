<?php
	include("include/connection.php");
	include("include/menuprinter.php");
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php
		print_head("Login");
	?>
	<!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
		<?php
			if(isset($_POST["inputCF"]) && $_POST["inputCF"]!="")
			{
				$query = "SELECT * FROM `utenti` WHERE codicefiscale='".$_POST["inputCF"]."' LIMIT 1";
					if ($result = mysqli_query($conn, $query)) {
						$row = mysqli_fetch_assoc($result);
						$count = mysqli_num_rows($result);
						if($count == 1)
						{	
							echo "Bentornato ".$row["cognome"]." ".$row["nome"];
							$_SESSION["auth"]="1";
						}
					}
			}
			else if(isset($_POST["inputUsername"]) && $_POST["inputUsername"]!="")
			{
					
			}
		?>
      <form id="frm_login" method="post" action="login.php" class="form-signin">
        <div class="form-signin-heading">
			<h1>PCGest</h1>
			<img style="width:80%;" src="./img/logo_dpc.svg"/>
			<h3>Accesso richiesto</h3>
		</div>
        <label for="inputUsername" class="sr-only">Codice identificativo</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Codice identificativo" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		<span id="messaggio"></span>
		<input type="hidden" id="inputRegionale" name="inputRegionale"/>
		<input type="hidden" id="inputCF" name="inputCF"/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
		<button class="btn btn-lg btn-warning btn-block" onclick="loginCNS();" type="button"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Accesso con CNS</button>
      </form>

    </div> <!-- /container -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
	<script>
		var key="";
		$( document ).ready(function() {
			<?php 
				if(!isset($_POST["inputCF"]))
				{
					echo '$.ajax({
						url: "http://localhost:5000/",
						jsonpCallback: "callback",
						dataType: "jsonp",
						data: {
							id: "0"
						},
						success: function(response) {
							key=response; 
							console.log("reply:"+response);
						}
					});';
				}
			?>
		});
	
		function loginCNS()
		{
			/*$.get("http://127.0.0.1:5000/", { id: "1" } )
			  .done(function( data ) {
				alert( "Data Loaded: " + data );
			});*/
			document.getElementById("messaggio").innerHTML="Inserire la CNS e attendere.";
			$.ajax({
				url: "http://localhost:5000/",
				jsonpCallback: "callback",
				dataType: "jsonp",
				data: {
					id: "1",
					auth: key
				},
				success: function(response) {
					document.getElementById("messaggio").innerHTML="Carta rilevata. Lettura in corso";
					if(response!=null && response!="")
					{
						document.getElementById("inputRegionale").value=response[3]; 
						document.getElementById("inputCF").value = response[2]; 
						document.getElementById("frm_login").submit();
						console.log(response);
					}
					else
						document.getElementById("messaggio").innerHTML="Autenticazione non riuscita";
				}
			});
		}
	</script>
  </body>
</html>
