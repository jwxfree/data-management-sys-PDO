<?php
include 'core/dbConfig.php';

if (isset($_GET['id'])) {
    $log_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM TimeLogs WHERE log_id = ?");
    $stmt->execute([$log_id]);

    header("Location: timelogs.php");
    exit;
} else {
    echo "Log ID not provided!";
    exit;
}
?>
