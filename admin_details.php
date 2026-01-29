<?php
session_start();
require_once 'config.php';

// Protect page: only logged-in admins
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Fetch all admin details
$stmt = $pdo->prepare("SELECT id, username, fullname, email, contact, address, created_at FROM admins ORDER BY id ASC");
$stmt->execute();
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Road Alert Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <img src="images/logo.jpeg" alt="Road Hazard Tracker" width="36" height="36" class="rounded">
                <span>Road Alert Tracker</span>
            </a>

            <!-- Collapse button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
                <a href="dashboard.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Dashboard
                </a>
                <a href="admin_details.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Admin Details
                </a>
                <a href="reported_list.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Reports
                </a>
                <button id="darkModeToggle" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    🌙 Dark Mode
                </button>
                <a href="admin_logout.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 d-flex justify-content-between mb-3">
        <h2>Admin Details</h2>
        <a href="add_admin.php" class="btn btn-success">+ Add Admin</a>
    </div>

    <div class="container mt-3">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($admins) > 0): ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= $admin['id'] ?></td>
                            <td><?= htmlspecialchars($admin['username']) ?></td>
                            <td><?= htmlspecialchars($admin['fullname']) ?></td>
                            <td><?= htmlspecialchars($admin['email']) ?></td>
                            <td><?= htmlspecialchars($admin['contact']) ?></td>
                            <td><?= htmlspecialchars($admin['address']) ?></td>
                            <td><?= $admin['created_at'] ?></td>
                            <td>
                                <a href="edit_admin.php?id=<?= $admin['id'] ?>" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="delete_admin.php?id=<?= $admin['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this admin?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No admin records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <p class="text-center mt-3 small">
        Road Alert Tracker © <?= date('Y') ?>
    </p>
    </div>

    <script>
        const toggleBtn = document.getElementById('darkModeToggle');
        const body = document.body;

        // Load saved preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggleBtn.textContent = '☀ Light Mode';
        }

        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                toggleBtn.textContent = '☀ Light Mode';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                toggleBtn.textContent = '🌙 Dark Mode';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>