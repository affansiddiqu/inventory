<?php
require('config.php');

$id = $_POST['Id'];
$customer = $_POST['customer'];
$date = $_POST['date'];
$reference = $_POST['reference'];
$pname = $_POST['queryq'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];
$amount = $_POST['amount'];
$address = $_POST['address'];
$comment = $_POST['comment'];

$update = "UPDATE `svaluation` SET Customer = '$customer' , Date = '$date', Vreference = '$reference' , Pname ='$pname' , Vquantity ='$quantity' , vamount = '$amount' WHERE Id = $id";
$res = mysqli_query($connect, $update);
// $res = mysqli_query($connect , $update);
if (!$res) {
     die("connection failed");
}

header("location:stockvaluation.php");


?> 