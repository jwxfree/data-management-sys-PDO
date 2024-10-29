<?php
include 'core/dbConfig.php';

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Tasks WHERE task_id = ?");
    $stmt->execute([$task_id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $project_id = $_POST['project_id'];
        $name = $_POST['name'];
        $assigned_to = $_POST['assigned_to'];
        $status = $_POST['status'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $priority = $_POST['priority'];

        $stmt = $pdo->prepare("UPDATE Tasks SET project_id = ?, name = ?, assigned_to = ?, status = ?, start_date = ?, end_date = ?, priority = ? WHERE task_id = ?");
        $stmt->execute([$project_id, $name, $assigned_to, $status, $start_date, $end_date, $priority, $task_id]);

        header("Location: tasks.php");
        exit;
    }
} else {
    echo "Task ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Task</h2>
    <form method="POST">
        <label>Project ID: <input type="number" name="project_id" value="<?= htmlspecialchars($task['project_id']) ?>" required></label><br>
        <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($task['name']) ?>" required></label><br>
        <label>Assigned To (Employee ID): <input type="number" name="assigned_to" value="<?= htmlspecialchars($task['assigned_to']) ?>"></label><br>
        <label>Status: 
            <select name="status">
                <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </label><br>
        <label>Start Date: <input type="date" name="start_date" value="<?= htmlspecialchars($task['start_date']) ?>"></label><br>
        <label>End Date: <input type="date" name="end_date" value="<?= htmlspecialchars($task['end_date']) ?>"></label><br>
        <label>Priority: 
            <select name="priority">
                <option value="High" <?= $task['priority'] == 'High' ? 'selected' : '' ?>>High</option>
                <option value="Medium" <?= $task['priority'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                <option value="Low" <?= $task['priority'] == 'Low' ? 'selected' : '' ?>>Low</option>
            </select>
        </label><br>
        <button type="submit">Update Task</button>
        <button type="button" onclick="window.location.href='tasks.php'">Back</button>

    </form>
</body>
</html>
