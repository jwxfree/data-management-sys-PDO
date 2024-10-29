<?php
include 'core/dbConfig.php';

// Fetch all time logs
$query = $pdo->query("SELECT * FROM TimeLogs");
$timelogs = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Manage Time Logs</title>
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
             <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h2>TIME LOGS</h2>
    <a href="addTimelog.php">Add New Time Log</a>
    <table border="1">
        <tr>
            <th>Log ID</th>
            <th>Employee ID</th>
            <th>Task ID</th>
            <th>Date</th>
            <th>Hours</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($timelogs as $timelog): ?>
        <tr>
            <td><?= htmlspecialchars($timelog['log_id']); ?></td>
            <td><?= htmlspecialchars($timelog['employee_id']); ?></td>
            <td><?= htmlspecialchars($timelog['task_id']); ?></td>
            <td><?= htmlspecialchars($timelog['log_date']); ?></td>
            <td><?= htmlspecialchars($timelog['hours']); ?></td>
            <td><?= htmlspecialchars($timelog['description']); ?></td>
            <td>
                <a href="editTimelog.php?id=<?= htmlspecialchars($timelog['log_id']); ?>">Edit</a> |
                <a href="delTimelog.php?id=<?= htmlspecialchars($timelog['log_id']); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
