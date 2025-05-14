<?php
    include("../php/connection.php");
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=mysqli_real_escape_string($con,$_POST["username"]);
        $email=mysqli_real_escape_string($con,$_POST["email"]);
        $age=mysqli_real_escape_string($con,$_POST["age"]);
        $password=mysqli_real_escape_string($con,sha1($_POST["password"]));
        $confirm_password= mysqli_real_escape_string($con,sha1($_POST["confirm_password"]));
        $sql= "SELECT * FROM users WHERE Email = '$email'";
        if(mysqli_num_rows(mysqli_query($con,$sql))>0){
            echo"<div class='loginbody'><div class='message'>User Exists Already<br>
            <div class='button'><a href='signup.php'><button> Go Back</button></a>
            </div></div></div>";
        }
        else{
            if($password===$confirm_password){
                $insert= "INSERT INTO users (Username, Email, Age, Password)
                            VALUES('$username','$email','$age','$password')";
                mysqli_query($con,$insert);
                echo"<div class='loginbody'><div class='message'>User Created<br>
            <div class='button'><a href='../index.php'><button> Go Back</button></a>
            </div></div></div>";
                
            }
            else{
                echo"<div class='loginbody'><div class='message'>Password and Confirm Password do not match.<br>
                <div class='button'><a href='signup.php'><button> Go Back</button></a>
                </div></div></div>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="loginbody">
        <form action="signup.php" method="post">
            <div class="login-head">
                Sign Up
            </div>
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            <div class="input-container">
                <label for="age">Age</label>
                <input type="number" name="age" placeholder="Enter Age" required>
            </div>
            <div class="input-container">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="input-container">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="button">
                <input name="submit" type="submit" value="Sign Up">
            </div>
           
        </form>
        <div class="signup">
            Already have an account?
            <a href="../login.php" class="signup-link">Login</a>
        </div>
    </div>
</body>
</html>