<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405); 
  exit('Invalid request method.');
}

if (!isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'])) {
  http_response_code(400); 
  exit('Missing parameters.');
}

$host = "localhost";
$database = "blogalert";
$user = "webuser";
$password = "P@ssw0rd";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}

$sql = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
  header("Location: signuperror.php");
} else {
  $sql = "INSERT INTO users (firstName, lastName, username, email, password) VALUES (?, ?, ?, ?, md5(?))";
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "sssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password']);

  if (mysqli_stmt_execute($stmt)) {
    $userID = mysqli_insert_id($connection); // Get the auto-generated ID for the newly inserted user

    // Check if a file was uploaded
    if(isset($_FILES['userImage']) && $_FILES['userImage']['error'] === UPLOAD_ERR_OK) {
      // Check if the file is a valid image file
      $imageFileType = strtolower(pathinfo($_FILES['userImage']['name'],PATHINFO_EXTENSION));
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
        http_response_code(400); 
        exit('Invalid file type.');
      }

      // Check if the file size is under 100k
      if ($_FILES['userImage']['size'] > 100000) {
        http_response_code(400); 
        exit('File size is too large.');
      }

      $imagedata = file_get_contents($_FILES['userImage']['tmp_name']); //store the contents of the files in memory in preparation for upload

      // Insert the image data into the userImages table
      $sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";
      $stmt = mysqli_stmt_init($connection);
      mysqli_stmt_prepare($stmt, $sql);
      $null = NULL;
      mysqli_stmt_bind_param($stmt, "isb", $userID, $imageFileType, $null);
      mysqli_stmt_send_long_data($stmt, 2, $imagedata);
      $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
      mysqli_stmt_close($stmt);
    }

    header("Location: login.php");
    exit();
  } else {
    echo 'Error creating user: ' . mysqli_error($connection);
  }

  mysqli_stmt_close($stmt);
}

mysqli_close($connection);