<?php
require('config.php');

$id = $_POST['Id'];
$type = $_POST['stock'];
$date = $_POST['date'];
$reference = $_POST['query'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];
$amount = $_POST['amount'];


$update = "UPDATE `stock` SET Type = '$type' , Date = '$date', Reference = '$reference' , Quantity ='$quantity' ,Cost ='$cost' , Amount = '$amount' WHERE Id = $id";
$res = mysqli_query($connect, $update);
if (!$res) {
     die("connection failed");
}

header("location:stock.php");


?> 