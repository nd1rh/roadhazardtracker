<?php
session_start();

// If already logged in, redirect to admin dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}
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
                <button id="darkModeToggle" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    🌙 Dark Mode
                </button>
            </div>
        </div>
    </nav>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-4">

                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="text-center mb-4">Admin Login</h4>

                                <?php if (isset($_SESSION['login_error'])): ?>
                                    <div class="alert alert-danger">
                                        <?= $_SESSION['login_error']; ?>
                                    </div>
                                    <?php unset($_SESSION['login_error']); ?>
                                <?php endif; ?>

                                <form action="admin_auth.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>

                        <p class="text-center mt-3 small">
                            Road Alert Tracker © <?= date('Y') ?>
                        </p>

                    </div>
                </div>
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