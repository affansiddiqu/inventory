<?php
require('config.php');

// Function to fetch data of a specific row by ID
function getRowData($connect, $id) {
    $query = "SELECT * FROM `svaluation` WHERE `ID` = '$id'";
    $result = mysqli_query($connect, $query);
    return mysqli_fetch_assoc($result);
}

// Check if form is submitted for update
if (isset($_POST['submit'])) {
    $id = $_POST['id']; // Get the ID of the row to update

    // Get the updated values from the form
    $pid = $_POST['pid'];
    $date = $_POST['date'];
    $reference = $_POST['reference'];
    $Cid = $_POST['cid'];
    $productNames = implode(", ", $_POST['query']);
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $address = $_POST['address'];
    $comment = $_POST['comment'];

    // Update the row in the database
    $updateQuery = "UPDATE `svaluation` SET `P_id` = '$pid', `Date` = '$date', `Vreference` = '$reference', `Cid` = '$Cid', `pname` = '$productNames', `Vquantity` = '$quantity', `vamount` = '$amount', `Address` = '$address', `Comment` = '$comment' WHERE `ID` = '$id'";
    $result = mysqli_query($connect, $updateQuery);
    if ($result) {
        echo "<script>alert('Row updated successfully');</script>";
        header("location:stockvaluation.php");
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}

// Check if ID is provided for updating
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch data of the selected row
    $rowData = getRowData($connect, $id);
} else {
    // Handle error if ID is not provided
    echo "<script>alert('Row ID not provided');</script>";
}

// Rest of your HTML and form code goes here
?>
