<?php
session_start();

if (!isset($_GET['postID'])) {
    header('Location: frontpage.php');
    exit();
}

// Get the post ID from the query string
$postID = $_GET['postID'];

// Establish a database connection
$dbh = new PDO('mysql:host=localhost; dbname=blogalert', 'webuser', 'P@ssw0rd');

// Fetch the blog post and its author
$stmt = $dbh->prepare('SELECT username, textvalue FROM posts JOIN users ON posts.userID = users.userID WHERE postID = :postID');
$stmt->bindParam(':postID', $postID);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch the comments for this post
$stmt = $dbh->prepare('SELECT username, comment FROM comments JOIN users ON comments.userID = users.userID WHERE postID = :postID ORDER BY commentID DESC');
$stmt->bindParam(':postID', $postID);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission for adding comments
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    // Get the user ID from the session
    $userID = $_SESSION['userID'];

    // Get the comment content from the form submission
    $comment = $_POST['comment'];

    // Insert the comment into the database
    try {
        // Prepare the SQL statement
        $stmt = $dbh->prepare('INSERT INTO comments (userID, postID, comment) VALUES (:userID, :postID, :comment)');
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':postID', $postID);
        $stmt->bindParam(':comment', $comment);

        // Execute the statement
        $stmt->execute();

        // Redirect back to the same page to refresh the comments list
        header('Location: comments.php?postID=' . $postID);
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }
}

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
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #738290;
    }

    .smaller{
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #C2D8B9;
        margin-top: 0.4em;
        font-size: 75%;
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

    .comment-container h1{
        font-size: 300%;
        color: #738290;
        display: flex;
        margin-top: 0em;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
    }

    .comment-container p{
        font-size: 100%;
        color: #000000;
        display: flex;
        margin-top: 0em;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        padding: 2em;
        background-color: #FFFFFF;
        width: 60%;
        border: 0.7em solid #C2D8B9;
        border-radius: 30px;
    }

    .commentsheader h2{
        display: flex;
        margin-left: 17.5%;
        font-size: 150%;
        color: #738290;
        margin-bottom: 0.1em; 

    }

    .view {
    display: flex;
    flex-direction: column; 
    margin-left: 17.5%;

    }

    .view div {
    display: flex;
    }

    .view h3 {
    font-size: 100%;
    color: #767d6b;
    margin-right: 0.5em;
    }

    .view p {
    font-size: 100%;
    color: #000000;
    }

    .addcomment{
        text-align: center;
    }

    .addcomment h2{
        display: flex;
        margin-left: 17.5%;
        font-size: 150%;
        color: #738290;
        margin-bottom: 0.1em; 

    }


    textarea {
        box-sizing: content-box;
        resize: none;
        font-size: 100%;
        color: #000000;
        display: flex;
        margin-top: 0em;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        padding: 2em;
        background-color: #FFFFFF;
        border: 0.7em solid #E4F0D0;
        border-radius: 30px;
        font-family:Georgia, 'Times New Roman', Times, serif;
        width: 60%;
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

    .addcomment p {
        font-size: 100%;
        color: #738290;
        font-family:Georgia, 'Times New Roman', Times, serif;
    }

    .addcomment a:link{
        color: #738290;
        font-size: 150%;
    }

    .addcomment a:visited {
        color: #738290;
        font-size: 150%;
    }

    .addcomment a:hover {
        color: #C2D8B9;
    }



</style>
<head>
    <title>Comments</title>
</head>
<body>
<div class="header">
        <h1>blogalert!<span style=color:#C2D8B9 ><div class = "smaller">comments</div></span></h1>
        <div class="buttons">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" id = "nav">log out</a>
                <a href="profilepage.php" id = "nav">profile page</a>
                <a href="frontpage.php" id = "nav">feed</a>
            <?php else: ?>
                <a href="frontpage.php" id = "nav"> back to feed</a>
            <?php endif; ?>
        </div>  
    </div>

<div class="comment-container">
    <h1><?php echo $post['username']; ?>'s post</h1>
    <p><?php echo $post['textvalue']; ?></p>
</div>

<div class="commentsheader">
<h2>comments:</h2>
</div>

<div class="view">
    <?php foreach ($comments as $comment): ?>
        <div>
            <h3><?php echo $comment['username']; ?> commented</h3>
            <p><?php echo $comment['comment']; ?></p>
        </div>
    <?php endforeach; ?>
</div>


<div class="addcomment">
    <?php if (isset($_SESSION['username'])): ?>
        <h2>add a comment:</h2>
        <div class="comment-container">
        <form method="POST">
            <textarea id="comment" name="comment"></textarea><br>
            <button type="submit">submit</button>
        </form>
    </div>
    <?php else: ?>
        <p>you must be logged in to leave a comment</p>
        <a href="login.php">log in</a>
    <?php endif; ?>
    </div>
</body>
</html>