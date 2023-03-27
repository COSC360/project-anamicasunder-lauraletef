<!DOCTYPE html>
<html>
<head>
     <h1>blogalert!</h1>
     <h2> settings </h2> 
     <nav>
        <a href = "feed.php">feed</a> 
        <a href = "trending.php">trending</a> 
        <a href = "profile.php">profile</a> 
        <a href = "settings.php">settings</a>
</nav>
</head>

<body>
<form action="/update-profile" method="post">
  <label for="username">username:</label>
  <input type="text" id="username" name="username"><br><br>

  <label for="email">email:</label>
  <input type="email" id="email" name="email"><br><br>

  <label for="password">password:</label>
  <input type="password" id="password" name="password"><br><br>

  <label for="bio">bio:</label>
  <textarea id="bio" name="bio"></textarea><br><br>

  <label for="profile-pic">profile picture:</label>
  <input type="file" id="profile-pic" name="profile-pic"><br><br>

  <input type="submit" value="Save Changes">
</form>
</body>


            
<style>

    body{
        background-color: #FFFCF7;
    }
    h1{
    font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 500%;
        color: #738290;
        display: flex;
        margin-top: 0.2em;
        margin-left: 0.2em;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
 
    }
    h2{
    font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 200%;
        color: #738290;
        margin-left:13.5em;
        margin-top:-2.4em;
    }
    nav{
    font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 150%;
        color: #738290;
        margin-top:-2.4em;
        float:right;
        margin-right:2em;
    }
    nav a{
        color: #738290;
    }

    nav a:hover{
        color: #A1B5D8;
        cursor: pointer ;
    }

    form{
        position: absolute;
        width: 55%;
        margin-top: 70px;
        margin-left: 300px;
        padding: 20px;
        background-color: #C2D8B9;
        font-family: Georgia;
        border-radius: 30px;
        text-align: center;
        justify-content: center;
        display: block; 
    }

    label[for="username"] {
        margin-top: 1em;
        display: inline-block;
        font-weight: bold;
        color: #515c66;

    }

    input[type="text"] {
        display: inline-block;
        font-family: Georgia;
        font-size: 12px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #FFFCF7;
        color: #515c66;
        cursor: pointer;
        width: 58.5%;
        text-align: center;
    }

    label[for="email"] {
        display: inline-block;
        font-weight: bold;
        color: #515c66;
    }

    input[type="email"] {
        display: inline-block;
        font-family: Georgia;
        font-size: 12px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #FFFCF7;
        color: #515c66;
        cursor: pointer;
        width: 63%;
        text-align: center;
    }

    label[for="password"] {
        display: inline-block;
        font-weight: bold;
        color: #515c66;
    }


    input[type="password"] {
        display: inline-block;
        font-family: Georgia;
        font-size: 12px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #FFFCF7;
        color: #515c66;
        cursor: pointer;
        width: 59%;
        text-align: center;


    }


    label[for="bio"] {
        display: inline-block;
        font-weight: bold;
        color: #515c66;
    }

    textarea#bio {
        display: inline-block;
        font-family: Georgia;
        font-size: 12px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #FFFCF7;
        color: #515c66;
        vertical-align: middle;
        resize: none;
        width: 65.5%;
    }
    
    label[for="profile-pic"] {
        display: inline-block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #515c66;
    }

    input[type="file"] {
        display: inline-block;
        font-family: Georgia;
        font-size: 12px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #FFFCF7;
        color: #515c66;
        cursor: pointer;
        width: 54%;

    }

    input[type="file"]:hover,

    input[type="file"]:focus {
        outline: none;
        background-color: #ddd;
    }

    input[type="submit"] {
        background-color: #FFFCF7;
        color: #515c66;
        cursor: pointer;
        border: none;
        font-family: georgia;
        padding: 10px;
        width: 20%;
        border-radius: 15px;
    }

    input[type="submit"]:hover {
        background-color: #767d6b;
        color: #FFFCF7;
        cursor: pointer;
        border: none;
        font-family: georgia;
        padding: 10px;
        width: 20%;
        border-radius: 15px;
    }





</style>

</html>
