<!DOCTYPE html>
<html>
<head>
    <title>User Account</title>
</head>
<body>
    <?php
    session_start();

    // Check if the user is logged in
    
session_start();

if (isset($_SESSION['user_id'])) {
    // Connect to the database and retrieve user data as shown in a previous example

    // Display user data on the account page
    // ...

} else {
    header("Location: login.php"); // Redirect to the login page if the user is not logged in
    exit();
}


    if (isset($_SESSION['user_id'])) {
        // Database connection setup (replace with your own)
        $db_host = 'localhost';
        $db_user = 'your_db_username';
        $db_pass = 'your_db_password';
        $db_name = 'referral_platform';

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            
        }

        $user_id = $_SESSION['user_id'];

        // Retrieve user's activity, bonuses, and referrals from the database
        $db_host = 'localhost';
$db_user = 'your_actual_db_username';
$db_pass = 'your_actual_db_password';
$db_name = 'your_actual_database_name';
// Function to retrieve user activity from the database
function getUserActivity($conn, $user_id) {
  $activities = array();

  // Implement the SQL query to retrieve user activity (replace with your actual query)
  $sql = "SELECT activity_description, activity_date FROM user_activity WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
      $activities[] = $row;
  }

  $stmt->close();

  return $activities;
}

// Function to retrieve user bonuses from the database
function getUserBonuses($conn, $user_id) {
  $bonuses = array();

  // Implement the SQL query to retrieve user bonuses (replace with your actual query)
  $sql = "SELECT bonus_amount, bonus_date FROM user_bonuses WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
      $bonuses[] = $row;
  }

  $stmt->close();

  return $bonuses;
}

// Function to retrieve user referrals from the database
function getUserReferrals($conn, $user_id) {
  $referrals = array();

  // Implement the SQL query to retrieve user referrals (replace with your actual query)
  $sql = "SELECT referred_user_id, referral_date FROM user_referrals WHERE referrer_user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
      $referrals[] = $row;
  }

  $stmt->close();

  return $referrals;
}

        $activity = getUserActivity($conn, $user_id);
        $bonuses = getUserBonuses($conn, $user_id);
        $referrals = getUserReferrals($conn, $user_id);

        // Display user information, activity, bonuses, referrals, etc.
        echo "<h1>Welcome, " . $_SESSION['username'] . " (User ID: $user_id)</h1>";

        // Display user activity
        echo "<h2>Activity:</h2>";
        echo "<ul>";
        foreach ($activity as $entry) {
            echo "<li>" . $entry['activity_description'] . " on " . $entry['activity_date'] . "</li>";
        }
        echo "</ul>";

        // Display user bonuses
        echo "<h2>Bonuses:</h2>";
        echo "<ul>";
        foreach ($bonuses as $bonus) {
            echo "<li>" . $bonus['bonus_amount'] . " Ksh received on " . $bonus['bonus_date'] . "</li>";
        }
        echo "</ul>";

        // Display user referrals
        echo "<h2>Referrals:</h2>";
        echo "<ul>";
        foreach ($referrals as $referral) {
            echo "<li>User ID " . $referral['referred_user_id'] . " referred on " . $referral['referral_date'] . "</li>";
        }
        echo "</ul>";

    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login.php");
        exit();
    }
    ?>

</body>
</html>

<?php
// Function to retrieve user activity from the database
function getUserActivity($conn, $user_id) {
    // Implement the SQL query to retrieve user activity
    // and return the result as an array of activity entries
}

// Function to retrieve user bonuses from the database
function getUserBonuses($conn, $user_id) {
    // Implement the SQL query to retrieve user bonuses
    // and return the result as an array of bonus entries
}

// Function to retrieve user referrals from the database
function getUserReferrals($conn, $user_id) {
    // Implement the SQL query to retrieve user referrals
    // and return the result as an array of referral entries
}
?>
