<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['Username'])) {
    header('Location: login.php');
    exit();
}

// Check user's role and permissions
$role = $_SESSION['Role'];
$can_view = $_SESSION['CanView'];
$can_update = $_SESSION['CanUpdate'];
$can_insert = $_SESSION['CanInsert'];
$can_delete = $_SESSION['CanDelete'];

// Example of access control logic for product.php
if ($role === 'admin' || 
    ($role === 'manager' && $can_view == 1 && $can_insert == 1 && $can_update == 1 && $can_delete == 1) ||
    ($role === 'user' && $can_view == 1 && $can_insert == 1)
) {
    // Allow access
} else {
    header('Location: access_denied.php'); // Redirect to access denied page or handle as appropriate
    exit();
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