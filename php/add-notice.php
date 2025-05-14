<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['role']!=1){
        header("Location: ../login.php");
        exit;
    }
    include('connection.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title= $_POST['title'];
        $post= $_POST['post'];
        $date= date("Y/m/d");
        $sql="INSERT INTO notice (title, post, create_date) VALUES ('$title','$post','$date')";
        if(mysqli_query($con,$sql)){
            echo'Added Successfully';
            
        }
        else{
            echo "Error: " . mysqli_error($con);
        }
    }
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
                <li><a href="php/users.php">Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="editbody">
                <div class="edit-head">
                    Add Notice
                </div>
                    <form action="add-notice.php" method="post">
                        <div class="add-notice">
                            <div class="input-container">
                                <label for="title">Title</label>
                                <input type="text" placeholder="Type the Title Here" name="title" required>
                            </div>
                            <div class="input-container">
                                <label for="post">Description</label>
                                <textarea name="post" placeholder="Type the Description Here" required></textarea>
                            </div>
                            <input type="submit" name="submit" value="Add">
                        </div>
                    </form>
            </div>
            
            
        </div>

    </div>
</body>
</html>
