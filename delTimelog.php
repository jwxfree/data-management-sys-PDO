<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $log_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT log_id, description FROM TimeLogs WHERE log_id = ?");
    $stmt->execute([$log_id]);
    $time_log = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($time_log) {
        $stmt = $pdo->prepare("DELETE FROM TimeLogs WHERE log_id = ?");
        $stmt->execute([$log_id]);

        logAction($pdo, 'DELETE', 'timelogs', $log_id, "Deleted time log: {$time_log['description']}");

        header("Location: timelogs.php");
        exit;
    } else {
        echo "Time log not found!";
        exit;
    }
} else {
    echo "Log ID not provided!";
    exit;
}
?>
