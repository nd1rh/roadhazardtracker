<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hazard'])) {

    if (
        !empty($_POST['location_name']) &&
        !empty($_POST['latitude']) &&
        !empty($_POST['longitude']) &&
        !empty($_POST['hazard_type']) &&
        !empty($_POST['reporter_name'])
    ) {

        $hazardType = $_POST['hazard_type'];
        if ($hazardType === 'other' && !empty($_POST['other_hazard_type'])) {
            $hazardType = $_POST['other_hazard_type'];
        }

        $stmt = $pdo->prepare("
            INSERT INTO hazards
            (location_name, latitude, longitude, hazard_type, reporter_name, report_date)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $_POST['location_name'],
            $_POST['latitude'],
            $_POST['longitude'],
            $hazardType,
            $_POST['reporter_name'],
            date('Y-m-d H:i:s')
        ]);

        // Success message
        $_SESSION['success'] = "Hazard report submitted successfully.";
    } else {
        // Error message
        $_SESSION['error'] = "Please fill in all required fields.";
    }
}

header("Location: index.php");
exit;
