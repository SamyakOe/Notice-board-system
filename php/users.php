<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: index.php");
    }
    include('connection.php');
    $sql='SELECT * from users';
    $result=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Board</title>
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
                <?php if($_SESSION['role']==1){?>
                <li><a href="users.php">Users</a></li>
                <?php }?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="notice-body">
                <div class="notice-head">
                    All Users
                </div>
                <div class="notice-lists">
                    <table class="notice">
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            
                            
                        </tr>
                        <?php while($user_list=mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $user_list['Username']?></td>
                            <td><?php echo $user_list['Email']?></td>
                            <td><?php echo $user_list['Age']?></td>
                            <?php if($_SESSION['role']==1){ ?>
                            <!-- <td><a href="php/?id=<?=$user_list['Id']?>">Edit</a></td>
                            <td><a href="php/?id=<?=$user_list['Id']?>">Delete</a></td> -->
                            <?php }?>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>