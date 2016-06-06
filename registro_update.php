<?php
	include("include/connection.php");
	
	$return_arr = array();
	
	$query = "SELECT r.id AS id, s.nome AS nome, s.cognome AS cognome, DATE_FORMAT(r.data,'%d/%m/%Y') AS data, DATE_FORMAT(r.ora,'%H:%i:%s') AS ora, r.tipo AS tipo FROM `sfollati` AS s INNER JOIN `registroinout` AS r ON s.id=r.id_persona ORDER BY id DESC";
	if ($result = mysqli_query($conn, $query)) {
		while($row = mysqli_fetch_assoc($result))
		{
			$row_array['id'] = $row['id'];
			$row_array['tipo'] = $row['tipo'];
			$row_array['cognome'] = $row["cognome"];
			$row_array['nome'] = $row["nome"];
			$row_array['data'] = $row["data"];
			$row_array['ora'] = $row["ora"];

			array_push($return_arr,$row_array);
		}
		echo json_encode($return_arr);
	}
	else echo "";
?>
