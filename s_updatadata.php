<?php
require('config.php');

$id = $_POST['Id'];
$type = $_POST['stock'];
$date = $_POST['date'];
$Pid = $_POST['query'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];
$amount = $_POST['amount'];


$update = "UPDATE `stock` SET   P_id = '$Pid' ,Type = '$type' , Date = '$date', Cost ='$cost' , Quantity ='$quantity' , Amount = '$amount' WHERE Id = $id";
$res = mysqli_query($connect, $update);
if (!$res) {
     die("connection failed");
}

header("location:stock.php");


?> 