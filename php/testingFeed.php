<!DOCTYPE html>
<html>
<p> hello world!</p>
<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, display their name
    echo "Welcome, " . $_SESSION['username'] . "!";
} else {
    // User is not logged in, redirect to the login page
    header("Location: testingLogin.php");
    exit();
}
?>
</html>