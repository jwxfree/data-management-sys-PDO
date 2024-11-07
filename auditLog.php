<?php
session_start();
include 'core/dbConfig.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

// Set up pagination variables
$logsPerPage = 10; // Number of logs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page (default is page 1)

// Calculate the starting index for the query
$startFrom = ($page - 1) * $logsPerPage;

// Prepare the query to get logs with LIMIT for pagination
$stmt = $pdo->prepare("SELECT * FROM audit_log ORDER BY last_update DESC LIMIT ?, ?");
$stmt->bindParam(1, $startFrom, PDO::PARAM_INT);
$stmt->bindParam(2, $logsPerPage, PDO::PARAM_INT);
$stmt->execute();
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of logs for pagination
$stmtTotal = $pdo->query("SELECT COUNT(*) FROM audit_log");
$totalLogs = $stmtTotal->fetchColumn();

// Calculate total pages
$totalPages = ceil($totalLogs / $logsPerPage);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Audit Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h1>Digital Solutions Company Management</h1>
        <ul>
            <li><a href="clients.php">Manage Clients</a></li>
            <li><a href="employees.php">Manage Employees</a></li>
            <li><a href="projects.php">Manage Projects</a></li>
            <li><a href="tasks.php">Manage Tasks</a></li>
            <li><a href="timelogs.php">Manage Time Logs</a></li>
            <li><a href="invoices.php">Manage Invoices</a></li>
            <li><a href="auditLog.php">View Audit Log</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h1>Audit Log</h1>
    <table border="1">
        <tr>
            <th>Action Type</th>
            <th>Table Name</th>
            <th>Record ID</th>
            <th>Added By</th>
            <th>Last Update</th>
            <th>Details</th>
        </tr>
        <?php if ($logs): ?>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= htmlspecialchars($log['action_type']) ?></td>
                <td><?= htmlspecialchars($log['table_name']) ?></td>
                <td><?= htmlspecialchars($log['record_id']) ?></td>
                <td><?= htmlspecialchars($log['added_by']) ?></td>
                <td><?= htmlspecialchars($log['last_update']) ?></td>
                <td><?= htmlspecialchars($log['details']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No log entries found.</td></tr>
        <?php endif; ?>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="auditLog.php?page=1">First</a>
            <a href="auditLog.php?page=<?= $page - 1 ?>">Previous</a>
        <?php endif; ?>

        <?php if ($page < $totalPages): ?>
            <a href="auditLog.php?page=<?= $totalPages ?>">Last</a>
            <a href="auditLog.php?page=<?= $page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>

</body>
</html>
