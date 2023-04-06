<!DOCTYPE html>
<html>
<head>
	<title>User Deleted</title>
</head>
<body>
	<h1>user has been deleted!</h1>
	<p><a href="profilepage.php">return to profile page</a></p>
</body>

<style>
    body{
        background-color: #FFFCF7;
    }
    h1{
        font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 300%;
        color: #738290;
        display: flex;
        margin-top: 2.3em;
        justify-content: center;
        align-items: center;
        padding-bottom: 0.1em;
    }
    p {
        font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 150%;
        color: #738290;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    p:first-child {
			margin-bottom: 1px;
	}

    p:not(:first-child) {
			margin-top: 1px;
	}
    
    a {
			font-family: Georgia, 'Times New Roman', Times, serif;
			font-weight: 550;
			border: none;
			border-radius: 30px;
			padding: 8px;
            width: 600px;
			font-size: 20px;
			background-color: #C2D8B9;
			color:  #738290;
			transition-duration: 0.4s;
			display: block; /* Set the button to a block element to enable margin settings */
			margin: 0 auto;
			text-align: center;
		}

    a:hover{
        background-color: #767d6b;
        color: #FFFCF7;
        cursor: pointer ;
    }

</html>