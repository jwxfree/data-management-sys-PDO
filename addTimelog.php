<?php
include 'core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $task_id = $_POST['task_id'];
    $log_date = $_POST['log_date'];
    $hours = $_POST['hours'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO TimeLogs (employee_id, task_id, log_date, hours, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$employee_id, $task_id, $log_date, $hours, $description]);

    header("Location: timelogs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Time Log</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Add New Time Log</h2>
    <form method="POST">
        <label>Employee ID: <input type="number" name="employee_id" required></label><br>
        <label>Task ID: <input type="number" name="task_id" required></label><br>
        <label>Date: <input type="date" name="log_date" required></label><br>
        <label>Hours: <input type="number" step="0.01" name="hours" min="0.01" required></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        <button type="submit">Add Time Log</button>
        <button type="button" onclick="history.back()">Back</button>
    </form>
</body>
</html>
