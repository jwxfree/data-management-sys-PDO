<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT client_id, name FROM clients WHERE client_id = ?");
$stmt->execute([$id]);
$client = $stmt->fetch();

if ($client) {

    $stmt = $pdo->prepare("DELETE FROM Clients WHERE client_id = ?");
    $stmt->execute([$id]);
    logAction($pdo, 'DELETE', 'clients', $id, "Deleted client: {$client['name']}");
    header("Location: clients.php");
    exit();
} else {
    echo "Client not found.";
}
?>


