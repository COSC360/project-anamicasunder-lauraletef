<head>
     <h1>blogalert!</h1> 
   </head>

<?php

session_start(); // start the session

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
    // Check if the user submitted the sign-up form
    if (isset($_POST['signup'])) {
        // Get the submitted username and password
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Check if a file was uploaded
        if ($_FILES['profileImage']['size'] > 0) {
            // Get the file contents and add it to the database as a blob
            $profileImage = file_get_contents($_FILES['profileImage']['tmp_name']);
            $profileImage = $conn->real_escape_string($profileImage);
        } else {
            // Set the profile picture to null if no file was uploaded
            $profileImage = null;
            // $profilePictureType = null;
        }

        // Check if the username is already taken
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Username already taken, show an error message
            $error = "That username is already taken. Please choose a different username.";
        } else {
            // Username is available, insert the new user into the database
            $sql = "INSERT INTO users (username, firstName, lastName, email, password, profileImage) VALUES ('$username', '$firstName', '$lastName', '$email', '$password', '$profileImage')";
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
<form method="post" action="" enctype="multipart/form-data"> 
    <label>Username:</label> 
    <input type="text" name="username" required><br> 
    <label>First Name:</label> 
    <input type="text" name="firstName" required>
    <br> <label>Last Name:</label> 
    <input type="text" name="lastName" required><br> 
    <label>Email Address:</label> 
    <input type="text" name="email" required><br> 
    <label>Password:</label> 
    <input type="password" name="password" required><br> 
    <label>Profile Picture:</label> 
    <input type="file" name="profileImage" required><br> 
    <input type="submit" name="signup" value="Sign Up"> 
    <button type="button" class="login" onclick="window.location.href='testingLogin.php'">Already Have An Account?</button> <br> </form>

<?php
// Display error message if there was a sign-up error
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
       margin-top: 1.5em;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
 
}

form{
    background-color: #C2D8B9;
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
    


