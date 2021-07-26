<?php

$servername = "localhost:3306";
$username = "root";
$password = "root";
$db= "e_learning_site";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["email"])){
    $userID= $_POST["userID"];
    $name= $_POST["name"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $phone= $_POST["phone"];
    $address= $_POST["address"];
    
    //echo '<script>alert('.$_FILES["fileToUpload"].');</script>';
    if(isset($_FILES["fileToUpload"])){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $ext = pathinfo($target_file, PATHINFO_EXTENSION);
        $target_file_1 = $target_dir . $userID .".". $ext;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            
            echo '<script>alert("File is not an image.");window.location.replace("index.php");</script>';
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file_1)) {
            
            echo '<script>alert("Sorry, file already exists.");window.location.replace("index.php");</script>';
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            
            echo '<script>alert("Sorry, your file is too large.");window.location.replace("index.php");</script>';
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            
            echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");window.location.replace("index.php");</script>';
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            
            echo '<script>alert("Sorry, your file was not uploaded.");window.location.replace("index.php");</script>';
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_1)) {
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.");window.location.replace("index.php");</script>';
        }
        }
        $photo= $target_file_1;
    }
    else{
        $photo="";
    }
    $date1= date("d-m-Y");
    $sql="select * from user where userID=". $userID. ";";
    $result = $conn->query($sql);
    if($result->num_rows >0){
        echo '<script>alert("UserID already taken");window.location.replace("index.php");</script>';
    }
    $sql="insert into user (userID,name,regDate,address,profilePic,phoneNum,email,password) values (".$userID.",'".$name."',CURDATE(),'".$address."','".$photo."','".$phone."','".$email."','".$password."');";
    //echo $sql;
    if($conn->query($sql) === TRUE){
        
    }
    else{
        echo '<script>alert("Cannot register");window.location.replace("index.php");</script>';
    }
}
else if(isset($_POST["feedback_email"])){
    
    $userID= $_POST["userID"];
    $email=$_POST["feedback_email"];
    $name=$_POST["name"];
    $feedback=$_POST["feedback"];
    $userID_entered= $_POST["userID_entered"];

    if($userID_entered==$userID){
        $sql= "insert into feedback ( name, email, feedback, userID) values('".$name."','".$email."','".$feedback."','".$userID."');";
        
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Feedback submittted successfully");</script>';
        }
        else{
            echo '<script>alert("Request failed");</script>';
        }
    }
    else{
        echo '<script>alert("Wrong UserID!");</script>';
    }

}
else if(isset($_POST["contact_email"])){
    $userID=$_POST["userID"];
    $email=$_POST["contact_email"];
    $phone=$_POST["phone"];
    $message=$_POST["message"];
    $name=$_POST["name"];
    
    $userID_entered= $_POST["userID_entered"];
    if($userID_entered==$userID){
        $sql= "insert into Contact ( userID, name, email, message, phoneNum) values('".$userID."','".$name."','".$email."','".$message."','".$phone."');";
        
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Contact added successfully");</script>';
        }
        else{
            echo '<script>alert("'.$sql.'");</script>';
        }
    }
    else{
        echo '<script>alert("Wrong UserID!");</script>';
    }
}
    $userID=$_POST["userID"];
    $sql = "SELECT name,password,profilePic FROM user where userID=".$userID.";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name= $row["name"];
        $password= $row["password"];
        $photo=$row["profilePic"];
      } else {
        echo '<script>alert("Have not registered yet!");window.location.replace("index.php");</script>';
      }
      if($password!=$_POST["password"]){
        echo '<script>alert("Wrong password!");window.location.replace("index.php");</script>';
      }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged IN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="register.php" method="post" style="float:left">
    <div id='input'>
                <input type='textbox' name='userID' value="<?php echo $userID;?>" hidden></input>
            </div><br>
            <div id='input'>
                <input type='textbox' name='password' value="<?php echo $password;?>" hidden></input>
            </div><br>
            
            <button type='submit'>Refresh</button>
    </form>
    <h3 style="display: inline">Welcome! <?php echo $name?></h3>
    <span style="float: right"><img style="border-radius: 50%;" id="profile_pic" src="<?php if($photo==""){echo 'download.jpg';}else{echo $photo;}?>" alt=""><h4>UserID: <?php echo $_POST["userID"]?></h4><a href="index.php">Logout</a></span>
    <br><br><br><br><br><br><br><br><br><br>
    <h4>Check out the courses:</h4>
    <table id="table">
        <tr>
            <th>course_name</th>
            <th>courseID</th>
            <th>course_resource</th>
            <th>course_description</th>
            <th>course_fee</th>
        </tr>
        <?php
            $sql = "SELECT course_name, courseID, course_resource,course_description,course_fee FROM course";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["course_name"]."</td><td>".$row["courseID"]."</td><td><a href=".$row["course_resource"]." download>download
                </a></td><td>".$row["course_description"]."</td><td>".$row["course_fee"]."</td></tr>";
            }
            }
            
        ?>
    </table>
    <br><br><br><br><br><br><br>
    <h3>Submit a feedback</h3>
        <form action='register.php' method='POST' enctype='multipart/form-data'>
            <div id='input'>
                <span>Name</span><input type='text' name='name' required></input>
            </div><br>
            <div id='input'>
                <span>User ID</span><input type='text' name='userID_entered' placeholder='Enter a user ID' required></input>
            </div><br>
            <div id='input'>
                <span>Email</span><input type='text' name='feedback_email' required></input>
            </div><br>
            <div id='input'>
                <span>Feedback</span><input type='textbox' name='feedback' required></input>
            </div><br>
            <div id='input'>
                <input type='textbox' name='userID' value="<?php echo $userID;?>" hidden></input>
            </div><br>
            <div id='input'>
                <input type='textbox' name='password' value="<?php echo $password;?>" hidden></input>
            </div><br>
            
            <button type='submit'>Submit</button>
        <br><br><br>   
        </form>
        <h3>Add a contact</h3>
        <form action='register.php' method='POST'>
            <div id='input'>
                <span>User ID</span><input type='text' name='userID_entered' placeholder='Enter a user ID' required></input>
            </div><br>
            <div id='input'>
                <span>Name</span><input type='text' name='name' required></input>
            </div><br>
            
            <div id='input'>
                <span>Email</span><input type='text' name='contact_email' required></input>
            </div><br>
            <div id='input'>
                <span>Phone</span><input type='text' name='phone' required></input>
            </div><br>
            <div id='input'>
                <span>Message</span><input type='textbox' name='message' required></input>
            </div><br>
            <div id='input'>
                <input type='textbox' name='userID' value="<?php echo $userID;?>" hidden></input>
            </div><br>
            <div id='input'>
                <input type='textbox' name='password' value="<?php echo $password;?>" hidden></input>
            </div><br>
            
            <button type='submit'>Submit</button>
                    
        </form>
</body>
</html>
<style>
#table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>