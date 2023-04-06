<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  // User is not logged in, redirect to login page
  header('Location: home.php');
  exit();
}

// Clear the session superglobal
session_unset();
session_destroy();

// Redirect the user back to the referring page
if (isset($_SERVER['HTTP_REFERER'])) {
  header('Location: home.php');
} else {
  header('Location: home.php');
}
exit();
?>