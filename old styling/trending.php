<!DOCTYPE html>
<html>
<head>
     <h1>blogalert!</h1>
     <h2> trending </h2> 
     <nav>
        <a href = "feed.php">feed</a> 
        <a href = "trending.php">trending</a> 
        <a href = "profile.php">profile</a> 
        <a href = "settings.php">settings</a>
</nav>
<head>

<body>

     <div class = "blogposts">
        <div>
            <p class="blog">blog entry 1</p>    
        </div>
        <div>
            <p class="blog">blog entry 2</p>  
        </div>
        <div>
            <p class="blog">blog entry 3</p>  
        </div>
        <div>
            <p class="blog">blog entry 4</p>  
        </div>
    </div>

    <div class = "comments">
        <div>
            <p class="comment" id="first">COMMENTS HERE</p>
        </div>
        <!-- <div>
            <p class="comment" id="second">COMMENTS HERE</p>
        </div> -->

    </div>

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
        color: #A1B5D8;
        margin-left:13.5em;
        margin-top:-2.4em;
    }
    nav{
    font-family:Georgia, 'Times New Roman', Times, serif;
        font-size: 150%;
        color: #738290;
        margin-top:-2.4em;
        float:right;
        overflow: auto;
        margin-right:2em;
    }
    nav a{
        color: #738290;
    }

    nav a:hover{
        color: #A1B5D8;
        cursor: pointer ;
    }
    .blog{
    font-family Georgia;
    background-color: #738290;
    color: #FFFCF7;
    text-align: center;
    width: 50%;
    border-radius: 50px;
    font-size: 130%;
    display: block;
    padding:20px;
    border: 2em;
    float:left;
    margin-left: 3em;
    margin-top: 3em;
    padding-bottom: 120px;
    }
    .comment{
    font-family Georgia;
    background-color: #A1B5D8;
    color: #FFFCF7;
    text-align: center;
    width: 30%;
    border-radius: 50px;
    font-size: 130%;
    display: block;
    padding:20px;
    border: 2em;
    float:right;
    margin-right: 3em;
    margin-top: 3em;
    padding-bottom: 120px;
    vertical-align:top;
    }
    
    
</style>

</html>
