<?php
    $server='localhost';
    $user='test';
    $pswd='password123';
    $dbname='users';
    if(!$con=mysqli_connect($server,$user,$pswd,$dbname))
        die("Couldn't Connect");
?>