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
    // User is logged in, display their name
    echo "Welcome, " . $_SESSION['username'] . "!";

    // Check if the form to add a new post was submitted
    if (isset($_POST['submit'])) {
        // Get the submitted post data
        $username = $_SESSION['username'];
        $post = $_POST['post'];
        $date_posted = $_POST['date_posted'];
        $comments = $_POST['comments'];

        // Insert the new post into the database
        $sql = "INSERT INTO blogpost (username, firstName, post, date_posted) VALUES ('$username', '$firstName', '$post', NOW())";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Post added successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Display the form to add a new post
    echo '<form method="post" action="">

            <label for="post">Post:</label>
            <textarea name="post" id="post"></textarea><br><br>

            <input type="submit" name="submit" value="Add Post">
          </form>';

} else {}

    // User is not logged in, display all the posts in the database
    $sql = "SELECT * FROM blogpost";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display all the posts in the database
        while ($row = $result->fetch_assoc()) {
            echo "<h2>" . $row['username'] . "</h2>";
            echo "<p>" . $row['post'] . "</p>";
            echo "<p>" . $row['date_posted'] . "</p>";
            echo '<form method="post" action="">

            <label for="post">Add a Comment:</label>
            <textarea name="comments" id="comments"></textarea><br><br>

            <input type="submit" name="submit" value="Add Comment">
          </form>';

            // Check if the form to add a new post was submitted
        if (isset($_POST['submit'])) {
        // Get the submitted post data
        $username = $_SESSION['username'];
        $comments = $_POST['comments'];

        // Insert the new post into the database
        $sql = "INSERT INTO blogpost (comments) VALUES ('$comments')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Comment added successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }

            echo "<hr>";
            echo "<p>"Comments:"</p>";
            echo "<p>" . $row['comments'] . "</p>";
        }
    } else {
        echo "No posts found.";
    }


// Close the database connection
$conn->close();
?>
