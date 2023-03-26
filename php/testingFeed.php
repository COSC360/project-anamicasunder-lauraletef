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


// Query the database to get the blog posts
$sql = "SELECT * FROM blogpost ORDER BY date_posted DESC";
$result = $conn->query($sql);

// Loop through the result and display the blog posts
while ($row = $result->fetch_assoc()) {
    echo "<h2>" . $row["username"] . "</h2>";
    echo "<p>" . $row["post"] . "</p>";
    echo "<p>Posted on " . $row["date_posted"] . "</p>";
}

?>
</html>