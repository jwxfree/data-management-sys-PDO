<?php
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $invoice_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Invoices WHERE invoice_id = ?");
    $stmt->execute([$invoice_id]);
    $invoice = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $project_id = $_POST['project_id'];
        $amount = $_POST['amount'];
        $issued_date = $_POST['issued_date'];
        $due_date = $_POST['due_date'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("UPDATE Invoices SET project_id = ?, amount = ?, issued_date = ?, due_date = ?, status = ? WHERE invoice_id = ?");
        $stmt->execute([$project_id, $amount, $issued_date, $due_date, $status, $invoice_id]);
        logAction($pdo, 'UPDATE', 'invoices', $invoice_id, 'Updated invoice record');

        header("Location: invoices.php");
        exit;
    }
} else {
    echo "Invoice ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Invoice</h2>
    <form method="POST">
        <label>Project ID: <input type="number" name="project_id" value="<?= htmlspecialchars($invoice['project_id']) ?>" required></label><br>
        <label>Amount: <input type="number" step="0.01" name="amount" value="<?= htmlspecialchars($invoice['amount']) ?>" required></label><br>
        <label>Issued Date: <input type="date" name="issued_date" value="<?= htmlspecialchars($invoice['issued_date']) ?>" required></label><br>
        <label>Due Date: <input type="date" name="due_date" value="<?= htmlspecialchars($invoice['due_date']) ?>"></label><br>
        <label>Status: 
            <select name="status" required>
                <option value="Paid" <?= $invoice['status'] == 'Paid' ? 'selected' : '' ?>>Paid</option>
                <option value="Unpaid" <?= $invoice['status'] == 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
                <option value="Overdue" <?= $invoice['status'] == 'Overdue' ? 'selected' : '' ?>>Overdue</option>
            </select>
        </label><br>
        <button type="submit">Update Invoice</button>
        <button type="button" onclick="window.location.href='invoices.php'">Back</button>
    </form>
</body>
</html>
