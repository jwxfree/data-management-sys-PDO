<?php
include 'core/dbConfig.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM Clients WHERE client_id = ?");
$stmt->execute([$id]);

header("Location: clients.php");
?>
