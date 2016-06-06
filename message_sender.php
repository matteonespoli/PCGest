<?php
	include("include/connection.php");
	
	$iddest=mysqli_real_escape_string($conn, $_POST["recipient"]);
	$messaggio=mysqli_real_escape_string($conn, $_POST["message"]);
	
	$query = "INSERT INTO `cercapersone` (idmittente, iddestinatario, messaggio) VALUES ('1', '".$iddest."', '".$messaggio."')";
	
	if ($result = mysqli_query($conn, $query)) {
		echo "1";
	}
	else 
		echo "0";
?>
