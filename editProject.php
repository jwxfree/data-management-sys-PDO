<?php
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Projects WHERE project_id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $client_id = $_POST['client_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $budget = $_POST['budget'];

        $stmt = $pdo->prepare("UPDATE Projects SET client_id = ?, name = ?, description = ?, status = ?, start_date = ?, end_date = ?, budget = ? WHERE project_id = ?");
        $stmt->execute([$client_id, $name, $description, $status, $start_date, $end_date, $budget, $project_id]);
        logAction($pdo, 'UPDATE', 'projects', $project_id, 'Updated project details');

        header("Location: projects.php");
        exit;
    }
} else {
    echo "Project ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Project</h2>
    <form method="POST">
        <label>Client ID: <input type="number" name="client_id" value="<?= htmlspecialchars($project['client_id']) ?>" required></label><br>
        <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($project['name']) ?>" required></label><br>
        <label>Description: <textarea name="description"><?= htmlspecialchars($project['description']) ?></textarea></label><br>
        <label>Status: 
            <select name="status">
                <option value="In Progress" <?= $project['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $project['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                <option value="Pending" <?= $project['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </label><br>
        <label>Start Date: <input type="date" name="start_date" value="<?= htmlspecialchars($project['start_date']) ?>"></label><br>
        <label>End Date: <input type="date" name="end_date" value="<?= htmlspecialchars($project['end_date']) ?>"></label><br>
        <label>Budget: <input type="number" name="budget" step="0.01" value="<?= htmlspecialchars($project['budget']) ?>"></label><br>
        <button type="submit">Update Project</button>
        <button type="button" onclick="window.location.href='projects.php'">Back</button>
    </form>
</body>
</html>
