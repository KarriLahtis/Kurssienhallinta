<?php
	include('../conn.php');
	
	$etunimi=$_POST['etunimi'];
	$sukunimi=$_POST['sukunimi'];
    $syntymapaiva=$_POST['syntymapaiva'];
    $vuosikurssi=$_POST['vuosikurssi'];
		
	$sql = " INSERT INTO Opiskelija (Etunimi, Sukunimi, Syntymapaiva, Vuosikurssi) VALUES ('$etunimi', '$sukunimi', '$syntymapaiva', '$vuosikurssi'); ";
	mysqli_query($conn, $sql);
	header('location:../index.php');
	
?>