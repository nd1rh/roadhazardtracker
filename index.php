<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Road Hazard Tracker</title>
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
                <button id="darkModeToggle" class="btn btn-sm btn-outline-light mt-2 mt-lg-0">
                    🌙 Dark Mode
                </button>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-1">Road Hazard Reporting System</h2>
        <p class="mb-4">
            Report road hazards in real-time to improve public safety
        </p>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php include 'hazard_form.php'; ?>
        <?php include 'hazard_table.php'; ?>

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

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.remove('show');
            });
        }, 4000);
    </script>

</body>

</html>