<?php
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $table = $_POST['table'] ?? '';
    $id = $_POST['id'] ?? 0;

    $allowedTables = ['Kurssi', 'Opettaja', 'Opiskelija', 'Tila'];
    if (!in_array($table, $allowedTables) || !is_numeric($id)) {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
        exit;
    }

    $query = "DELETE FROM $table WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Deletion failed.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>
