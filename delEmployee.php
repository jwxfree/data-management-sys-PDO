<?php
include 'core/dbConfig.php';

$employeeId = $_GET['id'];

// Delete employee from the database
$stmt = $pdo->prepare("DELETE FROM Employees WHERE employee_id = ?");
$stmt->execute([$employeeId]);

header('Location: employees.php'); // Redirect to the employees page after deletion
exit();
