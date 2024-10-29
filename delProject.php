<?php
include 'core/dbConfig.php';

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM Projects WHERE project_id = ?");
    $stmt->execute([$project_id]);

    header("Location: projects.php");
    exit;
} else {
    echo "Project ID not provided!";
    exit;
}
?>
