<?php
	include("include/connection.php");
	header('Content-Type: application/xml');
	
	$id_dest=$_GET["id"];
	
	$result = mysqli_query($conn,"SELECT c.id as id, u.cognome as mittente, messaggio FROM cercapersone as c INNER JOIN utenti as u ON c.idmittente=u.id WHERE iddestinatario='$id_dest' ORDER BY id DESC");

	$data_reader = array();
	$outp = '<?xml version="1.0" encoding="UTF-8"?>';
	$outp .= '<messages>
';
	while($row = mysqli_fetch_array($result))
	{
		$outp .= '	<message>
		<id>'.$row["id"].'</id> ';
		$outp .= '<sender>'.$row["mittente"].'</sender> ';
		$outp .= '<msg>'.$row["messaggio"].'</msg>
	'; 
		$outp .= '</message>
';
	}
	$outp .="</messages>";

	echo $outp;
	
	mysqli_close($conn);
?>