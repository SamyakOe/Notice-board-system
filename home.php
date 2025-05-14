<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }
    include('php/connection.php');
    $sql='SELECT * from notice';
    $result=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Board</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>   
    <div class="main">
        <div class="sidebar">
            <div class="welcome">
                <p>Welcome <?php echo $_SESSION['username']?></p>
            </div>
            <ul class="menu">
                <li><a href="home.php">All Notices</a></li>
                <li><a href="php/edit-profile.php">Edit Profile</a></li>
                <?php if($_SESSION['role']==1){?>
                <li><a href="php/users.php">Users</a></li>
                <?php }?>
                <li><a href="php/logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="notice-body">
                <div class="notice-head">
                    All Notices
                </div>
                <div class="notice-lists">
                    <table class="notice">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <?php if($_SESSION['role']==1){ ?>
                            <th colspan=2>Actions</th>
                            <?php }?>
                        </tr>
                        <?php while($notice_list=mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $notice_list['title']?></td>
                            <td><?php echo $notice_list['post']?></td>
                            <td><?php echo $notice_list['create_date']?></td>
                            <?php if($_SESSION['role']==1){ ?>
                            <td><a href="php/edit-notice.php?id=<?=$notice_list['notice_id']?>">Edit</a></td>
                            <td><a href="php/delete-notice.php?id=<?=$notice_list['notice_id']?>">Delete</a></td>
                            <?php }?>
                        </tr>
                        <?php }?>
                    </table>
                </div>
                <?php if($_SESSION['role']==1){ ?>
                <div class="notice-add">
                    <a href="php/add-notice.php">Add Notice</a>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
    
</body>
</html>