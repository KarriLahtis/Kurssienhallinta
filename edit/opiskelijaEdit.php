<?php
    include('../conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $etunimi = $_POST['etunimi'];
        $sukunimi = $_POST['sukunimi'];
        $syntymapaiva = $_POST['syntymäpäivä'];
        $vuosikurssi = $_POST['vuosikurssi'];

        $sql = "UPDATE Opiskelija SET Etunimi='$etunimi', Sukunimi='$sukunimi', Syntymapaiva='$syntymapaiva', Vuosikurssi='$vuosikurssi' WHERE ID='$id'";
        mysqli_query($conn, $sql);
        //mysqli_query($conn, "DELETE FROM osallistumiset WHERE OsallistujaID='$id'");

        header("location:../index.php");
    }
?>