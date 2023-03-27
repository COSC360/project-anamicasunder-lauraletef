
<?php
session_start();

if (isset($_SESSION['username'])) {
    // User is logged in, display logout button
    echo '<form method="post" action="">
          <input type="submit" name="logout" value="Logout">
          </form>';
} else {
    // User is not logged in, show login button
    echo '<a href="testingLogin.php">Login</a>';
}

if (isset($_POST['logout'])) {
  session_destroy(); // destroy all session data
  header("Location: startingPage.php"); // redirect to login page
  exit;
}


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
       $post_id = rand(); // Generate random post ID


       // Insert the new post into the database
       $sql = "INSERT INTO blogpost (username, post_id, post, date_posted) VALUES ('$username', '$post_id', '$post', NOW())";
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
   // User is not logged in, display posts based on keyword search
   if (isset($_POST['search'])) {
       $search_query = $_POST['search'];
       $sql = "SELECT DISTINCT * FROM blogpost WHERE post LIKE '%$search_query%' OR username LIKE '%$search_query%' ORDER BY date_posted DESC";
       $result = $conn->query($sql);
   } else {
       $sql = "SELECT DISTINCT * FROM blogpost ORDER BY date_posted DESC";
       $result = $conn->query($sql);
   }


   if ($result->num_rows > 0) {
       // Display all the posts in the database
       echo '<form method="post" action="">
               <label for="search">Search by username or keyword:</label>
               <input type="text" name="search" id="search">
               <input type="submit" value="Search">
               <input type="button" value="Clear" onclick="window.location=\'\'">
             </form><br>';
       while ($row = $result->fetch_assoc()) {
           echo "<h2>" . $row['username'] . "</h2>";
           echo "<p>" . $row['post'] . "</p>";
           echo "<p>" . $row['date_posted'] . "</p>";
           echo "<hr>";
       }
   } else {
       echo "No posts found.";
   }



// Close the database connection
$conn->close();
?>
