<?php
// Check if the user is authenticated or logged in, otherwise redirect to the login page.
// You would have your own authentication logic here.

// Example: Check if a user is logged in (you may use sessions or any other authentication method).
$userIsAuthenticated = true; // Replace with your authentication logic.

if (!$userIsAuthenticated) {
    header("Location: login.php"); // Redirect to the login page if not authenticated.
    exit;
}

// Assuming the user is authenticated, you can start building the dashboard.
?>

<!DOCTYPE html>
<html>
<head>
    <title>Knight Dashboard</title>
    <!-- Include your CSS and JavaScript files here -->
</head>
<body>
    <nav>
        <!-- Your navigation menu goes here -->
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="wallet.php">Wallet</a></li>
            <!-- Add more menu items as needed -->
        </ul>
    </nav>

    <main>
        <!-- Dashboard content goes here -->
        <h2>Dashboard Overview</h2>
        <!-- Display user-related information, referral links, earnings, etc. -->

        <!-- Example: Display user's unique referral link -->
        <p>Your Referral Link: https://mburuezekiel.github.io/Knight-swipe/register?referral=<?php echo $userUniqueCode; ?></p>
    </main>

    <footer>
        <!-- Footer content goes here -->
        <p>&copy; 2023 Referral Platform<br>Email  <a href="mailto:knightswipereferals@gmail.com">knightswipereferals@gmail.com</a><br>CEO Mr Ezekiel Eric Njuguna<br> Eric's Web Design and Software Developing services.</p>
    </footer>
</body>
</html>

           

