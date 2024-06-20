<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

if(isset($_POST['update'])) {
    // Gather form data
    $id = $_POST['Id'];
    $customerId = $_POST['cid'];
    $date = $_POST['date'];
    $reference = $_POST['reference'];
    $address = $_POST['address'];
    $comment = $_POST['comment'];
    $quantity = $_POST['tquantity'];
    $amount = $_POST['AmountInput'];

    // Update data in the svaluation table
    $svaluation_query = "UPDATE `svaluation` SET `Cid`='$customerId', `Date`='$date', `Vreference`='$reference', `Address`='$address', `Comment`='$comment', `Vquantity`='$quantity', `vamount`='$amount' WHERE `Id`='$id'";
    $svaluation_result = mysqli_query($connect, $svaluation_query);

    // Check if update was successful
    if(!$svaluation_result) {
        echo "Error updating svaluation data: " . mysqli_error($connect);
        exit(); // Exit if there is an error
    }

    // Update data in the pro table
    for($i = 0; $i < count($_POST['productName']); $i++) {
        $productName = $_POST['productName'][$i];
        $price = $_POST['price'][$i];
        $pro_quantity = $_POST['pro_quantity'][$i];
        $pro_amount = $_POST['pro_amount'][$i];

        // Update data in the pro table based on product ID
        $pro_update_query = "UPDATE `pro` SET `Name`='$productName', `price`='$price', `quantity`='$pro_quantity', `amount`='$pro_amount' WHERE `sid`='$id'";
        $pro_update_result = mysqli_query($connect, $pro_update_query);

        // Check if update was successful
        if(!$pro_update_result) {
            echo "Error updating pro data: " . mysqli_error($connect);
            exit(); // Exit if there is an error
        }
    }
    header("Location: stockvaluation.php");


    echo "Data updated successfully!";
}
?>
