<!DOCTYPE html>
<html>
<head>
	<title>Find User</title>
</head>


<body>
<script type="text/javascript" src="scripts/validate.js"></script>

<div class="header">
  <h1>blogalert! <span style=color:#C2D8B9 ><div class = "smaller"> control panel</div></h1>
  <div class="buttons">
	<a href="logout.php" id="nav">log out</a>
	<a href="frontpage.php" id="nav">feed</a>
	<a href="profilepage.php" id="nav">profile page</a>
  </div>
  </div>  
  <div id="notFound"></div>


</body>

<style>
    body {
      background-color: #FFFCF7;
    }

    .header h1 {
      font-size: 500%;
      color: #738290;
      display: flex;
      margin-top: 0.5em;
      justify-content: left;
      align-items: left;
      margin-bottom: 0.3em;
      padding-bottom: 0.1em;
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

	legend{
		display: flex;
        justify-content: space-between;
        align-items: center;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #C2D8B9;
        font-size: 155%;
	}

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: Georgia, 'Times New Roman', Times, serif;
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

    h2 {
      font-size: 200%;
      color: #738290;
      display: flex;
      margin-top: 0.5em;
      justify-content: center;
      align-items: center;
      margin-bottom: 0.3em;
      padding-bottom: 0.1em;
    }

    /* center the form and its elements */
    #mainForm {
     
      font-size: 150%;
      color: #738290;
    }
    table {
      margin-bottom: 0 auto;
      display: flex;
      width: 50%;
      background-color: #FFFFFF;
      border: 0.4em solid #E4F0D0;
      border-radius: 30px;
      height: 150%;
      font-family:Georgia, 'Times New Roman', Times, serif;
      margin-bottom: 0.0001em;
      padding: 1em;
	    margin-left: auto;
  margin-right: auto;

    }

    #mainForm input[type="submit"] {
      background-color: #E4F0D0;
      margin-top: 0.0001em;
        color: #738290;
        padding-left: 1em;
        padding-right: 1em;
        border: none;
        border-radius: 30px;
        font-size: 75%;
        cursor: pointer;
        font-family:Georgia, 'Times New Roman', Times, serif;
        transition-duration: 0.4s;
    }

    #mainForm input[type="submit"]:hover {
      background-color: #738290;
      color: #E4F0D0;
    }

    #notFound {
      text-align: center;
      font-size: 150%;
      color: #738290;
  }
    a:visited {
    text-align: center;
      font-size: 150%;
        padding-left: 0.3em;
        color: #738290;
        font-size: 100%;
        text-decoration: none;

    }
    a:link {
        padding-left: 0.3em;
        color: #738290;
        font-size: 100%;
    }

    a:hover {
        color: #C2D8B9;
    }


	</style>

<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$host = "localhost";
			$database = "blogalert";
			$user = "webuser";
			$password_db = "P@ssw0rd";

			$db = mysqli_connect($host, $user, $password_db, $database);

			$username = mysqli_real_escape_string($db, $username);

			$query = "SELECT firstName, lastName, email, userID FROM users WHERE username='$username'";
			$result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                 $row = mysqli_fetch_assoc($result);
				 
				 $userID = $row['userID'];
				 
				 // SELECTing the image from userImages table for the given userID
				 $sql = "SELECT contentType, image FROM userImages where userID=?";
				 $stmt = mysqli_stmt_init($db);
				 mysqli_stmt_prepare($stmt, $sql);
				 mysqli_stmt_bind_param($stmt, "i", $userID);
				 $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
				 mysqli_stmt_bind_result($stmt, $type, $image);
				 mysqli_stmt_fetch($stmt);
				 mysqli_stmt_close($stmt);
				 
				 echo "<fieldset id='mainForm'>";
echo "<legend>User Information</legend>";
echo "<table>";
echo "<tr><td>First Name:</td><td>" . $row['firstName'] . "</td></tr>";
echo "<tr><td>Last Name:</td><td>" . $row['lastName'] . "</td></tr>";
echo "<tr><td>Email:</td><td>" . $row['email'] . "</td></tr>";
echo "<tr><td>ID:</td><td>" . $row['userID'] . "</td></tr>";
echo "<tr><td>Image:</td><td><img src='data:image/".$type.";base64,".base64_encode($image)."'/></td></tr>";
echo "</table>";
echo "</fieldset>";

				// Add option to delete user from database
				echo "<form method='get' action='deleteuser.php' id = 'mainForm'>";
				echo "<input type='hidden' name='userID' value='" . $userID . "'>";
				echo "<input type='submit' value='Delete User'>";
				echo "</form>";


            } else {
              echo "<div id='notFound'>user not found</div>";
              echo "<div id='notFound'><a href='finduser.php'>click here to try again</a></div>";
            }


			mysqli_close($db);
		} else {
			echo 'Username is required';
		}
	} else {
	}
?>
</html>