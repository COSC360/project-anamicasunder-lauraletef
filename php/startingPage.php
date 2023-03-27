
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="html/css/main.css">
    
    <style>
    body{
        background-color: #FFFCF7;
    }

    h1{
        font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 500%;
        color: #738290;
        display: flex;
        margin-top: 2.5em;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.3em;
        padding-bottom: 0.1em;
  
    }
    .login{
        background-color: #E4F0D0;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #515c66;
        font-weight: bold;
        transition-duration: 0.4s;


    }

    .signup{
        background-color: #C2D8B9;
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #515c66;
        font-weight: bold;
        transition-duration: 0.4s;

    }

    button{
        display: block;
        justify-content: space-evenly;
        width: 400px;
        padding: 1em;
        height: 70px;
        margin: auto;
        border-radius: 30px;
        border-width: 0em;
        font-size: 145%;
    }

    .login:hover{
        background-color: #767d6b;
        color: #FFFCF7;
        cursor: pointer ;
    }

    .signup:hover{
        background-color: #767d6b;
        color: #FFFCF7;
        cursor: pointer ;
    }

    .imgood:hover{
        color: #8d9e86;
        cursor: pointer ;
    }

    .imgood{
        font-family:Georgia, 'Times New Roman', Times, serif;
        color: #515c66;
        font-weight: bold;
        font-size: 135%;
        display: flex;
        padding-top: 1em;
        justify-content: center;
        align-items: center;
        transition-duration: 0.4s;
    }
    .buttonMaster{
        padding-top: 1em;
    }

    </style>

   <head>
     <h1>blogalert!</h1> 
   </head>
   <body>
        <div class = "button">
      <button type = "button" class = "login" onclick = "window.location.href = 'testingLogin.php'" >log in</button> 
      <br>
      <button type = "button" class = "signup"onclick = "window.location.href = 'testingSignup.php'" >sign up </button>
      <br>
      <a href="blogtest.php" class = "imgood"> i think im good...</a>


   </body>
</html>