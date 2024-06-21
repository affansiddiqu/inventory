<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['uemail'])) {
    header('Location: log.php');
    exit();
}

$user = $_SESSION['uemail'];

?>

<div class="menu">
    <div class="logo">
        <img src="images/logo.png" alt="Noorani & Co">
    </div>
    <?php
        if (in_array('dashboard_view', $user['role'])) {
        ?>


    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i>Settings</a>
          <a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
        </div>
      </div>
</div>
<?php
        }else{
            echo "<script>Access Denied</script>";
        }
?>