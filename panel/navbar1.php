<?
session_start();

if(isset($_SESSION["username"])){
  header('location: index.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
</body>
</html>
<div class="menu">
    <div class="logo">
        <img src="images/logo.png" alt="Noorani & Co">
    </div>
    <div class="con">
    <a href="Signup.php" class="btn btn-dark">Sign Up</a>
    <a href="login.php" class="btn btn-dark">Login</a>
    </div>
<!-- 
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <div id="myDropdown" class="dropdown-content">
        </div>
      </div> -->
</div> 