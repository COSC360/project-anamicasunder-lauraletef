

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


   // Display the search form
   echo '<h2>Search Posts</h2>
         <form method="get" action="">
           <label for="keyword">Keyword:</label>
           <input type="text" name="keyword" id="keyword">
           <input type="submit" name="submit" value="Search">
         </form>';


} else {
   // User is not logged in, display all the posts in the database or search results
   $sql = "SELECT * FROM blogpost";
   $search_keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

   if (!empty($search_keyword)) {
      // Filter posts by keyword
      $sql .= " WHERE post LIKE '%$search_keyword%' OR username LIKE '%$search_keyword%'";
   }

   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       // Display all the posts in the database or search results
       while ($row = $result->fetch_assoc()) {
           echo "<h2>" . $row['username'] . "</h2>";
           echo "<p>" . $row['post'] . "</p>";
           echo "<p>" . $row['date_posted'] . "</p>";
           echo "<hr>";
       }
   } else {
       echo "No posts found.";
   }
}


// Close the database connection
$conn->close();
?>
