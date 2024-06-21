<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code
require('index.php'); 

if (isset($_POST['submit'])) {
    // Gather form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $upass = $_POST['pass'];
    $role = $_POST['ClickedValues']; // Retrieve clickedValues from POST
    
    // Insert data into the `users` table
    $query = "INSERT INTO `users` (`Uname`, `lname`, `email`, `Upass`, `role`) 
              VALUES ('$fname', '$lname', '$email', '$upass', '$role')";
    
    $final = mysqli_query($connect, $query);

    if ($final) {
        echo "<script>alert('Add User successful');</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>

<!-- Your HTML form -->
<section class="container">
    <header>Add User</header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" id="stockForm" method="post">
        <div class="column">
            <div class="input-box">
                <label>First Name</label><br>
                <input name="fname" class="border border-dark text-dark" required />
            </div>
            <div class="input-box">
                <label>Last Name</label><br>
                <input name="lname" class="border border-dark text-dark" required />
            </div>
            <div class="input-box">
                <label>Email</label><br>
                <input type="email" name="email" class="border border-dark text-dark" required />
            </div>
            <div class="input-box">
                <label>Password</label><br>
                <input type="password" name="pass" class="border border-dark text-dark" required />
            </div>
        </div>

        <!-- Hidden input to capture clicked values -->
        <input type="hidden" name="ClickedValues" id="clicked_values">
        
        <?php require('per.php') ?>


        <!-- Submit button -->
        <input type="submit" class="btn btn-danger mt-3" name="submit" />
    </form>
</section>

<!-- JavaScript to handle permission clicks -->
<script>
$(document).ready(function() {
    let clickedValues = []; // Array to store clicked data-values

    $('.modulefun').click(function() {
        $(this).toggleClass('permissionactive');
        
        let permissionName = $(this).data('value');
        
        // Check if permissionName is already in the array
        let index = clickedValues.indexOf(permissionName);
        if (index === -1) {
            // If not found, add it to the array
            clickedValues.push(permissionName);
        } else {
            // If found, remove it from the array (toggle behavior)
            clickedValues.splice(index, 1);
        }

        // Update the hidden input field with clickedValues
        $('#clicked_values').val(clickedValues.join(','));

        // Log the array to console (for debugging)
        console.log(clickedValues);
    });
});
</script>
