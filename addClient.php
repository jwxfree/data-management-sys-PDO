<?php
include 'core/dbConfig.php';
include 'logAction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from form submission
    $name = $_POST['name'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $address = $_POST['address'];
    $industry = $_POST['industry'];

    // Step 1: Insert the new client into the database
    $stmt = $pdo->prepare("INSERT INTO clients (name, contact_name, contact_email, contact_phone, address, industry) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $contact_name, $contact_email, $contact_phone, $address, $industry]);

    // Step 2: Get the last inserted ID
    $recordId = $pdo->lastInsertId();

    // Step 3: Fetch the client name for the log
    $stmt = $pdo->prepare("SELECT name FROM clients WHERE client_id = ?");
    $stmt->execute([$recordId]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    // Step 4: Log the action if client data was successfully fetched
    if ($client) {
        logAction($pdo, 'INSERT', 'clients', $recordId, "Added a new client: {$client['name']}");
    }

    // Step 5: Redirect to the clients page
    header("Location: clients.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Client</h1>
    <form method="POST">
        <label for="name">Company Name:</label><br>
        <input type="text" name="name" required><br>
        <label for="contact_name">Contact Name:</label><br>
        <input type="text" name="contact_name"><br>
        <label for="contact_email">Contact Email:</label><br>
        <input type="text" name="contact_email"><br>
        <label for="contact_phone">Contact Phone:</label><br>
        <input type="text" name="contact_phone"><br>
        <label for="address">Address:</label><br>
        <input type="text" name="address"><br>
        <label for="industry">Industry:</label><br>
        <input type="text" name="industry"><br><br>
        <button type="submit">Add Client</button>
        <button type="button" onclick="history.back()">Back</button>
    </form>
</body>
</html>
