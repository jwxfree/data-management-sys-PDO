<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to the dashboard if already logged in
    header('Location: dashboard.php'); // Adjust this path to your dashboard
    exit;
}

// Initialize variables for login
$username = $password = "";
$login_error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the credentials match
    if ($username === 'admin' && $password === 'admin') {
        // Store session variable and redirect to the dashboard
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username; // You can store more user info if needed
        header('Location: clients.php'); // Adjust this path to your dashboard
        exit;
    } else {
        $login_error = "Invalid username or password.";
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
        <p style="margin: .5em 0 0 0; text-align:center;">Forgot credentials? Contact IT support</p>
    </form>
    
    <?php if ($login_error): ?>
        <p style="color: red;"><?= htmlspecialchars($login_error); ?></p>
    <?php endif; ?>
</body>
</html>
