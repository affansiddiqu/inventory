<?php
require('config.php');
require('navbar1.php');

if(isset($_POST['register'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($name) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            $bcrypt_password = password_hash($confirm_password , PASSWORD_BCRYPT);
        
            $fetchdata = $connect->prepare("SELECT * FROM `signup` WHERE Username = ?");
            $fetchdata->bind_param("s", $name);
            $fetchdata->execute();
            $result = $fetchdata->get_result();

            if($result->num_rows > 0){
                echo "<script>alert('User already exists');</script>";
            } else {
                $insert = $connect->prepare("INSERT INTO `signup` (`Username`, `Password`) VALUES(?, ?)");
                $insert->bind_param("ss", $name, $bcrypt_password);
                $insert_data = $insert->execute();

                if($insert_data){
                    echo "<script>alert('Registration successful');</script>";
                    header('Location: login.php');
                    exit();
                } else {
                    echo "<script>alert('Registration Failed');</script>";
                }
            }
        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }
    } else {
        echo "<script>alert('All fields are required');</script>";
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
            <input type="text" name="username" placeholder="User Name" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Password" required>
            <p>Confirm Password</p>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button name="register" type="submit">Register</button>
        </form>
    </div>
</body>
</html>