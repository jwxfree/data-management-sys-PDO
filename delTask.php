<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT task_id, task_name FROM Tasks WHERE task_id = ?");
    $stmt->execute([$task_id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        $stmt = $pdo->prepare("DELETE FROM Tasks WHERE task_id = ?");
        $stmt->execute([$task_id]);

        logAction($pdo, 'DELETE', 'tasks', $task_id, "Deleted task: {$task['task_name']}");

        header("Location: tasks.php");
        exit;
    } else {
        echo "Task not found!";
        exit;
    }
} else {
    echo "Task ID not provided!";
    exit;
}
?>
