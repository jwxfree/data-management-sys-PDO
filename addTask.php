<?php
include 'core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $name = $_POST['name'];
    $assigned_to = $_POST['assigned_to'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $priority = $_POST['priority'];

    $stmt = $pdo->prepare("INSERT INTO Tasks (project_id, name, assigned_to, status, start_date, end_date, priority) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$project_id, $name, $assigned_to, $status, $start_date, $end_date, $priority]);

    header("Location: tasks.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Add New Task</h2>
    <form method="POST">
        <label>Project ID: <input type="number" name="project_id" required></label><br>
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Assigned To (Employee ID): <input type="number" name="assigned_to"></label><br>
        <label>Status: 
            <select name="status">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </label><br>
        <label>Start Date: <input type="date" name="start_date"></label><br>
        <label>End Date: <input type="date" name="end_date"></label><br>
        <label>Priority: 
            <select name="priority">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </label><br>
        <button type="submit">Add Task</button>
        <button type="button" onclick="history.back()">Back</button>
    </form>
</body>
</html>
