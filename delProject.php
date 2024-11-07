<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT project_id, project_name FROM Projects WHERE project_id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($project) {
        $stmt = $pdo->prepare("DELETE FROM Projects WHERE project_id = ?");
        $stmt->execute([$project_id]);

        logAction($pdo, 'DELETE', 'projects', $project_id, "Deleted project: {$project['project_name']}");

        header("Location: projects.php");
        exit;
    } else {
        echo "Project not found!";
        exit;
    }
} else {
    echo "Project ID not provided!";
    exit;
}
?>
