<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
    }
    include("connection.php");
    $id=$_SESSION['id'];
    

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $age=$_POST['age'];
        $email=$_POST['email'];
        $sql_update="UPDATE users SET
                    Username='$username',
                    Age='$age',
                    Email='$email'
                    WHERE Id ='$id'";
        if(mysqli_query($con,$sql_update)){
            
            echo'Updated';
            header("Location: edit-profile.php");
            exit;
        }
    }
    else{
    $sql="Select * from users where Id ='$id'";
    $result=mysqli_fetch_assoc(mysqli_query($con,$sql));
    $_SESSION['email']=$result['Email'];
    $_SESSION['username']=$result['Username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <div class="main">
        <div class="sidebar">
            <div class="welcome">
                <p>Welcome <?php echo $_SESSION['username']?></p>
            </div>
            <ul class="menu">
                <li><a href="../home.php">All Notices</a></li>
                <li><a href="edit-profile.php">Edit Profile</a></li>
                <?php if($_SESSION['role']==1){ ?><li><a href="users.php">Users</a></li><?php }?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
    
            <div class="editbody">
                <div class="edit-head">
                    Edit Profile Info
                </div>
                <form action="edit-profile.php" method="post">
                    <div class="input-container">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?=$result['Username']?>" required>
                    </div>
                    <div class="input-container">
                        <label for="age">Age</label>
                        <input type="number" name="age" value="<?=$result['Age']?>" required>
                    </div>
                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?=$result['Email']?>" required>
                    </div>
                    
                    <div class="button">
                        <input name="submit" type="submit" value="Confirm">
                    </div>
                   
                </form>
                
            </div>
        </div>

    </div>
</body>
</html>
<?php }?>