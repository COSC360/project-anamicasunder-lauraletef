<?php
session_start();

// check if user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

// check if post ID is set
if (!isset($_POST['postID'])) {
    header("Location: frontpage.php");
    exit();
}

// get post ID from URL parameter
$postID = $_POST['postID'];

// connect to database
$conn = mysqli_connect("localhost", "24466963", "24466963", "db_24466963");

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check if user has permission to delete post
$userID = $_SESSION['userID'];
$postQuery = "SELECT * FROM posts WHERE postID = '$postID' AND userID = '$userID'";
$postResult = mysqli_query($conn, $postQuery);
if (mysqli_num_rows($postResult) == 0) {
    header("Location: frontpage.php");
    exit();
}

// delete post
$deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
mysqli_query($conn, $deleteQuery);

// redirect to profile page
header("Location: profilepage.php");
exit();

// close database connection
mysqli_close($conn);
?>