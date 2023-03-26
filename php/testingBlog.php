<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "24466963";
$password = "24466963";
$dbname = "db_24466963";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if there was an error connecting to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

// Close the database connection
$conn->close();
?>