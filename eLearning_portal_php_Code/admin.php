<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>eLearning Portal</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <div id='body'>
        

        <h3>Log IN</h3>
        <form action='adminreg.php' method='POST'>
            <div id='input'>
                <span>Admin ID</span><input type='text' name='adminID'></input>
            </div><br>
            <div id='input'>
                <span>Password</span><input type='password' name='password'></input>
            </div><br>
            <button type='submit'>Login</button>
        </form>
    </div>
    
<a href='index.php'>Are you an user??</a>
</body>
</html>";


?>