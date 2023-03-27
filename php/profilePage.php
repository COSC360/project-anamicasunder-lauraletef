
     <nav>
        <a href = "blogtest.php">feed</a>
        <a href = "profilePage.php">view profile!</a> 
    </nav>

<?php
// Start session to check if user is logged in
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: testingLogin.php");
    exit();
}

// Connect to the database
$host = "localhost";
$username = "24466963";
$password = "24466963";
$dbname = "db_24466963";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user information from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

// Update user information if form submitted
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $profileImage = $_POST['profileImage'];
    $password = $_POST['password'];

    // Update user information in the database
    $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', profileImage='$profileImage', password='$password' WHERE username='$username'";
    if (mysqli_query($conn, $sql)) {
        // Refresh the page to show updated user information
        header("Location: profilePage.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Display user information
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $profileImage = $row['profileImage'];
    $password = $row['password'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <form method="post">

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>"><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>

        <label for="profileImage">Profile Picture URL:</label>
        <input type="file" id="profileImage" name="profileImage" value="<?php echo $profileImage; ?>"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>

        <input type="submit" name="submit" value="Save Changes">
    </form>
</body>
</html>

<?php
} else {
    echo "User not found";
}

// Close database connection
mysqli_close($conn);
?>






