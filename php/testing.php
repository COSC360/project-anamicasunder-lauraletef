<?php
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
        header("Location: feed.php");
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
</form>

<?php
// Display error message if there was a login error
if (isset($error)) {
    echo "<p>$error</p>";
}
?>