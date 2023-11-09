<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        // User is logged in
        echo "Welcome, " . $_SESSION['username'] . "!<br>";
        if ($_SESSION['role'] === 'admin') {
            echo "You have admin privileges.<br>";
            echo "<a href='wallet.php'>Access Wallet</a><br>";
        } else {
            echo "You have limited access.<br>";
        }
        echo "<a href='logout.php'>Logout</a>";
    } else {
        // User is not logged in
        echo "Welcome, guest!<br>";
        echo "<a href='login.php'>Login</a><br>";
        echo "<a href='register.php'>Register</a>";
    }
    ?>
</body>
</html>
<?php
// Perform user registration or login logic here

// If registration/login is successful, set a session variable
if ($registration_success) {
    session_start();
    $_SESSION['user_authenticated'] = true;

    // Redirect to the user dashboard
    header("Location: index.html");
    exit();
} else {
    // Handle registration/login failure
    // Show an error message or redirect to a login page
}
?>
