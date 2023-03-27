<?php
session_start();

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

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, display logout button
    echo '<form method="post" action="">
          <input type="submit" name="logout" value="Logout">
          </form>';

    // Check if the form to add a new comment was submitted
    if (isset($_POST['submit_comment'])) {
        // Get the submitted comment data
        $username = $_SESSION['username'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];
        $date_posted = date("Y-m-d H:i:s"); // Get current date and time

        // Insert the new comment into the database
        $sql = "INSERT INTO comments (username, post_id, comment, date_posted) VALUES ('$username', '$post_id', '$comment', '$date_posted')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Comment added successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Get the post ID from the query string
    $post_id = $_GET['post_id'];

    // Get the post from the database
    $sql = "SELECT * FROM blogpost WHERE post_id = $post_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Display the post
    echo "<h2>" . $row['username'] . "</h2>";
    echo "<p>" . $row['post'] . "</p>";
    echo "<p>" . $row['date_posted'] . "</p>";
    echo "<hr>";

    // Display the comments for this post
    $sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY date_posted ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h4>" . $row['username'] . "</h4>";
            echo "<p>" . $row['comment'] . "</p>";
            echo "<p>" . $row['date_posted'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }

    // Display the form to add a new comment
    echo '<form method="post" action="">
           <input type="hidden" name="post_id" value="' . $post_id . '">
           <label for="comment">Comment:</label>
           <textarea name="comment" id="comment"></textarea><br><br>
           <input type="submit" name="submit_comment" value="Add Comment">
         </form>';

} else {
    // User is not logged in, show login button
    echo '<a href="testingLogin.php">Login</a>';
}
?>

