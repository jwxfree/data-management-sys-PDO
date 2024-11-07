<?php
session_start();
include 'core/dbConfig.php'; 

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: clients.php'); 
    exit;
}

$username = $password = "";
$login_error = "";
$registartion_success ="";

if (isset($_SESSION['registration_success'])) {
    echo "<p style='color: green; text-align: center;'>Registration successful! You can now log in.</p>";
    unset($_SESSION['registration_success']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the database for matching user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Store user_id and username in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;

        header("Location: clients.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Solutions Dashboard - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h1>Digital Solutions Company Management</h1>
    </nav>
    
    <h2>Login</h2>
    <form method="POST" action="index.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        
        <button type="submit" style="margin: 0 0 1em 0">Login</button>
        <hr>
        <p style="margin: .5em 0 0 0; text-align:center;">Don’t have an account? <a href="registration.php">Register here</a></p>

        <p style="margin: .5em 0 0 0; text-align:center;">Forgot credentials? Contact IT support</p>
    </form>
    
    <?php if ($login_error): ?>
        <p style="color: red; margin: 1rem 0 0 40rem"><?= htmlspecialchars($login_error); ?></p>
    <?php endif; ?>
    <?php if ($registartion_success): ?>
        <p style="color: red; margin: 1rem 0 0 40rem"><?= htmlspecialchars($registartion_success); ?></p>
    <?php endif; ?>
</body>
</html>
