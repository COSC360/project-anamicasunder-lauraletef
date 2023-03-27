<?php
// Connect to the database
$servername = "localhost";
$username = "24466963";
$password = "24466963";
$dbname = "db_24466963";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is an admin
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    header("Location: login.php");
    exit();
}

// Handle deleting a blog post
if(isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];
    $sql = "DELETE FROM blogpost WHERE post_id='$post_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Blog post deleted successfully";
    } else {
        echo "Error deleting blog post: " . $conn->error;
    }
}

// Display all blog posts
$sql = "SELECT * FROM blogpost";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . "<br>";
        echo "Post: " . $row["post"] . "<br>";
        echo "Likes: " . $row["likes"] . "<br>";
        echo '<form method="post" action=""><input type="hidden" name="post_id" value="' . $row["post_id"] . '">';
        
        // Only show delete button if the user is an admin
        if ($_SESSION['isAdmin'] == 1) {
            echo '<input type="submit" name="delete_post" value="Delete"></form><br><br>';
        } else {
            echo '</form><br><br>';
        }
    }
} else {
    echo "No blog posts";
}
?>