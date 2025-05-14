<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['role']!=1){
        header("Location: ../login.php");
        exit;
    }
    include('connection.php');
    $notice_id=$_GET['id'];
    $sql="SELECT * FROM notice WHERE notice_id='$notice_id'";
    $result=mysqli_fetch_assoc(mysqli_query($con,$sql));
     if($_SERVER['REQUEST_METHOD']=='POST'){
         $title= $_POST['title'];
         $post= $_POST['post'];
         $sql_edit="UPDATE notice SET
                title='$title',
                post='$post'
                WHERE notice_id ='$notice_id'";
         if(mysqli_query($con,$sql_edit)){
             header('Location: ../home.php');
             exit;
         }
         
     }
     else{
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
            <div class="notice-body">
                <div class="notice-head">
                    Edit Notice
                </div>
                <div class="notice-lists">
                    <form action="edit-notice.php?id=<?=$result['notice_id']?>" method="post">
                        <div class="add-notice">

                            <input type="text" placeholder="Type the Title Here" name="title" value="<?=$result['title']?>" required>
                            <textarea name="post" placeholder="Type the Description Here"  required><?=$result['post']?></textarea>
                            <input type="submit" name="submit" value="Confirm">
                        </div>
                    </form>
                </div>
            </div>
            
            
        </div>

    </div>
</body>
</html>
<?php }?>
