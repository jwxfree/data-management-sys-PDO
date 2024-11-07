<?php
session_start();
include 'core/dbConfig.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

// Fetch all employees
$query = $pdo->query("SELECT * FROM employees");
$employees = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Manage Employees</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to confirm deletion
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this employee?");
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
    <h2>EMPLOYEES</h2>
    <a href="addEmployee.php">Add New Employee</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= htmlspecialchars($employee['employee_id']); ?></td>
            <td><?= htmlspecialchars($employee['first_name']); ?></td>
            <td><?= htmlspecialchars($employee['last_name']); ?></td>
            <td><?= htmlspecialchars($employee['email']); ?></td>
            <td><?= htmlspecialchars($employee['phone']); ?></td>
            <td><?= htmlspecialchars($employee['role']); ?></td>
            <td><?= htmlspecialchars($employee['salary']); ?></td>
            <td><?= htmlspecialchars($employee['department']); ?></td>
            <td>
                <a href="editEmployee.php?id=<?= htmlspecialchars($employee['employee_id']); ?>">Edit</a> |
                <a href="delEmployee.php?id=<?= htmlspecialchars($employee['employee_id']); ?>"onclick="return confirmDeletion()">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
