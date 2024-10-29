<?php
// add_client.php
include 'core/dbConfig.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $address = $_POST['address'];
    $industry = $_POST['industry'];

    $stmt = $pdo->prepare("INSERT INTO Clients (name, contact_name, contact_email, contact_phone, address, industry) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $contact_name, $contact_email, $contact_phone, $address, $industry]);

    header("Location: clients.php");
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
