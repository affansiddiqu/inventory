<?php
require('config.php');
require('index.php');

// Check if Uid parameter is set in URL
if (isset($_GET['Uid'])) {
    $Uid = $_GET['Uid'];

    // Fetch user details from database based on Uid
    $fetch = "SELECT * FROM `users` WHERE Uid = '$Uid'";
    $query = mysqli_query($connect, $fetch);

    // Check if user exists
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        // Process form submission for updating user data
        if (isset($_POST['update'])) {
            // Retrieve updated values from form
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $role = $_POST['ClickedValues']; // Retrieve clickedValues from POST

            // Update query
            $update_query = "UPDATE `users` SET Uname = '$fname', lname = '$lname', email = '$email', role = '$role' WHERE Uid = '$Uid'";
            $update_result = mysqli_query($connect, $update_query);

            if ($update_result) {
                // Redirect to dashboard or user list page upon successful update
                exit();
            } else {
                echo "Update failed: " . mysqli_error($connect);
            }
        }
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Uid parameter not set.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<style>
    
#permission {
    background-attachment: #fff;
    padding: 10px;
    border-radius: 8px;
}

#permission .moduleName {
    font-weight: bold;
    text-transform: uppercase;
}

.modulefun {
    text-align: center;
    border: 1px solid #000;
    cursor: pointer;
    background-color: #fff; /* Set default background color to white */
    transition: background-color 0.3s ease; /* Smooth transition for color change */
}

.modulefun.permissionactive {
    background-color: lightcoral; /* Pink background color when active */
    color: #fff;
    border: 1px solid #000;
}
</style>

<body>

<section class="container">
    <header>Update User</header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?Uid=" . $Uid; ?>" class="form" id="userForm" method="post">
        <div class="column">
            <div class="input-box">
                <label>First Name</label><br>
                <input name="fname" class="border border-dark text-dark" value="<?php echo $user['Uname']; ?>" required />
            </div>
            <div class="input-box">
                <label>Last Name</label><br>
                <input name="lname" class="border border-dark text-dark" value="<?php echo $user['lname']; ?>" required />
            </div>
            <div class="input-box">
                <label>Email</label><br>
                <input type="email" name="email" class="border border-dark text-dark" value="<?php echo $user['email']; ?>" required />
            </div>
            <div class="input-box">
                <label>Password</label><br>
                <input type="password" name="pass" class="border border-dark text-dark" value="<?php echo $user['Upass']; ?>" required />
            </div>
        </div>

        <!-- Permissions Selection -->
        <div id="permission">
            <h5 class="mt-4">Permissions</h5>
            <hr>
            <div class="permissionContainer">
                <div class="permission">
                    <div class="row">
                        <div class="col-md-2 moduleName">
                            Dashboard
                        </div>
                        <div class="col-md-2">
                            <p class="modulefun <?php if (strpos($user['role'], 'dashboard_view') !== false) echo 'permissionactive'; ?>" data-value="dashboard_view">View</p>
                        </div>
                    </div>
                </div>
                <div class="permission">
                    <div class="row">
                        <div class="col-md-2 moduleName">
                            Reports
                        </div>
                        <div class="col-md-2">
                            <p class="modulefun <?php if (strpos($user['role'], 'report_view') !== false) echo 'permissionactive'; ?>" data-value="report_view">View</p>
                        </div>
                    </div>
                </div>
                <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Products
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'product_view') !== false) echo 'permissionactive'; ?>" data-value="product_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'product_create') !== false) echo 'permissionactive'; ?>" data-value="product_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'product_update') !== false) echo 'permissionactive'; ?>" data-value="product_update">Update</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'product_delete') !== false) echo 'permissionactive'; ?>" data-value="product_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Stock Adjustment
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'stock_view') !== false) echo 'permissionactive'; ?>" data-value="stock_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'stock_create') !== false) echo 'permissionactive'; ?>" data-value="stock_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'stock_update') !== false) echo 'permissionactive'; ?>"data-value="stock_update">Update</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'stock_delete') !== false) echo 'permissionactive'; ?>" data-value="stock_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Stock Valuation
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'sv_view') !== false) echo 'permissionactive'; ?>" data-value="sv_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'sv_create') !== false) echo 'permissionactive'; ?>" data-value="sv_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'sv_update') !== false) echo 'permissionactive'; ?>" data-value="sv_update">Update</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun <?php if (strpos($user['role'], 'sv_delete') !== false) echo 'permissionactive'; ?>" data-value="sv_delete">Delete</p>
                </div>
            </div>
            </div>
        </div>

        <!-- Hidden input to capture clicked values -->
        <input type="hidden" name="ClickedValues" id="clicked_values" value="<?php echo $user['role']; ?>">
        
        <input type="submit" class="btn btn-danger mt-3" name="update" value="Update"/>

    </form>
</section>

<!-- JavaScript to handle permission clicks -->
<script>
$(document).ready(function() {
    let clickedValues = "<?php echo $user['role']; ?>".split(','); // Array to store clicked data-values initially

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

</body>
</html>