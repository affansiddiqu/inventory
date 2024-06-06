<?php

session_start();

if(!isset($_SESSION["username"])){
  header('location:login.php');
}
  
  
?>
<div class="menu">
    <div class="logo">
        <img src="images/logo.png" alt="Noorani & Co">
    </div>

    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i>Settings</a>
          <a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
        </div>
      </div>
</div>