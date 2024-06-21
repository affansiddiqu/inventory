<?php
include('config.php');

$user_id = $_GET['Uid']; 

$del = "delete from `users` where Uid = '$user_id'";

$rest = mysqli_query($connect , $del);

if (!$rest) {
     die("connection failed");
}
header('location: user.php');

?>
