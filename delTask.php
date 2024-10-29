<?php
include 'core/dbConfig.php';

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM Tasks WHERE task_id = ?");
    $stmt->execute([$task_id]);

    header("Location: tasks.php");
    exit;
} else {
    echo "Task ID not provided!";
    exit;
}
?>
