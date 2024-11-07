<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

$employeeId = $_GET['id'];
$stmt = $pdo->prepare("SELECT first_name, last_name FROM Employees WHERE employee_id = ?");
$stmt->execute([$employeeId]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if ($employee) {

    $stmt = $pdo->prepare("DELETE FROM Employees WHERE employee_id = ?");
    $stmt->execute([$employeeId]);


    logAction($pdo, 'DELETE', 'employees', $employeeId, "Deleted employee: {$employee['first_name']} {$employee['last_name']}");
    header('Location: employees.php');
    exit();
} else {
    echo "Employee not found.";
}
?>
