<?php
    include('../conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nimi = $_POST['nimi'];
        $kapasiteetti = $_POST['kapasiteetti'];

        $sql = "UPDATE Tila SET Nimi='$nimi', Kapasiteetti='$kapasiteetti' WHERE ID='$id'";
        mysqli_query($conn, $sql);
        //mysqli_query($conn, "DELETE FROM osallistumiset WHERE OsallistujaID='$id'");

        header("location:../index.php");
    }
?>