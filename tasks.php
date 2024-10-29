<?php
include 'core/dbConfig.php';

// Fetch all tasks
$query = $pdo->query("SELECT * FROM Tasks");
$tasks = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Manage Tasks</title>
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
    <h2>TASKS</h2>
    <a href="addTask.php">Add New Task</a>
    <table border="1">
        <tr>
            <th>Task ID</th>
            <th>Project ID</th>
            <th>Name</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Priority</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['task_id']); ?></td>
            <td><?= htmlspecialchars($task['project_id']); ?></td>
            <td><?= htmlspecialchars($task['name']); ?></td>
            <td><?= htmlspecialchars($task['assigned_to']); ?></td>
            <td><?= htmlspecialchars($task['status']); ?></td>
            <td><?= htmlspecialchars($task['start_date']); ?></td>
            <td><?= htmlspecialchars($task['end_date']); ?></td>
            <td><?= htmlspecialchars($task['priority']); ?></td>
            <td>
                <a href="editTask.php?id=<?= htmlspecialchars($task['task_id']); ?>">Edit</a> |
                <a href="delTask.php?id=<?= htmlspecialchars($task['task_id']); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
