<?php
	include("include/connection.php");
	
	$query = "SELECT id, nome, cognome, codicefiscale FROM `sfollati` WHERE id='".$_GET["id"]."'";
	if ($result = mysqli_query($conn, $query)) {
		$row = mysqli_fetch_assoc($result);
		echo "<p>".$row["id"]."-".$row["nome"]."-".$row["cognome"]."-".$row["codicefiscale"]."</p>";
	}

?>