<?php
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

$employeeId = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM Employees WHERE employee_id = ?");
$stmt->execute([$employeeId]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    die("Employee not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $department = $_POST['department'];

    $oldValues = "First Name: {$employee['first_name']}, Last Name: {$employee['last_name']}, Email: {$employee['email']}, 
                  Phone: {$employee['phone']}, Role: {$employee['role']}, Salary: {$employee['salary']}, Department: {$employee['department']}";

    $stmt = $pdo->prepare("UPDATE Employees SET first_name = ?, last_name = ?, email = ?, phone = ?, role = ?, salary = ?, department = ? WHERE employee_id = ?");
    $stmt->execute([$firstName, $lastName, $email, $phone, $role, $salary, $department, $employeeId]);

    logAction($pdo, 'UPDATE', 'employees', $employeeId, "Updated employee details. Previous values: {$oldValues}");

    header('Location: employees.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Employee</h1>
    <form method="POST" action="editEmployee.php?id=<?= htmlspecialchars($employeeId); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($employee['first_name']); ?>" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($employee['last_name']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($employee['email']); ?>" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($employee['phone']); ?>">
        
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" value="<?= htmlspecialchars($employee['role']); ?>">
        
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" value="<?= htmlspecialchars($employee['salary']); ?>" step="0.01">
        
        <label for="department">Department ID:</label>
        <input type="number" id="department" name="department" value="<?= htmlspecialchars($employee['department']); ?>" required>
        
        <button type="submit">Update Employee</button>
        <button type="button" onclick="window.location.href='employees.php'">Back</button>
    </form>
</body>
</html>
