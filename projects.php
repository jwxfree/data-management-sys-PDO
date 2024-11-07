<?php
session_start();
include 'core/dbConfig.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}


$query = $pdo->query("SELECT * FROM Projects");
$projects = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Manage Projects</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to confirm deletion
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this project?");
        }
    </script>
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
    <h2>PROJECTS</h2>
    <a href="addProject.php">Add New Project</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Client ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Budget</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($projects as $project): ?>
        <tr>
            <td><?= htmlspecialchars($project['project_id']); ?></td>
            <td><?= htmlspecialchars($project['client_id']); ?></td>
            <td><?= htmlspecialchars($project['name']); ?></td>
            <td><?= htmlspecialchars($project['description']); ?></td>
            <td><?= htmlspecialchars($project['status']); ?></td>
            <td><?= htmlspecialchars($project['start_date']); ?></td>
            <td><?= htmlspecialchars($project['end_date']); ?></td>
            <td>$<?= htmlspecialchars($project['budget']); ?></td>
            <td>
                <a href="editProject.php?id=<?= htmlspecialchars($project['project_id']); ?>">Edit</a> |
                <a href="delProject.php?id=<?= htmlspecialchars($project['project_id']); ?>"onclick="return confirmDeletion()">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
