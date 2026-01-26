<?php
$stmt = $pdo->query("SELECT * FROM hazards ORDER BY report_date DESC");
$all_hazards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card shadow-lg">

    <!-- Card Header -->
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <span>Reported Road Hazards</span>
        <a href="api.php" target="_blank" class="btn btn-sm btn-outline-light">
            View JSON API
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 420px; overflow-y: auto;">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Hazard Type</th>
                        <th>Coordinates</th>
                        <th>Reporter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($all_hazards) > 0): ?>
                        <?php foreach ($all_hazards as $row): ?>
                            <tr>
                                <td class="small">
                                    <?= date('Y-m-d H:i', strtotime($row['report_date'])) ?>
                                </td>
                                <td class="fw-semibold">
                                    <?= htmlspecialchars($row['location_name']) ?>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?= htmlspecialchars($row['hazard_type']) ?>
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    <?= $row['latitude'] ?>,<br><?= $row['longitude'] ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['reporter_name']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                🚫 No hazard reports yet
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>