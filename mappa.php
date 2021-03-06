<?php
	include("include/connection.php");
	include("include/menuprinter.php");
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
	<link rel="icon" type="image/x-icon" href="favicon.ico" />
	
	<title>PCGest | Mappa</title>
	
	<!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="./jquery-ui/jquery-ui.css">
	<script src="./jquery-ui/jquery.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript" src="javascript.js"></script>
	<style>
		.draggable { margin: 0; 
			border: 0; 
			/* background-color: #004080; */
			color: white; 
			weight:bold; 
			display:flex; 
			justify-content:center; 
			align-items:center; 
			font-size: 15px; 
			cursor: move; 
		}
		.draggable-icon { margin: 0; border: 0; background-color: #004080; color: white; weight:bold; border-radius: 10px; display:flex; justify-content:center; align-items:center; font-size: 35px; cursor: pointer; }
		canvas{ marginLeft: 0px; marginTop: 0px; top: 0px; left: 0px; }
				
		@media print {
			.no-print{
				display: none !important;
			}
			.print {
				display: block !important;
			}
		}
		
		/* The side navigation menu */
		.sidenav {
			height: 100%; /* 100% Full-height */
			width: 0; /* 0 width - change this with JavaScript */
			position: fixed; /* Stay in place */
			z-index: 10; /* Stay on top */
			top: 0;
			right: 0;
			background-color: lightskyblue; /* #111; Black*/
			overflow-x: hidden; /* Disable horizontal scroll */
			padding-top: 60px; /* Place content 60px from the top */
			transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
		}

		/* The navigation menu links */
		.sidenav a {
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			font-size: 25px;
			color: #818181;
			display: block;
			transition: 0.3s
		}

		/* When you mouse over the navigation links, change their color */
		.sidenav a:hover, .offcanvas a:focus{
			color: #f1f1f1;
		}

		/* Position and style the close button (top right corner) */
		.closebtn {
			position: absolute;
			top: 40px;
			right: 25px;
			font-size: 36px !important;
			margin-left: 50px;
		}

		/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
		#main {
			transition: margin-right .5s;
			padding: 20px;
		}

		/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 18px;}
		}
		#aprichiudi{
			width:50px; 
			height:50px; 
			position: fixed;
			right:0px;
			top:50%;
			background-color: #111;
			display:flex;
			justify-content:center;
			align-items:center;
			color:white;	
			z-index:2;
			cursor: pointer;
		}
	</style>
	<script>
		/*$(function() {
		$(".draggable").draggable({
			grid: [ 30, 30 ], 
			containment: "parent", 
			scroll: false,
			drag: function( event, ui ) {
			 var id_box=document.getElementById(ui.helper[0].id).getAttribute("data-id");
			 boxes[(id_box-1)].x=ui.position.left;
			 boxes[(id_box-1)].y=ui.position.top;
			}
		});
		});*/
		
		var dim_campo=[100,50]; //dimensioni campo (richieste all'utente)
		<?php			
			$query = "SELECT name, value FROM `settings` WHERE name='Wcampo' OR name='Hcampo'";
			if ($result = mysqli_query($conn, $query)) {
				while($row = mysqli_fetch_assoc($result))
				{
					if($row["name"]=="Wcampo")
						echo "dim_campo[0]=".$row["value"]."; ";
					else if($row["name"]=="Hcampo")
						echo "dim_campo[1]=".$row["value"].";";
				}
			}
			else
			{
				echo 'dim_campo[0]=prompt("Larghezza campo (X):");';
				echo 'dim_campo[1]=prompt("Altezza campo (Y):");';
			}
		?>
	</script>
  </head>
<body>
	<?php
		print_nav();
	?>
		<div id="mySidenav" class="no-print sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<div class="container" style="width:300px;">
				<span id="txt"></span>
				<div id="sample-div" class="draggable-icon" style="width:80px; height:80px;">S#</div>
				<br>
				<div class="form-group">
					<label for="select_tenda">Tipologia:</label>
					<select id="select_tenda" class="form-control">
					  <option value="0">Tenda piccola (1x1)</option>
					  <option value="1">Tenda lunga (1x2)</option>
					  <option value="2">Tenda media (2x2)</option>
					  <option value="3">Tenda grande (3x3)</option>
					  <option value="4">Cucina (5x3)</option>
					</select>
					<button id="button1" class="btn btn-warning"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi alla mappa</button>
					<br><br>
					<button id="button2" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salva mappa</button>
					<form id="frm1" method="POST" action="save_map.php"><input type="hidden" name="map_json" id="map_json"/></form>
				</div>
				<br>
			</div>
		</div>

		<div id="aprichiudi" onclick="openNav();" class="no-print btn-lg">
			<div>
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
			</div>
		</div>

		<div id="main" class="container" style="padding-top: 40px;">
			<h1 class="print" style="text-align: center;">Dipartimento della Protezione Civile</h1>
			<h2 class="print" style="text-align: center;">Mappa del campo</h2>
		
			<div class="row">
				<div class="col-lg-12">
					<div class="print" id="container" style="overflow: hidden; position: relative;">
						<canvas id="canvas" style="position: absolute; z-index: -1;"></canvas>
					</div>
				</div>
			</div>
			<br/>
			<!--RIPORTATO IN MENU LATERALE
			<div class="no-print">
				<span id="txt"></span>
				<div id="sample-div" class="draggable-icon" style="width:80px; height:80px;">S#</div>
				<br>
				<div class="form-group">
					<label for="select_tenda">Tipologia:</label>
					<select id="select_tenda" class="form-control input-lg">
					  <option value="0">Tenda piccola (1x1)</option>
					  <option value="1">Tenda lunga (1x2)</option>
					  <option value="2">Tenda media (2x2)</option>
					  <option value="3">Tenda grande (3x3)</option>
					  <option value="4">Cucina (5x3)</option>
					</select>
					<button id="button1" class="btn btn-warning"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi alla mappa</button>
					<br>
					<button id="button2" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salva</button>
					<form id="frm1" method="POST" action="save_map.php"><input type="hidden" name="map_json" id="map_json"/></form>
				</div>
				<br>
			</div>-->
		</div>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script>
		canvas = document.getElementById('canvas');
		ctx = canvas.getContext('2d');
		
		canvas.onselectstart = function () { return false; }
		
		$("#container").width(Math.floor($("#main").width()));
		//$("#container").height(Math.floor($("#main").height()));
		
		var Cwidth=$("#container").width();
		
		var bw = Cwidth-1; //750; //$(document).width();
		var stepX=Math.floor((bw)/(dim_campo[0]));
		bw=stepX*dim_campo[0];
		
		var bh = stepX*(dim_campo[1]);//Cheight; 450;
		var stepY=Math.floor((bh)/(dim_campo[1]));
		var p = 0;
		//alert(bw+"x"+bh);
		$("#container").height(bh+1);
		var Cheight=$("#container").height();	
		
		canvas.width = bw+1;
		canvas.height = bh+1;

		for (var x = 0; x <= bw; x += stepX) {
			ctx.moveTo(0.5 + x + p, p);
			ctx.lineTo(0.5 + x + p, bh + p);
		}


		for (var x = 0; x <= bh; x += stepY) {
			ctx.moveTo(p, 0.5 + x + p);
			ctx.lineTo(bw + p, 0.5 + x + p);
		}

		ctx.strokeStyle = "black";
		ctx.stroke();
		var count=0;
		
		$("#button2").click(function(){
			var recursiveEncoded = JSON.stringify(boxes);
			document.getElementById("map_json").value=recursiveEncoded;
			alert(recursiveEncoded);
			document.getElementById("frm1").submit();
		});
		
		function aggiungi_rettangolo(tipo, posX, posY, Pkey)
		{
			count++;
			var dim=[[1,1],[1,2],[2,2],[3,3],[5,3]];
			var colori=["#004080","green","red","blue","orange"]
			if(tipo==null)
				var scelta=document.getElementById("select_tenda").value;
			else
				var scelta=tipo;
			
			if(Pkey==null)
				Pkey="S"+count;
			
			var altezza=((dim[scelta][1]-1)*stepY)+stepY;
			var larghezza=((dim[scelta][0]-1)*stepX)+stepX;
			
			$("<div/>", {
			   "class": "draggable",
			   "id": "draggable"+count,
			   "data-id": count,
				text: Pkey,
			  }).appendTo("#container");
			  
			 $("#draggable"+count).css({ 
				position: "absolute",
				marginLeft: 0, marginTop: 0,
				top: posY, left: posX, width:larghezza, height:altezza,
				"background-color": colori[scelta]
			 });
			 
			 $("#draggable"+count).draggable({
				grid: [ stepX, stepY ], 
				containment: "#canvas", 
				scroll: false,
				drag: function( event, ui ) {
				 var id_box=document.getElementById(ui.helper[0].id).getAttribute("data-id");
				 boxes[(id_box-1)].x=Math.floor(ui.position.left / 10) * 10/stepX;
				 boxes[(id_box-1)].y=Math.floor(ui.position.top / 10) * 10/stepY;
				 //console.log(boxes[(id_box-1)]);
				}
			});
			 
			 addRect(posX/stepX, posY/stepY, larghezza, altezza, scelta, "#FF0000", "S"+count);
		}
		
		$("#button1, #sample-div").click(function(){
			//var tipo=document.getElementById("select_tenda").value;
			aggiungi_rettangolo(null, 0, 0, null);
			
		});
		
		if($( window ).width()<1182){
			alert("Risoluzione troppo bassa. Impossibile caricare.")
			location.href=".";
		}
		
		var aperto=false;
		
		/* Set the width of the side navigation to 250px */
		function openNav() {
			document.getElementById("mySidenav").style.width = "300px";
			aperto=true;
		}

		/* Set the width of the side navigation to 0 */
		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			aperto=false;
		}
		
		<?php
			$query = "SELECT x, y, w, h, tipo, label FROM `campo`";
			if ($result = mysqli_query($conn, $query)) {
				while($row = mysqli_fetch_assoc($result))
				{
					echo 'aggiungi_rettangolo('.$row["tipo"].', ('.$row["x"].'*stepX), ('.$row["y"].'*stepY), "'.$row["label"].'"); ';
					
				}
			}
		?>
	</script>
</body>
</html>