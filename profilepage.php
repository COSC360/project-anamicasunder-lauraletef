<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
         body{
        background-color: #FFFCF7;
    }
     h1{
        font-size: 500%;
        color: #738290;
        display: flex;
        margin-top: 0.5em;
        justify-content: left;
        align-items: left;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
        margin-left:0.2em; 
  
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
        float:top;
    }

    body {
        font-family: Georgia, 'Times New Roman', Times, serif;
        margin: 0;
        padding: 0;
    }
    
    #profile-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    #profile-info h1 {
        margin-top: 0;
    }
       
    #profile-info img {
        max-width: 200px;
        border-radius: 50%;
        margin-bottom: 1em;
    }
        
    #profile-info h2 {
        margin: 0;
    }
       
    #profile-info p {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-top: 1em;
        background-color: #FFFFFF;
        border: 0.7em solid #E4F0D0;
        border-radius: 30px;
        padding: 2em;
        width: 550px;
    }

    .post-actions {
        display: flex;
        justify-content: space-between;
    }
 
    a:visited{
        color: #738290;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }


    #comments:visited {
        padding-left: 0.3em;
        color: #738290;
        font-size: 100%;
        text-decoration: none;

    }
    #comments:link {
        padding-left: 0.3em;
        color: #738290;
        font-size: 100%;
    }

    #comments:hover {
        color: #C2D8B9;
    }

    #delete {
        background-color: #E4F0D0;
        color: #738290;
        padding-left: 1em;
        padding-right: 1em;
        border: none;
        border-radius: 30px;
        font-size: 100%;
        cursor: pointer;
        font-family:Georgia, 'Times New Roman', Times, serif;
        transition-duration: 0.4s;

    }

    #delete:hover {
        background-color: #738290;
        color: #E4F0D0;
    }



    </style>

<title>blogalert!</title>
</head>
        <?php
        session_start();
             // check if user is logged in
        if (!isset($_SESSION['userID'])) {
            header("Location: login.php");
            exit();
        }
        ?>
    <div class="header">
        <h1>blogalert! <span style=color:#C2D8B9 > <div class = "smaller"> profile</div></h1>
        <div class="buttons">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" id = "nav">log out</a>
                <a href="frontpage.php" id = "nav">feed</a>
            <?php endif; ?>
        </div>  
    </div>
</head>





<body>
    <div id="profile-info">
        <?php


        // connect to database
        $conn = mysqli_connect("localhost", "webuser", "P@ssw0rd", "blogalert");

        // check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // get user ID from session
        $userID = $_SESSION['userID'];

        // get user information
        $userQuery = "SELECT * FROM users WHERE userID = '$userID'";
        $userResult = mysqli_query($conn, $userQuery);
        $user = mysqli_fetch_assoc($userResult);

        // get user image
        $sql = "SELECT contentType, image FROM userImages where userID=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userID);
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_bind_result($stmt, $type, $image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // get user posts
        $postQuery = "SELECT * FROM posts WHERE userID = '$userID'";
        $postResult = mysqli_query($conn, $postQuery);

        // check if user is admin
        $isAdmin = strpos($user['username'], 'admin') !== false;

        // display user information and posts
        echo "<h1 id='nice' style='font-size: 400%;'>nice to see you " . $user['username'] . "! </h1>";
        echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';
        echo "<h2>your blog posts:</h2>";
        while ($post = mysqli_fetch_assoc($postResult)) {
            echo "<div>";
            echo "<p>" . $post['textvalue'] . "</p>";
            echo '<div class="post-actions">';
            echo '<a href="comments.php?postID=' . $post['postID'] . '" id="comments">view comments</a>';
            echo '<form action="deletepost.php" method="post">';
            echo '<input type="hidden" name="postID" value="' . $post['postID'] . '"/>';
            echo '<input type="submit" name="delete" value="delete" id="delete" />';
            echo '</form>';
            echo '</div>'; // end of .post-actions
            echo "</div>";
        }

        // display admin control link if user is admin
        if ($isAdmin) {
            echo "<div id='admin-controls'><a href='finduser.php' class = 'admin-controls'>Admin Controls</a></div>";
        }

        // close database connection
        mysqli_close($conn);
    ?>
</div>
</body>
</html> 