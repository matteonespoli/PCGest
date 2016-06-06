<?php
	include("include/connection.php");
	
	$id=$_GET["userid"];
	
	$query = "SELECT COUNT(id) as totale FROM sfollati WHERE id=$id";
	
	if ($result = mysqli_query($conn, $query)) {
		$row = mysqli_fetch_assoc($result);
		
		echo $row['totale'];
	}
	else echo "0";
?>
