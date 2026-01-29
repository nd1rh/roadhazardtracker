<?php
session_start();
require_once 'config.php';

// Only allow access to logged-in admins
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Check if report ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $reportId = $_GET['id'];

    // Prepare and execute delete query
    $stmt = $pdo->prepare("DELETE FROM hazards WHERE id = ?");
    $stmt->execute([$reportId]);

    $_SESSION['success'] = "Report deleted successfully!";
} else {
    $_SESSION['error'] = "Invalid report ID!";
}

// Redirect back to reported list page
header("Location: reported_list.php");
exit;
