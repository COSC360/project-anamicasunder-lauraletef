<?php

session_start();

if(isset($_SESSION['username'])) {
  // user is already logged in, redirect to home.php
  header('Location: frontpage.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $host = "localhost";
    $database = "db_24466963";
    $user = "24466963";
    $password_db = "24466963";

    $db = mysqli_connect($host, $user, $password_db, $database);
    
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);
    
    $hashed_password = md5($password);
    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = mysqli_query($db, $query);
    
    if (mysqli_num_rows($result) == 1) {
      // valid user credentials, create session and redirect to home.php
      $user_row = mysqli_fetch_assoc($result);
      $_SESSION['userID'] = $user_row['userID'];
      $_SESSION['username'] = $username;
      header('Location: frontpage.php');
      exit;
    } else {
      // invalid user credentials, redirect back to login.php with an error message
      $error_message = "Invalid username or password. Please try again.";
      header('Location: login.php?error=' . urlencode($error_message));
      exit;
    }
    
    mysqli_close($db);
  } else {
    // incomplete fields, redirect back to login.php
    header('Location: login.php');
    exit;
  }

} else {
  // GET request, redirect back to login.php
  header('Location: login.php');
  exit;
}

?>