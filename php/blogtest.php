
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
    // User is logged in, display their name and logout button
    echo "Welcome, " . $_SESSION['username'] . "!";
    echo '<form method="post" action="">
            <input type="submit" name="logout" value="Logout">
          </form>';

    // Check if the form to add a new post was submitted
    if (isset($_POST['submit_post'])) {
        // Get the submitted post data
        $username = $_SESSION['username'];
        $post = $_POST['post'];
        $date_posted = date('Y-m-d H:i:s');
        $post_id = uniqid(); // Generate random post ID

        // Insert the new post into the database
        $sql = "INSERT INTO blogpost (post_id, username, post, date_posted) VALUES ('$post_id', '$username', '$post', '$date_posted')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Post added successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

}
  
 

    // Display the form to add a new post
    echo '<form method="post" action="">
            <label for="post">Post:</label>
            <textarea name="post" id="post"></textarea><br><br>
            <input type="submit" name="submit_post" value="Add Post">
          </form>';

    // Display all the posts in the database
    $sql = "SELECT DISTINCT * FROM blogpost ORDER BY date_posted DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h2>" . $row['username'] . "</h2>";
            echo "<p>" . $row['post'] . "</p>";
            echo "<p>" . $row['date_posted'] . "</p>";
            echo '<form method="post" action="">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment"></textarea><br><br>
                    <input type="hidden" name="post_id" value="' . $row['post_id'] . '">
                    <input type="submit" name="submit_comment" value="Submit Comment">
                    </form>';
    // Get comments for this post
    $post_id = $row['post_id'];
    $sql_comments = "SELECT DISTINCT * FROM comments WHERE post_id = '$post_id' ORDER BY date_posted ASC";
    $result_comments = $conn->query($sql_comments);

      // Handle the submission of a new comment
 if (isset($_POST['submit_comment'])) {
    // Get the submitted comment data
    $username = $_SESSION['username'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $date_posted = date('Y-m-d H:i:s');

}

 
// Insert the new comment into the database
$sql = "INSERT INTO comments (post_id, username, comment, date_posted) VALUES ('$post_id', '$username', '$comment', '$date_posted')";
if ($conn->query($sql) === TRUE) {
    echo "<p>Comment added successfully.</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    if ($result_comments->num_rows > 0) {
        // Display all the comments for this post
        echo "<h3>Comments:</h3>";
        while ($row_comment = $result_comments->fetch_assoc()) {
            echo "<p>" . $row_comment['username'] . " said: " . $row_comment['comment'] . "</p>";
            echo "<p>" . $row_comment['date_posted'] . "</p>";
       }
    } else {
        echo "<p>No comments yet.</p>";
    }

    echo "<hr>";
}} else {
    echo "No posts found.";
    }
    
   

// Close the database connection
$conn->close();
?>










