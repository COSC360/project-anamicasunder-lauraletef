<!DOCTYPE html>
<html>
<head>
     <h1>blogalert!</h1> 
   </head>
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

}
</style>
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
   

   <input type="text" class="username" name="login" placeholder="username"required><br><br>
   
 
   <input type="text" class="password" name="password" placeholder = "password"required><br>
   <br>
   <input type="text" class="email" name="email" placeholder = "email"required><br>
   <br>
   <input type="submit" class="submit" value="sign up!">
</form>


</body>
</html>