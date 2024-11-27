<?php
	include('../conn.php');
	
	$etunimi=$_POST['etunimi'];
	$sukunimi=$_POST['sukunimi'];
    $aine=$_POST['aine'];
		
	$sql = " INSERT INTO Opettaja (Etunimi, Sukunimi, Aine) VALUES ('$etunimi', '$sukunimi', '$aine'); ";
	mysqli_query($conn, $sql);
	header('location:../index.php');
	
?>