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
   if (isset($_POST['submit_post'])) {
       // Get the submitted post data
       $username = $_SESSION['username'];
       $post = $_POST['post'];
       $post_id = rand(); // Generate random post ID

       // Insert the new post into the database
       $sql = "INSERT INTO blogpost (username, post_id, post, date_posted) VALUES ('$username', '$post_id', '$post', NOW())";
       if ($conn->query($sql) === TRUE) {
           echo "<p>Post added successfully.</p>";
       } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }
   }

   // Check if the form to add a new comment was submitted
   if (isset($_POST['submit_comment'])) {
       // Get the submitted comment data
       $username = $_SESSION['username'];
       $comment = $_POST['comment'];
       $post_id = $_POST['post_id'];

       // Insert the new comment into the database
       $sql = "INSERT INTO comment (username, post_id, comment, date_commented) VALUES ('$username', '$post_id', '$comment', NOW())";
       if ($conn->query($sql) === TRUE) {
           echo "<p>Comment added successfully.</p>";
       } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }
   }

   // Display the form to add a new post
   echo '<form method="post" action="">
           <label for="post">Post:</label>
           <textarea name="post" id="post"></textarea><br><br>
           <input type="submit" name="submit_post" value="Add Post">
         </form>';

} else {
   // User is not logged in, display all the posts in the database
   $sql = "SELECT * FROM blogpost";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       // Display all the posts in the database
       while ($row = $result->fetch_assoc()) {
           echo "<h2>" . $row['username'] . "</h2>";
           echo "<p>" . $row['post'] . "</p>";
           echo "<p>" . $row['date_posted'] . "</p>";

           // Display comments for the post
           $post_id = $row['post_id'];
           $sql_comments = "SELECT * FROM comment WHERE post_id = '$post_id'";
           $result_comments = $conn->query($sql_comments);

           if ($result_comments->num_rows > 0) {
               echo "<h3>Comments:</h3>";
               while ($row_comment = $result_comments->fetch_assoc()) {
                   echo "<p>" . $row_comment['username'] . "</p>";
echo "<p>" . $row_comment['content'] . "</p>";
 echo "<hr>";
  }
   } else {
       echo "No posts found.";
   }
// Display the form to add a new comment
echo '<form method="post" action="">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment"></textarea><br><br>
        <input type="hidden" name="post_id" value="' . $row['post_id'] . '">
        <input type="submit" name="submit_comment" value="Add Comment">
      </form>';


}


// Close the database connection
$conn->close();
?>
