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
if(isset($_POST["courseID"])){
    $adminID= $_POST["adminID"];
    $courseID=$_POST["courseID"];
    if(isset($_FILES["fileToUpload"])){
       // echo "dgh";
        // =============  File Upload Code d  ===========================================
            $target_dir = "resources/";

            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $ext = pathinfo($target_file, PATHINFO_EXTENSION);
            $target_file_1= $target_dir . $courseID . "." . $ext;
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size -- Kept for 500Mb
            if ($_FILES["fileToUpload"]["size"] > 500000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        $resource_link= $target_file_1;
    }
    $course_name=$_POST["course_name"];
    $course_resource=$resource_link;
    $course_description=$_POST["course_description"];
    $course_fee=$_POST["course_fee"];
    $sql="insert into course (course_name, courseID, course_resource, course_description, course_fee)
    values('".$course_name."','".$courseID."','".$course_resource."','".$course_description."','".$course_fee."');";
    if($conn->query($sql) === TRUE){
        
    }
    else{
        echo '<script>alert("Cannot add the course");window.location.replace("adminreg.php");</script>';
    }
}
else{
    
    $adminID= $_POST["adminID"];
}
    $sql = "SELECT name,password FROM admin where adminID=".$adminID.";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name= $row["name"];
        $password=$row["password"];
      } else {
        echo '<script>alert("Can\'t find you on your database!");window.location.replace("admin.php");</script>';
      }
      if($password!=$_POST["password"]){
        echo '<script>alert("Wrong password!");window.location.replace("admin.php");</script>';
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
    <form action="adminreg.php" method="post" style="float:left">
    <div id='input'>
                <input type='textbox' name='adminID' value="<?php echo $adminID;?>" hidden></input>
            </div><br>
            <div id='input'>
                <input type='textbox' name='password' value="<?php echo $password;?>" hidden></input>
            </div><br>
            
            <button type='submit'>Refresh</button>
    </form>
    <h3 style="display: inline">Welcome! <?php echo $name?></h3>
    <span style="float: right"><h4>AdminID: <?php echo $_POST["adminID"]?></h4><a href="admin.php">Logout</a></span>
    <br><br>
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
    <br>
    <h4>Check out the Users List:</h4>
    <table id="table">
        <tr>
            <th></th>
            <th>user ID</th>
            <th>Name</th>
            <th>reg date</th>
            <th>address</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
        <?php
            $sql = "SELECT userID, name, regDate, address, profilePic, phoneNum, email, password FROM user";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><img src=\"".$row["profilePic"]."\" style='width: 40px;border-radius:50%;'></img></td>
                            <td>".$row["userID"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".$row["regDate"]."</td>
                            <td>".$row["address"]."</td>
                            <td>".$row["phoneNum"]."</td>
                            <td>".$row["email"]."</td>
                          </tr>";
                }
            }
            
        ?>
    </table>
    <br><br><br><br><br><br>
    <br>
    <h4>Check out the feedbacks:</h4>
    <table id="table">
        <tr>
            <th>feedback_id</th>
            <th>Name</th>
            <th>email</th>
            <th>feedback</th>
            <th>userID</th>
        </tr>
        <?php
            $sql = "SELECT feedback_id, name, email, feedback, userID FROM feedback";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["feedback_id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["feedback"]."</td><td>".$row["userID"]."</td></tr>";
                }
            }
            
        ?>
    </table>
    <br><br><br><br><br><br>
    <h4>Check out the contacts:</h4>
    <table id="table">
        <tr>
            <th>User_id</th>
            <th>Name</th>
            <th>email</th>
            <th>message</th>
            <th>Phone</th>
        </tr>
        <?php
            $sql = "SELECT userID, name, email, message, phoneNum FROM Contact";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["userID"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["message"]."</td><td>".$row["phoneNum"]."</td></tr>";
                }
            }
            
        ?>
    </table>
    <br><br><br><br><br><br>
    <h2>Add a course</h2>
    <form action="adminreg.php" method="post" enctype='multipart/form-data'>
            <div id='input'>
                <span>course_name</span><input type='text' name='course_name' placeholder='Enter a course_name' required></input>
            </div><br>
            <div id='input'>
                <span>courseID</span><input type='text' name='courseID' required></input>
            </div><br>
            <div id='input'>
                <span>course resource</span><input type='file' name='fileToUpload' required></input>
            </div><br>
            <div id='input'>
                <span>course_description</span><textarea rows='5' name='course_description' required></textarea>
            </div><br>
            <div id='input'>
                <span>course_fee</span><input type='number' name='course_fee' required></input>
            </div><br>
            <input type="hidden" name="adminID" value="<?php echo $adminID;?>">
            <input type="hidden" name="password" value="<?php echo $password;?>">
            
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