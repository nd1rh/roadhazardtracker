<?php
require_once 'config.php';

// --- Logic 1: Handle Form Submission ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hazard'])) {
    if (!empty($_POST['location_name']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {
        $stmt = $pdo->prepare("INSERT INTO hazards (location_name, latitude, longitude, hazard_type, reporter_name, report_date) VALUES (?, ?, ?, ?, ?, ?)");

        $current_iso_date = date('Y-m-d H:i:s');

        $hazardType = $_POST['hazard_type'];

        if ($hazardType === 'other' && !empty($_POST['other_hazard_type'])) {
            $hazardType = $_POST['other_hazard_type'];
        }

        $stmt->execute([
            $_POST['location_name'],
            $_POST['latitude'],
            $_POST['longitude'],
            $hazardType,
            $_POST['reporter_name'],
            $current_iso_date
        ]);

        // Refresh page to prevent duplicate submissions
        header("Location: index.php");
        exit;
    }
}

// --- Logic 2: Fetch Data for Table ---
// We fetch ALL data for the HTML view
$stmt = $pdo->query("SELECT * FROM hazards ORDER BY report_date DESC");
$all_hazards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Road Hazard Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">Road Hazard Reporting System</h2>

        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-secondary text-white">Report Hazard</div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Location Name</label>
                            <input type="text" class="form-control" name="location_name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Latitude</label>
                            <input type="number" step="any" class="form-control" name="latitude"
                                placeholder="e.g. 3.1415 (refer Google Maps)" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Longitude</label>
                            <input type="number" step="any" class="form-control" name="longitude"
                                placeholder="e.g. 101.6869 (refer Google Maps)" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Hazard Type</label>
                            <select class="form-select" name="hazard_type" id="hazard_type" required>
                                <option value="">Select Hazard</option>
                                <option value="Landslide">Landslide</option>
                                <option value="Flood">Flood</option>
                                <option value="Road Closure">Road Closure</option>
                                <option value="Potholes">Potholes</option>
                                <option value="Accidents">Accidents</option>
                                <option value="Road Construction">Road Construction</option>
                                <option value="Fallen Trees">Fallen Trees</option>
                                <option value="Uneven Road Surfaces">Uneven Road Surfaces</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3" id="otherHazardDiv" style="display:none;">
                            <label class="form-label">Specify Hazard Type</label>
                            <input type="text" class="form-control" name="other_hazard_type">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Reporter Name</label>
                            <input type="text" class="form-control" name="reporter_name" required>
                        </div>
                    </div>
                    <button type="submit" name="submit_hazard" class="btn btn-success">Submit Report</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Current Database</span>
                <a href="api.php" target="_blank" class="btn btn-sm btn-outline-secondary">View JSON API</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date (ISO)</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Coordinates</th>
                            <th>Reporter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_hazards as $row): ?>
                            <tr>
                                <td>
                                    <?= date('c', strtotime($row['report_date'])) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['location_name']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['hazard_type']) ?>
                                </td>
                                <td>
                                    <?= $row['latitude'] ?>,
                                    <?= $row['longitude'] ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['reporter_name']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('hazard_type').addEventListener('change', function() {
            const otherDiv = document.getElementById('otherHazardDiv');
            otherDiv.style.display = this.value === 'other' ? 'block' : 'none';
        });
    </script>

</body>

</html>