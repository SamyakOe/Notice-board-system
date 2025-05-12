<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
    }
    include('connection.php');
    $notice_id=$_GET['id'];
    $sql="DELETE FROM notice WHERE notice_id = '$notice_id'";
    if(mysqli_query($con,$sql)){
        echo 'Deleted Successfully!';
        header("Location: ../home.php");
        exit;
    }
    else{
        echo 'Error Deleting Notice:' . mysqli_error($con);
    }
?>