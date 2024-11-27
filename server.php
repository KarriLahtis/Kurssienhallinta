<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);
include 'conn.php';

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'fetch_kurssi':
        fetch_kurssi($conn);
        break;
    case 'fetch_opettaja':
        fetch_opettaja($conn);
        break;
    case 'fetch_opiskelija':
        fetch_opiskelija($conn);
        break;
    case 'fetch_tila':
        fetch_tila($conn);
        break;
}

function fetch_kurssi($conn) {
    $draw = intval($_POST['draw']);
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);

    $totalQuery = "SELECT COUNT(*) as total FROM Kurssi";
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalCount = mysqli_fetch_assoc($totalResult)['total'];

    $dataQuery = "
        SELECT 
            K.ID, 
            K.Nimi, 
            K.Kuvaus, 
            K.Alkupaiva, 
            K.Loppupaiva, 
            CONCAT(O.Etunimi, ' ', O.Sukunimi) AS Opettaja, 
            T.Nimi AS Tila,
            T.Kapasiteetti,
            COUNT(KK.Opiskelija) AS Osallistujat
        FROM 
            Kurssi K
        JOIN 
            Opettaja O ON K.Opettaja = O.ID
        JOIN 
            Tila T ON K.Tila = T.ID
        LEFT JOIN 
            Kurssikirjautuminen KK ON K.ID = KK.Kurssi
        GROUP BY 
            K.ID, T.Kapasiteetti
        LIMIT $start, $length
    ";

    $dataResult = mysqli_query($conn, $dataQuery);

    $data = [];
    while ($row = mysqli_fetch_assoc($dataResult)) {
        $isFull = $row['Osallistujat'] >= $row['Kapasiteetti'] ? 'warning' : '';

        $data[] = [
            'ID' => $row['ID'],
            'Nimi' => $row['Nimi'],
            'Kuvaus' => $row['Kuvaus'],
            'Alkupaiva' => $row['Alkupaiva'],
            'Loppupaiva' => $row['Loppupaiva'],
            'Opettaja' => $row['Opettaja'],
            'Tila' => $row['Tila'],
            'Kapasiteetti' => $row['Kapasiteetti'],
            'Osallistujat' => $row['Osallistujat'],
            'Warning' => $isFull
        ];
    }

    $response = [
        "draw" => $draw,
        "recordsTotal" => $totalCount,
        "recordsFiltered" => $totalCount,
        "data" => $data
    ];

    echo json_encode($response);
}

function fetch_opettaja($conn) {
    $draw = intval($_POST['draw']);
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);

    $totalQuery = "SELECT COUNT(*) as total FROM Opettaja";
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalCount = mysqli_fetch_assoc($totalResult)['total'];

    $dataQuery = "SELECT ID, Etunimi, Sukunimi, Aine FROM Opettaja LIMIT $start, $length";
    $dataResult = mysqli_query($conn, $dataQuery);

    $data = [];
    while ($row = mysqli_fetch_assoc($dataResult)) {
        $data[] = $row;
    }

    $response = [
        "draw" => $draw,
        "recordsTotal" => $totalCount,
        "recordsFiltered" => $totalCount,
        "data" => $data
    ];

    echo json_encode($response);
}

function fetch_opiskelija($conn) {
    $draw = intval($_POST['draw']);
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);

    $totalQuery = "SELECT COUNT(*) as total FROM Opiskelija";
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalCount = mysqli_fetch_assoc($totalResult)['total'];

    $dataQuery = "SELECT ID, Etunimi, Sukunimi, Syntymapaiva, Vuosikurssi FROM Opiskelija LIMIT $start, $length";
    $dataResult = mysqli_query($conn, $dataQuery);

    $data = [];
    while ($row = mysqli_fetch_assoc($dataResult)) {
        $data[] = $row;
    }

    $response = [
        "draw" => $draw,
        "recordsTotal" => $totalCount,
        "recordsFiltered" => $totalCount,
        "data" => $data
    ];

    echo json_encode($response);
}

function fetch_tila($conn) {
    $draw = intval($_POST['draw']);
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);

    $totalQuery = "SELECT COUNT(*) as total FROM Tila";
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalCount = mysqli_fetch_assoc($totalResult)['total'];

    $dataQuery = "
        SELECT 
            Tila.ID, 
            Tila.Nimi, 
            Tila.Kapasiteetti, 
            GROUP_CONCAT(Kurssi.Nimi SEPARATOR ', ') AS Kurssit
        FROM 
            Tila
        LEFT JOIN 
            Kurssi ON Kurssi.Tila = Tila.ID
        GROUP BY 
            Tila.ID
        LIMIT $start, $length
    ";
    
    $dataResult = mysqli_query($conn, $dataQuery);

    $data = [];
    while ($row = mysqli_fetch_assoc($dataResult)) {
        $data[] = $row;
    }

    $response = [
        "draw" => $draw,
        "recordsTotal" => $totalCount,
        "recordsFiltered" => $totalCount,
        "data" => $data
    ];

    echo json_encode($response);
}


?>
