<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $budget = $_POST['budget'];

    $stmt = $pdo->prepare("INSERT INTO Projects (client_id, name, description, status, start_date, end_date, budget) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$client_id, $name, $description, $status, $start_date, $end_date, $budget]);
    $recordId = $pdo->lastInsertId();
    logAction($pdo, 'INSERT', 'projects', $recordId, 'Added a new project');

    header("Location: projects.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Add New Project</h2>
    <form method="POST">
        <label>Client ID: <input type="number" name="client_id" required></label><br>
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        <label>Status: 
            <select name="status">
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
            </select>
        </label><br>
        <label>Start Date: <input type="date" name="start_date"></label><br>
        <label>End Date: <input type="date" name="end_date"></label><br>
        <label>Budget: <input type="number" name="budget" step="0.01"></label><br>
        <button type="submit">Add Project</button>
        <button type="button" onclick="history.back()">Back</button>
    </form>
</body>
</html>
