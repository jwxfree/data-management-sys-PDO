<?php
include 'core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $amount = $_POST['amount'];
    $issued_date = $_POST['issued_date'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO Invoices (project_id, amount, issued_date, due_date, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$project_id, $amount, $issued_date, $due_date, $status]);

    header("Location: invoices.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Invoice</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Add New Invoice</h2>
    <form method="POST">
        <label>Project ID: <input type="number" name="project_id" required></label><br>
        <label>Amount: <input type="number" step="0.01" name="amount" required></label><br>
        <label>Issued Date: <input type="date" name="issued_date" required></label><br>
        <label>Due Date: <input type="date" name="due_date"></label><br>
        <label>Status: 
            <select name="status" required>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
                <option value="Overdue">Overdue</option>
            </select>
        </label><br>
        <button type="submit">Add Invoice</button>
        <button type="button" onclick="history.back()">Back</button>
    </form>
</body>
</html>
