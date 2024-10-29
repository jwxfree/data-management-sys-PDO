<?php
include 'core/dbConfig.php';

$employeeId = $_GET['id'];

// Fetch employee data for the specified ID
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

    // Update employee in the database
    $stmt = $pdo->prepare("UPDATE Employees SET first_name = ?, last_name = ?, email = ?, phone = ?, role = ?, salary = ?, department = ? WHERE employee_id = ?");
    $stmt->execute([$firstName, $lastName, $email, $phone, $role, $salary, $department, $employeeId]);

    header('Location: employees.php'); // Redirect to the employees page after successful update
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
    <form method="POST" action="edit_employee.php?id=<?= htmlspecialchars($employeeId); ?>">
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
