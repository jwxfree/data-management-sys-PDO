<?php
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

$clientId = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM Clients WHERE client_id = ?");
$stmt->execute([$clientId]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    die("Client not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contactName = $_POST['contact_name'];
    $contactEmail = $_POST['contact_email'];
    $contactPhone = $_POST['contact_phone'];
    $address = $_POST['address'];
    $industry = $_POST['industry'];

    $oldValues = "Name: {$client['name']}, Contact Name: {$client['contact_name']}, Contact Email: {$client['contact_email']}, 
                  Contact Phone: {$client['contact_phone']}, Address: {$client['address']}, Industry: {$client['industry']}";

    $stmt = $pdo->prepare("UPDATE Clients SET name = ?, contact_name = ?, contact_email = ?, contact_phone = ?, address = ?, industry = ? WHERE client_id = ?");
    $stmt->execute([$name, $contactName, $contactEmail, $contactPhone, $address, $industry, $clientId]);

    logAction($pdo, 'UPDATE', 'Clients', $clientId, "Updated client details. Previous values: {$oldValues}");

    header('Location: clients.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Client</h1>
    <form method="POST" action="editClient.php?id=<?= htmlspecialchars($clientId); ?>">
        <label for="name">Client Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($client['name']); ?>" required>
        
        <label for="contact_name">Contact Name:</label>
        <input type="text" id="contact_name" name="contact_name" value="<?= htmlspecialchars($client['contact_name']); ?>">
        
        <label for="contact_email">Contact Email:</label>
        <input type="text" id="contact_email" name="contact_email" value="<?= htmlspecialchars($client['contact_email']); ?>" required>
        
        <label for="contact_phone">Contact Phone:</label>
        <input type="text" id="contact_phone" name="contact_phone" value="<?= htmlspecialchars($client['contact_phone']); ?>">
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($client['address']); ?>">
        
        <label for="industry">Industry:</label>
        <input type="text" id="industry" name="industry" value="<?= htmlspecialchars($client['industry']); ?>">
        
        <button type="submit">Update Client</button>
        <button type="button" onclick="window.location.href='clients.php'">Back</button>
    </form>
</body>
</html>
