<?php
require('config.php');
require('navbar1.php');

if(isset($_POST['register'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password){
        $bcrypt_password = password_hash($password , PASSWORD_BCRYPT);
    
    $fetchdata = "SELECT * FROM `signup` where Username = '$name'";
    $check_username = mysqli_query($connect , $fetchdata);
    if(mysqli_num_rows($check_username) > 0){
        echo 'user already exist';
    }else{
        $insert= "INSERT INTO `signup` (`Username`, `Password`) VALUES('$name','$bsrypt_password')";
        $insert_data = mysqli_query($connect , $insert);
        if($insert_data){
            echo "<script> alert('Registration successful')/script>";
            header('location: login.php');
        }else{
            echo "<script> alert('Registration Failed')/script>";
        }
        }
    }else{
            echo "<script> alert('password does not match')/script>";
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
        <h1>Member Sign Up</h1>
        <form action="signup.php" method="post">
            <p>User Name</p>
            <input type="text" name="username" placeholder="User Name">
            <p>Password</p>
            <input type="password" name="password" placeholder="Password">
            <p>Confirm Password</p>
            <input type="password" name="confirm_password" placeholder="Confirm_Password">
            <button name="register" type="submit">register</button>
        </form>
    </div>
</body>
</html>