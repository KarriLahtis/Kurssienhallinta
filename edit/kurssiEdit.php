<?php
    include('../conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nimi = $_POST['nimi'];
        $kuvaus = $_POST['kuvaus'];
        $alkupaiva = $_POST['alkupaiva'];
        $loppupaiva = $_POST['loppupaiva'];
        $opettaja = isset($_POST['opettaja']) ? $_POST['opettaja'] : null;
        $tila = isset($_POST['tila']) ? $_POST['tila'] : null;


        $sql = "UPDATE Kurssi SET Nimi='$nimi', Kuvaus='$kuvaus', Alkupaiva='$alkupaiva', Loppupaiva='$loppupaiva', Opettaja='$opettaja', Tila='$tila' WHERE ID='$id'";
        if (mysqli_query($conn, $sql)) {
            header("location:../index.php");
            exit();
        } else {
            echo "Error" . mysqli_error($conn);
        }

    }
?>