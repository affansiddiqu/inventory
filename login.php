<?php
require("config.php");
require('navbar1.php');

if (isset($_POST['submit'])) {
    $username =$_POST['username'];
    $password = $_POST['password'];

    $check = "SELECT * FROM `signup` WHERE Username  = '$username' ";
    $query = mysqli_query($connect , $check);

    if (mysqli_num_rows($query) > 0) {
         $login = mysqli_fetch_assoc($query);
         $db_password = $login['Password'];
         $password_check = password_verify($password , $db_password);
         if($password_check){
            session_start();
            $_SESSION['Username'] = $login['Username'];
            header('location: dashboard.php');
         }else{
            echo "<script> alert('Invalid Username/Password')</script>";
         }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-form">
        <h1>Member Login</h1>
        <form action="Login.php" method="post">
            <p>User Name</p>
            <input type="text" name="username" placeholder="User Name">
            <p>Password</p>
            <input type="password" name="password" placeholder="Password">
            <button name="submit" type="submit">login</button>
        </form>
    </div>
</body>
</html>