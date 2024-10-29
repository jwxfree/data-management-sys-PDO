<?php
include 'core/dbConfig.php';

if (isset($_GET['id'])) {
    $log_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM TimeLogs WHERE log_id = ?");
    $stmt->execute([$log_id]);
    $timelog = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $employee_id = $_POST['employee_id'];
        $task_id = $_POST['task_id'];
        $log_date = $_POST['log_date'];
        $hours = $_POST['hours'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("UPDATE TimeLogs SET employee_id = ?, task_id = ?, log_date = ?, hours = ?, description = ? WHERE log_id = ?");
        $stmt->execute([$employee_id, $task_id, $log_date, $hours, $description, $log_id]);

        header("Location: timelogs.php");
        exit;
    }
} else {
    echo "Log ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Time Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Time Log</h2>
    <form method="POST">
        <label>Employee ID: <input type="number" name="employee_id" value="<?= htmlspecialchars($timelog['employee_id']) ?>" required></label><br>
        <label>Task ID: <input type="number" name="task_id" value="<?= htmlspecialchars($timelog['task_id']) ?>" required></label><br>
        <label>Date: <input type="date" name="log_date" value="<?= htmlspecialchars($timelog['log_date']) ?>" required></label><br>
        <label>Hours: <input type="number" step="0.01" name="hours" min="0.01" value="<?= htmlspecialchars($timelog['hours']) ?>" required></label><br>
        <label>Description: <textarea name="description"><?= htmlspecialchars($timelog['description']) ?></textarea></label><br>
        <button type="submit">Update Time Log</button>
        <button type="button" onclick="window.location.href='timelogs.php'">Back</button>

    </form>
</body>
</html>
