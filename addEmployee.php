<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $department = $_POST['department'];

    $stmt = $pdo->prepare("INSERT INTO Employees (first_name, last_name, email, phone, role, salary, department) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $phone, $role, $salary, $department]);
    $recordId = $pdo->lastInsertId();
    logAction($pdo, 'INSERT', 'employees', $recordId, 'Added a new employee record');
    header('Location: employees.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Employee</h1>
    <form method="POST" action="addEmployee.php">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">
        
        <label for="role">Role:</label>
        <input type="text" id="role" name="role">
        
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" step="0.01">
        
        <label for="department">Department ID:</label>
        <input type="number" id="department" name="department" required>
        
        <button type="submit">Add Employee</button>
        <button type="button" onclick="window.location.href='employees.php'">Back</button>
    </form>
</body>
</html>
