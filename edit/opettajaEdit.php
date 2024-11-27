<?php
    include('../conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $etunimi = $_POST['etunimi'];
        $sukunimi = $_POST['sukunimi'];
        $aine = $_POST['aine'];

        $sql = "UPDATE Opettaja SET Etunimi='$etunimi', Sukunimi='$sukunimi', Aine='$aine' WHERE ID='$id'";
        mysqli_query($conn, $sql);
        //mysqli_query($conn, "DELETE FROM osallistumiset WHERE OsallistujaID='$id'");

        header("location:../index.php");
    }
?>