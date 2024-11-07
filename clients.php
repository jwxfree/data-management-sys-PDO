<?php
session_start();
include 'core/dbConfig.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

// Fetch all clients
$query = $pdo->query("SELECT * FROM clients");
$clients = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Manage Clients</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to confirm deletion
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this client?");
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

    <h2>CLIENTS</h2>
    <a href="addClient.php">Add New Client</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact Name</th>
            <th>Contact Email</th>
            <th>Contact Phone</th>
            <th>Address</th>
            <th>Industry</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= $client['client_id']; ?></td>
            <td><?= $client['name']; ?></td>
            <td><?= $client['contact_name']; ?></td>
            <td><?= $client['contact_email']; ?></td>
            <td><?= $client['contact_phone']; ?></td>
            <td><?= $client['address']; ?></td>
            <td><?= $client['industry']; ?></td>
            <td>
                <a href="editClient.php?id=<?= $client['client_id']; ?>">Edit</a> |
                <!-- Delete link with confirmation -->
                <a href="delClient.php?id=<?= $client['client_id']; ?>" onclick="return confirmDeletion()">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
