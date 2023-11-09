<?php
// Database connection setup (replace with your own)
$db_host = 'localhost';
$db_user = 'your_db_username';
$db_pass = 'your_db_password';
$db_name = 'referral_platform';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate unique user codes
function generateUserCode($conn) {
    $letter = 'B'; // Start with 'B'
    $number = 101; // Start with 101

    // Get the last user code from the database
    $sql = "SELECT user_code FROM users ORDER BY user_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastUserCode = $row['user_code'];

        // Extract the last letter and number
        $lastLetter = substr($lastUserCode, 0, 1);
        $lastNumber = (int)substr($lastUserCode, 2);

        // Update the letter and number based on the last user code
        if ($lastNumber >= 999) {
            // If the number reaches 999, increment the letter and reset the number
            $letter++;
            $number = 101;
        } else {
            // Increment the number
            $number++;
        }
    }

    return $letter . '-' . $number;
}

// Generate a unique user code
$userCode = generateUserCode($conn);

// Insert the user data into the database
$sql = "INSERT INTO users (user_code) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userCode);

if ($stmt->execute()) {
    echo "User code generated and stored: " . $userCode;
} else {
    echo "Error storing user code.";
}

$stmt->close();
$conn->close();
?>
