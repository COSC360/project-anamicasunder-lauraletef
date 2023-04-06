<?php
    // connect to database
    $conn = mysqli_connect("localhost", "webuser", "P@ssw0rd", "blogalert");

    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // get user ID from query string
    $userID = $_GET['userID'];

    // delete user from database
    $deleteQuery = "DELETE FROM users WHERE userID = '$userID'";
    if (mysqli_query($conn, $deleteQuery)) {
        $successMsg = "User successfully deleted.";
    }

    // delete user's posts from database
    $deletePostsQuery = "DELETE FROM posts WHERE userID = '$userID'";
    if (mysqli_query($conn, $deletePostsQuery)) {
        $successMsg = "User's posts successfully deleted.";
    }

    // delete user's image from database
    $deleteImageQuery = "DELETE FROM userImages WHERE userID = '$userID'";
    if (mysqli_query($conn, $deleteImageQuery)) {
        $successMsg = "User's image successfully deleted.";
    }

    //delete comments
    $deleteCommentsQuery = "DELETE FROM comments WHERE userID = '$userID'";
    if (mysqli_query($conn, $deleteCommentsQuery)) {
        $successMsg = "User's comments successfully deleted.";
    }

    // redirect to user search page
    header("Location: successfuldeletion.php");
    exit();

    // close database connection
    mysqli_close($conn);
?>