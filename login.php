<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div>
            <?php
                include("php/connection.php");
                if(isset($_POST['submit'])){
                    $email= mysqli_real_escape_string($con,$_POST['email']);
                    $password= sha1(mysqli_real_escape_string($con,$_POST['password']));
                    $sql="SELECT * FROM users WHERE Email='$email'";
                    $result= mysqli_query($con,$sql);
                    $row = mysqli_fetch_assoc($result);
                    if($row){
                        if($password===$row['Password']){
                            $_SESSION['email']=$row['Email'];
                            $_SESSION['username']=$row['Username'];
                            $_SESSION['id']=$row['Id'];
                            $_SESSION['role']=$row['role'];
                            header("Location: home.php");
                            exit;
                            
                        }
                        else{
                            echo"<div class='loginbody'><div class='message'>Password incorrect<br>
                                <div class='button'><a href='login.php'><button> Go Back</button></a>
                                </div></div></div>";
                        }
                    }
                    else{
                        echo"<div class='loginbody'><div class='message'>User not found<br>
                            <div class='button'><a href='login.php'><button> Go Back</button></a>
                            </div></div></div>";
                    }
                    
                }
                else{
            ?>
            <div class="loginbody">
                <form action="login.php" method="post">
                    <div class="login-head">
                        Login
                    </div>
                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Type your Email Address">
                    </div>
                    <div class="input-container">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Type your Password">
                    </div>
                    <div class="button">
                        <input name="submit" type="submit" value="Login">
                    </div>
                    <div class="signup">
                        Don't have an account?
                        <a href="php/signup.php" class="signup-link">Sign Up</a>
                    </div>
                </form>
            </div>
            <?php }?>
        </div>
    </body>
</html>