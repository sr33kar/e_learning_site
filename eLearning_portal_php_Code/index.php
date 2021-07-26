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
        <h3>Register</h3>
        <form action='register.php' method='POST' enctype='multipart/form-data'>
            <div id='input'>
                <span>User ID</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='userID' placeholder='Enter a user ID' required></input>
            </div><br>
            <div id='input'>
                <span>Name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='name' required></input>
            </div><br>
            <div id='input'>
                <span>Email</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='email' required></input>
            </div><br>
            <div id='input'>
                <span>Password</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='password' name='password' required></input>
            </div><br>
            <div id='input'>
                <span>Phone Number</span><input type='text' name='phone' required></input>
            </div><br>
            <div id='input'>
                <span>Address</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name='address' rows='4' required></textarea>
            </div><br>
            <div id='input'>
                <span>Upload Photo</span><input type='file' name='fileToUpload' required></input>
            </div><br>
            <button type='submit'>Register</button>
                    
        </form>

        <h3>Log IN</h3>
        <form action='register.php' method='POST'>
            <div id='input'>
                <span>User ID</span>&nbsp;&nbsp;&nbsp;<input type='text' name='userID'></input>
            </div><br>
            <div id='input'>
                <span>Password</span><input type='password' name='password'></input>
            </div><br>
            <button type='submit'>Login</button>
        </form>
    </div>
    
<a href='admin.php'>Are you an admin??</a>
</body>
<style>
input, textarea{
    width:200px;
}
span{}
#input{
    right:0%;
}
body{
    width:500px;
    margin-left:30%;
    
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}
</style>
</html>";


?>