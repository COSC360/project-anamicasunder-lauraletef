<?php
session_start();

if (isset($_SESSION['username'])) {
  header("Location: frontpage.php");
  exit();
}
?>


<!DOCTYPE html>
<html>
<style>
    body{
        background-color: #FFFCF7;
    }
    h1{
        font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 500%;
        color: #738290;
        display: flex;
        margin-top: 2.3em;
        justify-content: center;
        align-items: center;
        padding-bottom: 0.1em;
    }
    form {
        background-color: #E4F0D0;
        font-family: Georgia, 'Times New Roman', Times, serif;
        color: #738290;
        border-radius: 30px;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        gap: 1px;
    }

    input[type="text"],
    input[type="password"] {
        font-family: Georgia, 'Times New Roman', Times, serif;
        border: none;
        border-radius: 30px;
        padding: 4px;
        font-size: 14px;
        width: 300px;
    }

    input[type="submit"] {
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-weight: 550;
        border: none;
        border-radius: 30px;
        padding: 4px;
        font-size: 14px;
        background-color: #FFFCF7;
        color: #767d6b;
        transition-duration: 0.4s;

    }

    input[type="submit"]:hover{
        background-color: #767d6b;
        color: #FFFCF7;
        cursor: pointer ;
    }

    #nav{
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 13em;
    }
    #nav2{
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 1em;
    }

    a:visited {
        color: #738290;
        font-size: 100%;
        text-decoration: none;

    }
    a:link {
        color: #738290;
        font-size: 100%;
        text-decoration: none;

    }

    a:hover {
      text-decoration: underline;
        color: #C2D8B9;
    }

</style>
<head>
  <title>log in</title>
</head>
<body>
  <h1>log in</h1>
  <form action="loginprocessing.php" method="post">
    <label for="username">username:</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">password:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="log in">
  </form>

  <a href="signup.html" id = "nav">sign up instead</a>
  <a href="home.php" id = "nav2">return home</a>

</body>
</html>