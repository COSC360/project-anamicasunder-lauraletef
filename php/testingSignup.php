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

// Check if the user submitted the sign-up form
if (isset($_POST['signup'])) {
    // Get the submitted username and password
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];



    // Check if the username is already taken
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username already taken, show an error message
        $error = "That username is already taken. Please choose a different username.";
    } else {
        // Username is available, insert the new user into the database
        $sql = "INSERT INTO users (username, firstName, lastName, email, password) VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            // User successfully added to database, redirect to login page
            header("Location: testingLogin.php");
            exit;
        } else {
            // Error inserting user into database, show an error message
            $error = "There was an error creating your account. Please try again.";
        }
    }
}
?>

<!-- HTML form for user to sign up -->
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username"><br>

    <label>First Name:</label>
    <input type="text" name="firstName"><br>

    <label>Last Name:</label>
    <input type="text" name="lastName"><br>

    <label>Email Address:</label>
    <input type="text" name="email"><br>

    <label>Password:</label>
    <input type="password" name="password"><br>

    <input type="submit" name="signup" value="Sign Up">
</form>

<?php
// Display error message if there was a sign-up error
if (isset($error)) {
    echo "<p>$error</p>";
}
?>