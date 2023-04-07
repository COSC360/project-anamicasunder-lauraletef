<?php
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    // Get the user ID from the session
    $userID = $_SESSION['userID'];

    $dbh = new PDO('mysql:host=localhost; dbname=db_24466963', '24466963', '24466963');
    $stmt = $dbh->prepare('SELECT userID FROM users WHERE username = :username');
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $userID = $user['userID'];
    // Get the blog post content from the form submission
    $textvalue = $_POST['textvalue'];

    // Insert the blog post into the database
    try {
        // Establish a database connection
        $dbh = new PDO('mysql:host=localhost; dbname=db_24466963', '24466963', '24466963');

        // Prepare the SQL statement
        $stmt = $dbh->prepare('INSERT INTO posts (userID, textvalue) VALUES (:userID, :textvalue)');
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':textvalue', $textvalue);

        // Execute the statement
        $stmt->execute();

        // Redirect to the homepage
        header('Location: frontpage.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }
}

// Display blog posts
$dbh = new PDO('mysql:host=localhost; dbname=db_24466963', '24466963', '24466963');
$stmt = $dbh->prepare('SELECT postID, username, textvalue FROM posts JOIN users ON posts.userID = users.userID ORDER BY postID DESC');
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);



$dbh = new PDO('mysql:host=localhost; dbname=db_24466963', '24466963', '24466963');

// Check if a search query has been submitted
if (isset($_GET['q'])) {
  $q = $_GET['q'];

  // Search for posts that contain the keyword in the post text or the username
  $stmt = $dbh->prepare('SELECT postID, username, textvalue FROM posts JOIN users ON posts.userID = users.userID WHERE textvalue LIKE ? OR username LIKE ? ORDER BY postID DESC');
  $stmt->execute(["%$q%", "%$q%"]);
} else {
  // If no search query has been submitted, display all posts
 // Display blog posts
$dbh = new PDO('mysql:host=localhost; dbname=db_24466963', '24466963', '24466963');
$stmt = $dbh->prepare('SELECT postID, username, textvalue FROM posts JOIN users ON posts.userID = users.userID ORDER BY postID DESC');
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<style>
    body{
        background-color: #FFFCF7;
    }
    .header h1{
        font-size: 500%;
        color: #738290;
        display: flex;
        margin-top: 0.5em;
        justify-content: left;
        align-items: left;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
        margin-left: 0.2em;
  
    }
    .header {
    position: relative;
    }
/* Set the position of the search bar */
.search {
  /* position: relative; */
  display: flex;
  top: 0;
  left: 0;
  width: 50%;
  background-color: #FFFCF7;
  padding: 10px; 
  justify-content: center;
    align-items: center;
}

/* Style the input field */
.search input[type="text"] {
  border: none;
  border-radius: 5px;
  width: 50%;
  font-size: 16px;
  margin-top: 2em;
  justify-content: center;
    align-items: center;
}



    .smaller{
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #C2D8B9;
        margin-top: 0.3em;
        font-size: 75%;
    }

    h2{
        font-size: 300%;
        color: #738290;
        display: flex;
        margin-top: 0.01em;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
  
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #738290;
    }
    #nav:visited {
        color: #738290;
        font-size: 150%;
        text-decoration: none;

    }
    #nav:link {
        color: #738290;
        font-size: 150%;
        text-decoration: none;
    }

    #nav:hover {
        color: #C2D8B9;
    }

    a {
        margin-right: 25px;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 1em;

    }

    textarea {
        display: flex;
        resize: none;
        width: 700px;
        height: 200px;
        border-color: #C2D8B9;
        border-width: 1em;
        border-radius: 30px;
        padding: 10px;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #738290;
    }

    .post-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 1em;
    background-color: #FFFFFF;
    border: 0.7em solid #E4F0D0;
    border-radius: 30px;
    padding: 2em;

    }

    .post-container h3{
        color: #738290;
    }

    .comments-link {
    align-self: flex-end;
    }

    #comments:visited {
        color: #738290;
        font-size: 100%;
        text-decoration: none;

    }
    #comments:link {
        color: #738290;
        font-size: 100%;
    }

    #comments:hover {
        color: #C2D8B9;
    }

    button[type="submit"] {
        background-color: #E4F0D0;
        color: #738290;
        border: none;
        padding: 10px 20px;
        margin-bottom: 10px;
        border-radius: 30px;
        font-size: 16px;
        cursor: pointer;
        font-family:Georgia, 'Times New Roman', Times, serif;
        transition-duration: 0.4s;


    }

    button[type="submit"]:hover {
        background-color: #738290;
        color: #E4F0D0;
    }


</style>
<head>
    <title>blogalert!</title>
</head>
<body>
    <div class="header">
        <h1>blogalert!  <span style=color:#C2D8B9 > <div class = "smaller"> feed</div></span></h1>
        <div class="buttons">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" id = "nav">log out</a>
                <a href="profilepage.php" id = "nav">profile page</a>
            <?php else: ?>
                <a href="home.php" id = "nav" >home</a>
                <a href="login.php" id = "nav" >log in</a>

            <?php endif; ?>
        </div>  
    </div>

  

    <?php if (isset($_SESSION['username'])): ?>
        <h2>write a blog post:</h2>
        <form method="POST">
            <textarea id="textvalue" name="textvalue"></textarea><br>
            <button type="submit">submit</button>
        </form>
    <?php endif; ?>

    <h2>recent posts</h2>
    <div class="search">
    <form method="get">
    <input type="text" name="q" placeholder="username or keyword">
    <button type="submit">search!</button>
    </form>
    </div>
    <?php foreach ($posts as $post): ?>
    <div class="post-container">
        <div>
            <h3><?php echo $post['username']; ?> blogged: </h3>
            <p><?php echo $post['textvalue']; ?></p>
        </div>
        <div class="comments-link">
            <a href="comments.php?postID=<?php echo $post['postID']; ?>" id = "comments">view comments</a>
        </div>
    </div>
<?php endforeach; ?>

</body>
</html>