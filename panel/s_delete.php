<?php
include('config.php');

$user_id = $_GET['Id']; 

$del = "delete from `stock` where Id = '$user_id'";

$rest = mysqli_query($connect , $del);

if (!$rest) {
     die("connection failed");
}
header('location: stock.php');

?>