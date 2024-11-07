<?php
session_start();
include 'core/dbConfig.php';
include 'logAction.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $invoice_id = $_GET['id'];


    $stmt = $pdo->prepare("SELECT invoice_id FROM Invoices WHERE invoice_id = ?");
    $stmt->execute([$invoice_id]);
    $invoice = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($invoice) {
       
        $stmt = $pdo->prepare("DELETE FROM Invoices WHERE invoice_id = ?");
        $stmt->execute([$invoice_id]);

        logAction($pdo, 'DELETE', 'invoices', $invoice_id, "Deleted invoice with ID {$invoice_id}");

     
        header("Location: invoices.php");
        exit;
    } else {
        echo "Invoice not found!";
        exit;
    }
} else {
    echo "Invoice ID not provided!";
    exit;
}
?>
