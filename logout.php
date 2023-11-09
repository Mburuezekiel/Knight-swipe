<?php
// Start or resume the existing session
session_start();

// Check if the user is logged in (you can replace this condition with your own authentication logic)
if (isset($_SESSION['user_id'])) {
    // If the user is logged in, destroy their session
    session_destroy();
    session_unset();

    // Redirect the user to a login page or another page after successful logout
    header("Location: login.html");
    exit();
} else {
    // If the user is not logged in, handle the logout request accordingly (e.g., display an error message)
    echo "You are not logged in.";
}
?>

