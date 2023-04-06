<!DOCTYPE html>
<html>
<head>
	<title>Find User</title>
</head>
<body>
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
				 
				 echo "<fieldset>";
				 echo "<legend>User Information</legend>";
				 echo "<table>";
				 echo "<tr><td>First Name:</td><td>" . $row['firstName'] . "</td></tr>";
				 echo "<tr><td>Last Name:</td><td>" . $row['lastName'] . "</td></tr>";
				 echo "<tr><td>Email:</td><td>" . $row['email'] . "</td></tr>";
				 echo "<tr><td>ID:</td><td>" . $row['userID'] . "</td></tr>";
				 echo "</table>";
				 echo "</fieldset>";
				 
				 // Displaying the image
				 echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';

				// Add option to delete user from database
				echo "<form method='get' action='deleteuser.php'>";
				echo "<input type='hidden' name='userID' value='" . $userID . "'>";
				echo "<input type='submit' value='Delete User'>";
				echo "</form>";


            } else {
             echo "User not found.";
            }

			mysqli_close($db);
		} else {
			echo 'Username is required';
		}
	} else {
	}
?>
</body>
</html>