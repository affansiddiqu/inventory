<?php
require('config.php');

// if(isset($_POST['Id'], $_POST['Name'], $_POST['Measure'], $_POST['Category'], $_POST['Sprice'], $_POST['Pprice'])) {
$id = $_POST['Id'];
$Name = $_POST['Name'];
$Measure = $_POST['Measure'];
$Category = $_POST['Category'];
$Sprice = $_POST['Sprice'];
$Pprice = $_POST['Pprice'];

$update = "UPDATE `Products` SET Name = '$Name' , Measurement = '$Measure', Category = '$Category' , Sales_Price ='$Sprice' , Purchase_Price ='$Pprice' WHERE Id = $id";
$res = mysqli_query($connect, $update);
// $res = mysqli_query($connect , $update);
if (!$res) {
     die("connection failed");
}

header("location:product.php");


?> 