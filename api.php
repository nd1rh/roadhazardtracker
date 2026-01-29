<?php
// api.php
require_once 'config.php';

// Set header so the browser/client knows this is JSON data
header('Content-Type: application/json');

try {
    // Select all records
    $sql = "SELECT * FROM hazards 
            ORDER BY report_date DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch data as an associative array
    $hazards = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the array as JSON
    echo json_encode($hazards, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    // If there is an error, output a JSON error message
    echo json_encode(['error' => $e->getMessage()]);
}
?>