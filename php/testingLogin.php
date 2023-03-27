<head>
     <h1>blogalert!</h1> 
   </head>
<?php

session_start();

// Set up MySQL database connection
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
    echo "Welcome, " . $_SESSION['username'] . "! You are already logged in.";
    if(isset($_SESSION['username']) == 'lauraletef'){
        boolean admin = true;
    }
    
    echo '<button type="button" onclick="window.location.href=\'blogtest.php\'">Continue to Feed</button>';
    if (isset($_SESSION['username'])) {
        // User is logged in, display logout button
        echo '<form method="post" action="">
              <input type="submit" name="logout" value="Logout">
              </form>';
    } 
    if (isset($_POST['logout'])) {
      session_destroy(); // destroy all session data
      header("Location: startingPage.php"); // redirect to login page
      exit;
    }
} else {
    // User is not logged in, show login form
    // Check if the user submitted the login form
    if (isset($_POST['login'])) {
        // Get the submitted username and password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query the database to check if the user exists
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User exists, log them in
            session_start();
            $_SESSION['username'] = $username;
            header("Location: blogtest.php");
            exit;
        } else {
            // User doesn't exist, show an error message
            $error = "Invalid login credentials. Please try again.";
        }
    }
?>

<!-- HTML form for user to log in -->
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username"><br>

    <label>Password:</label>
    <input type="password" name="password"><br>

    <input type="submit" name="login" value="Log In">
    
    <button type="button" class="create" onclick="window.location.href='testingSignup.php'">Create Account</button>
    <br>
</form>

<?php
    // Display error message if there was a login error
    if (isset($error)) {
        echo "<p>$error</p>";
    }
}
?>

<style>
    body{
    background-color: #FFFCF7;

}
form input[type="text"] {
  display: block;
 
}

h1{
    font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 500%;
        color: #738290;
        display: flex;
        position: center;
        margin-top:1.5em;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
 
}


form{
    background-color: #E4F0D0;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #515c66;
        font-weight: bold;
        justify-content: center;
        text-align: center;
        display: block; 
        margin-left: 30%;
        margin-right: 30%;
        padding:2em;
        border-radius: 30px;
}
input{
    font-family:Georgia;
    background-color:  #FFFCF7;
    color: #515c66;
    text-align: center;
    width: 100%;
    border-radius: 40px;
    box-sizing: border-box;
    font-size: 130%;
    display: block;
    padding:20px;
    border: 0em;
}

.submit{
    display: block;
    text-align: center;
    box-sizing: border-box;
        width: 100%;
        border-radius: 40px;
        padding: 20px;
        border-radius: 40px;
        font-size: 145%; 
        transition-duration: 0.4s;
      
    } 
    .submit:hover{
        background-color: #767d6b;
        color: #FFFCF7;
        cursor: pointer ;
    }


    </style>

