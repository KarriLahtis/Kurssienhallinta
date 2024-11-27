<?php
	include('../conn.php');
	
	$nimi=$_POST['nimi'];
	$kapasiteetti=$_POST['kapasiteetti'];
		
	$sql = " INSERT INTO Tila (Nimi, Kapasiteetti) VALUES ('$nimi', '$kapasiteetti'); ";
	mysqli_query($conn, $sql);
	header('location:../index.php');
	
?>