<?php
include 'core/dbConfig.php';

// Fetch all invoices
$query = $pdo->query("SELECT * FROM Invoices");
$invoices = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Manage Invoices</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <nav>
        <h1 style="color: #ffff;">Digital Solutions Company Management</h1>
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
    <h2>INVOICES</h2>
    <a href="addInvoice.php">Add New Invoice</a>
    <table border="1">
        <tr>
            <th>Invoice ID</th>
            <th>Project ID</th>
            <th>Amount</th>
            <th>Issued Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($invoices as $invoice): ?>
        <tr>
            <td><?= htmlspecialchars($invoice['invoice_id']); ?></td>
            <td><?= htmlspecialchars($invoice['project_id']); ?></td>
            <td><?= htmlspecialchars($invoice['amount']); ?></td>
            <td><?= htmlspecialchars($invoice['issued_date']); ?></td>
            <td><?= htmlspecialchars($invoice['due_date']); ?></td>
            <td><?= htmlspecialchars($invoice['status']); ?></td>
            <td>
                <a href="editInvoice.php?id=<?= htmlspecialchars($invoice['invoice_id']); ?>">Edit</a> |
                <a href="delInvoice.php?id=<?= htmlspecialchars($invoice['invoice_id']); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
