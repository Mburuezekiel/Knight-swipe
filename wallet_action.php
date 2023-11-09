<!DOCTYPE html>
<html>
<head>
    <title>Wallet</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
        echo "Welcome to the Wallet page, " . $_SESSION['username'] ['password'] . "!<br>";
        echo "Here, you can perform wallet operations.<br>";
        // Add wallet functionality here
        echo "<a href='logout.php'>Logout</a>";
    } else {
        echo "Access denied. You must be an admin to access this page.";
        echo "<a href='index.php'>Go back to Home</a>";
    }
    ?>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user's ID from your authentication system (you may have a session variable for this)
    $user_id = $userCode; // Replace with the actual user ID

    $action = $_POST["action"];
    $amount = $_POST["amount"];

    // Database connection setup (use your own connection code)
    $db_host = 'localhost';
    $db_user = 'your_db_username';
    $db_pass = 'your_db_password';
    $db_name = 'referral_platform';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($action === 'withdraw') {
        // Implement withdrawal logic
        // Example: Deduct the amount from the user's balance
        $sql = "UPDATE users SET wallet_balance = wallet_balance - ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $amount, $user_id);

        if ($stmt->execute()) {
            // Withdrawal successful
            echo "Withdrawal successful!";
        } else {
            // Withdrawal failed
            echo "Withdrawal failed. Please try again.";
        }
    } elseif ($action === 'hold') {
        // Implement holding logic
        // Example: Add the amount to the user's balance
        $sql = "UPDATE users SET wallet_balance = wallet_balance + ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $amount, $user_id);

        if ($stmt->execute()) {
            // Holding successful
            echo "Holding successful!";
        } else {
            // Holding failed
            echo "Holding failed. Please try again.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
