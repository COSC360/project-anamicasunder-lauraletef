<!DOCTYPE html>
<html>

<body>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   $login = $_POST["login"];
   $password = $_POST["password"];

   $servername = "localhost";
   $username_db = "laura";
   $password_db = "laura";
   $dbname = "project";
   $conn = new mysqli($servername, $username_db, $password_db, $dbname);
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }


// Prepared stmnt
$stmt = $conn->prepare("SELECT * FROM users WHERE (email = ? OR username = ?) AND password = ?");
$stmt->bind_param("sss", $login, $login, $password);

// Execute SQL and error check
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows == 1) { //just check if an entry exists for given credentials
        //I think this saves their id to the session so you can confirm they're logged in still on other pages. 
        // $row = $result->fetch_assoc(); 
        // $username = $row['username'];
        // $_SESSION['username'] = $username;
        // $isAdmin = $row['isAdmin'];
        // if($isAdmin == 1){
        //     $_SESSION['isAdmin'] = True;
        // }
        // change link to homepage when ready
        header("Location: startingPage.php");
        exit;
    } else {
        $pwerror = "Incorrect username or password";
    }
} else {
    echo "Error: " . $stmt->error;
}


 }
 ?>


<form method="POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
   <label for= "username">UserName:</label><br>

   <input type="text" name="login" required><br><br>
   
   <label for="password">Password</label> <br>
   <input type="text" name="password" required><br>
   <br>
<br>
   <input type="submit" value="Submit">
</form>


</body>
</html>