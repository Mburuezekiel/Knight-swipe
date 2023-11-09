<?php
$db_host = 'localhost';
$db_user = 'your_username';
$db_pass = 'your_password';
$db_name = 'referral_platform';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->close();
$phone_number = 'phone_number';
$password_hash = 'hashed_password'; // Make sure to hash the password

$sql = "INSERT INTO users (phone_number, password_hash) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $phone_number, $password_hash);

if ($stmt->execute()) {
    // Insertion successful
} else {
    // Insertion failed
}

$stmt->close();
$user_id = $userCode; // Assuming this is the user's ID
$new_balance = 50.00;

$sql = "UPDATE users SET wallet_balance = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("di", $new_balance, $user_id);

if ($stmt->execute()) {
    // Update successful
} else {
    // Update failed
}

$stmt->close();
$referrer_id = $referrer_code; // Assuming this is the referrer's user ID

$sql = "SELECT * FROM users WHERE referral_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $referrer_id);

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Process referred user data
}

$stmt->close();
$conn->close();
// Your registration data processing code here
// Process user registration
// ...

// Generate a unique referral code (e.g., based on user's ID)
$referralCode = 'Knight Swipe ;' . $userId;

// Save the referral link in the database
// Insert into the database with user details and referral code
$sql = "INSERT INTO users (username, email, referral_code) VALUES ('$username', '$phone_number', '$referralCode')";
// Execute the SQL query
// ...

// Redirect to a success page or member dashboard
// ...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Add your data validation, registration, and database insertion logic here
    // ...

    // After successful registration, you can redirect the user to the account page
    header("Location: account.php");
    exit();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle user registration and store data in the database
    // Ensure password hashing and salting
    // Redirect to index.php after registration
}
?>

<label for="referral_code">Referral Code (optional):</label>
<input type="text" id="referral_code" name="referral_code">
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $phone_number = filter_var($_POST["phone_number"], FILTER_SANITIZE_STRING);
    $password = $_POST["password"]; // No need to sanitize password input
    $referral_code = filter_var($_POST["referral_code"], FILTER_SANITIZE_STRING);

    // Check if phone number is valid (you can add more validation)
    if (!validatePhoneNumber($phone_number)) {
        echo "Invalid phone number. Please enter a valid phone number.";
    } else {
        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Database connection setup
        $db_host = 'localhost';
        $db_user = 'your_db_username';
        $db_pass = 'your_db_password';
        $db_name = 'referral_platform';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Initialize referrer ID to null
        $referrer_id = null;

        // Check if a referral code has been provided
        if (!empty($referral_code)) {
            $sql = "SELECT user_id FROM users WHERE referral_code = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $referral_code);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Referral code is valid; get the referrer's user ID
                $row = $result->fetch_assoc();
                $referrer_id = $row['user_id'];
            }
        }

       // Calculate bonus and registration fee
$bonus_amount = 50; // Ksh. 50 bonus
$registration_fee = 220; // Registration fee

// Calculate the remainder to be added to the pool
$remainder = $registration_fee - $bonus_amount;

// Deduct registration fee from the user's wallet
// Note: You should add proper error handling here
$sql = "UPDATE users SET wallet_balance = wallet_balance - ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("di", $registration_fee, $referrer_id);
$stmt->execute();

// Add the remainder to the pool (you should have a separate table for the pool)
// Note: You should add proper error handling here
$sql = "INSERT INTO pool (amount) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("d", $remainder);
$stmt->execute();

        if ($_SESSION['role'] === 'admin') {
            // Deduct the bonus fee from the admin's wallet (pool)
            // Note: You should add proper error handling here
            $admin_id = 0714487081; // Replace with the actual admin user ID
            $sql = "UPDATE users SET wallet_balance = wallet_balance - ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("di", $bonus_amount, $admin_id);
            $stmt->execute();

            // Add the remainder to the pool (you should have a separate table for the pool)
            // Note: You should add proper error handling here
            $sql = "INSERT INTO pool (amount) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("d", $remainder);
            $stmt->execute();
        }

        // Credit the user's account with the bonus
        // Note: You should add proper error handling here
        $sql = "UPDATE users SET wallet_balance = wallet_balance + ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $bonus_amount, $referrer_id);
        $stmt->execute();

        // Insert user data into the database
        $sql = "INSERT INTO users (phone_number, password_hash, referrer_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $phone_number, $hashed_password, $referrer_id);

        try {
            if ($stmt->execute()) {
                // Registration successful
                echo "Registration successful!";
                // You can redirect users to their account page or login page here.
            } else {
                // Registration failed
                echo "Registration failed. Please try again.";
            }
        } catch (Exception $e) {
            // Handle database-related errors
            echo "Database error: " . $e->getMessage();
        }

        $stmt->close();
        $conn->close();
    }
}

// Function to validate phone number (you can add more validation)
function validatePhoneNumber($phone_number) {
    // Implement your validation logic here (e.g., check for the correct format)
    return true; // Replace with your validation code
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Example: Validate data and insert into the database (using PDO for prepared statements)
    try {
        $db = new PDO("mysql:host=localhost;dbname=your_database_name", "your_db_username", "your_db_password");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Validate data and insert into the 'users' table
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);// Securely hash the password
        $stmt->execute();

        // Redirect to the account page upon successful registration
        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>


