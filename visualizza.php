<?php
	include("include/connection.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Registrazione Festa di Primavera Zanica 2016">
	<meta name="keywords" content="zanica, piazza, mercatini bergamo">
	
	<title>Festa di Primavera 2016 - Zanica</title>

	<!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	
	<script> 
	
		if(localStorage.getItem("iknowyou")===null || localStorage.getItem("iknowyou")!='yes')
		{
			document.write('<!--');
			var ident = prompt("Area di Gestione ad Accesso Ristretto\nInserire la password:");
    
			if (ident == "comart")
			{	
				localStorage.setItem("iknowyou","yes");
				document.write('-->');
			}
			else
				location.href='index.html';
		}
		
		function apri(url) { 
			newin = window.open(url,'Visualizza e Modifica','scrollbars=yes,resizable=yes, width=500px,height=500px,status=no,location=no,toolbar=no');
		} 
	</script>
	<style>
		tr{ cursor:pointer; }
	</style>
</head>
	<body>
	<center>
		<h1>Festa di Primavera 2016</h1><h2>15 maggio 2016 - ZANICA</h2><h2><b>Riepilogo Adesioni</b></h2>
		<hr>
		
	<table id="myTable" class="table table-hover">
		<tr><th>#</th><th>Denominazione</th><th>Nome</th><th>Cognome</th><th>E-Mail</th><th>Categoria</th><th>Luce</th><th>Tavoli</th><th>Totale</th><th>Postazione</th><th>Stato</th></tr>
		<?php
			setlocale(LC_MONETARY, 'it_IT');
		$n_iscritti=0;
		$incasso=0;
		$incasso_p=0;
		$totali = array(0, 0, 0, 0, 0);	
		$query = "SELECT * FROM `iscrizionimn` WHERE 1 ORDER BY `id` DESC";


		if ($result = mysqli_query($conn, $query)) {

			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr onclick="apri(\'edit.php?transazione='.$row["id_transazione"].'\');"><td>'.$row["id"].'</td><td>'.$row["ragsoc"].'</td><td>'.$row["nome"].'</td><td>'.$row["cognome"].'</td><td>'.$row["mail"].'</td><td>'.$row["categoria"].'</td>';

				if($row["luce"]=="1")
					echo '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
				else
					echo '<td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
				echo '<td>'.$row["tavoli"].'</td>';
				echo '<td>'.money_format('%.2n',$row["totale"]).'</td>';
				/*if($row["pay_to"]=="Bar")					
					$totali[0]=$totali[0]+$row["totale"];				
				elseif($row["pay_to"]=="Delizie")					
					$totali[1]=$totali[1]+$row["totale"];				
				elseif($row["pay_to"]=="Nespoli")					
					$totali[2]=$totali[2]+$row["totale"];	*/			
				if($row["status"]=="2")					
					$totali[4]=$totali[4]+$row["totale"];
				echo '<td>'.$row["postazione"].'</td>';	
				if($row["status"]=="0")
					echo '<td data-toggle="tooltip" title="Non pagato"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></td></tr>';
				else if($row["status"]=="1")
					echo '<td data-toggle="tooltip" title="'.$row["pay_to"].'"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></td></tr>';
				else
					echo '<td data-toggle="tooltip" title="PayPal"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></td></tr>';
				$n_iscritti=$n_iscritti+1;
				$incasso=$incasso+$row["totale"];
				if($row["status"]!="0")
					$incasso_p=$incasso_p+$row["totale"];
			}

			/* free result set */
			mysqli_free_result($result);
		}

		/* close connection */
		mysqli_close($conn);
		
		echo '</table><h3>Totale iscrizioni: '.$n_iscritti.' ('.money_format('%.2n',$incasso).') - Incassato: '.money_format('%.2n',$incasso_p).'</h3><br>';				
	
		echo 'Totale PayPal: '.money_format('%.2n',$totali[4]).'</h4><br>';		
		?>
	</center>
	<p style="text-align:right">Gestionale Eventi 2016 | Ver. 2.5 del 28/04/2016</p>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
			});
	</script>
</body>
</html>