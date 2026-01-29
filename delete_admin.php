<?php
session_start();
require_once 'config.php';

// Protect page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Delete admin by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM admins WHERE id=?");
    $stmt->execute([$id]);

    $_SESSION['success'] = "Admin deleted successfully!";
}

header("Location: admin_details.php");
exit;
