<?php
// clients.php
include 'core/dbConfig.php';

// Fetch all clients
$query = $pdo->query("SELECT * FROM clients");
$clients = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Digital Solutions Dashboard - Manage Clients</title>
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
    <h1>CLIENTS</h1>
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
                <a href="delClient.php?id=<?= $client['client_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
