<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      background-color: #FFFCF7;
    }

    h1 {
      font-size: 500%;
      color: #738290;
      display: flex;
      margin-top: 0.5em;
      justify-content: left;
      align-items: left;
      margin-bottom: 0.3em;
      padding-bottom: 0.1em;
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
      text-align: center;
      font-size: 150%;
      color: #738290;
    }

    #mainForm input[type="text"] {
      margin: 0 auto;
      display: block;
      width: 50%;
      background-color: #FFFFFF;
      border: 0.4em solid #E4F0D0;
      border-radius: 30px;
      height: 150%;
      font-family:Georgia, 'Times New Roman', Times, serif;
      margin-bottom: 0.0001em;
      padding: 1em;

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


  </style>

  <script type="text/javascript" src="scripts/validate.js"></script>

  <div class="header">
    <h1>blogalert! <span style=color:#C2D8B9 > admin controls</h1>
    <div class="buttons">
      <a href="logout.php" id="nav">log out</a>
      <a href="frontpage.php" id="nav">feed</a>
      <a href="profilepage.php" id="nav">profile page</a>
    </div>
  </div>

</head>

<body>
  <h2> search a user to view their information </h2>

  <form method="post" action="finduser1.php" id="mainForm">
    enter username:<br>
    <input type="text" name="username" id="username" class="required">
    <br><br>
    <input type="submit" value="find user">
  </form>
  
</body>

</html>