<?php
require("config.php");
require('nv.php');

if (isset($_POST['submit'])) {
    $useremail = mysqli_real_escape_string($connect, $_POST['uemail']);
    $password = mysqli_real_escape_string($connect, $_POST['upass']);

    $check = "SELECT * FROM `users` WHERE email = '$useremail'";
    $query = mysqli_query($connect, $check);

    if (!$query) {
        die("Query failed: " . mysqli_error($connect));
    }

    if (mysqli_num_rows($query) > 0) {
        $login = mysqli_fetch_assoc($query);
        $db_password = $login['Upass'];

        if (password_verify($password, $db_password)) {
            session_start();
            $_SESSION['uemail'] = $login['email'];
            header('location: product.php');
            exit();
        } else {
            echo "<script>alert('Invalid Password')</script>";
        }
    } else {
        echo "<script>alert('User not found')</script>";
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
        <h1>User Login</h1>
        <form action="ulogin.php" method="post">
            <p>User Email</p>
            <input type="text" name="uemail" placeholder="User Email">
            <p>Password</p>
            <input type="password" name="upass" placeholder="Password">
            <button name="submit" type="submit">Login</button>
        </form>
    </div>
</body>
</html>