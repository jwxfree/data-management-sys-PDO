<?php
include 'core/dbConfig.php';

if (isset($_GET['id'])) {
    $invoice_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM Invoices WHERE invoice_id = ?");
    $stmt->execute([$invoice_id]);

    header("Location: invoices.php");
    exit;
} else {
    echo "Invoice ID not provided!";
    exit;
}
?>
