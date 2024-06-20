<?php
include('config.php');

// Check if Id parameter is set in the GET request
if(isset($_GET['Id'])) {
    $user_id = $_GET['Id'];

    // Prepare DELETE query for pro table
    $del_pro = "DELETE FROM `pro` WHERE `sid` = '$user_id'";
    $result_pro = mysqli_query($connect, $del_pro);
    
    // Prepare DELETE query for svaluation table
    $del_svaluation = "DELETE FROM `svaluation` WHERE `Id` = '$user_id'";
    $result_svaluation = mysqli_query($connect, $del_svaluation);

    // Check if both deletion queries were successful
    if ($result_pro && $result_svaluation) {
        header('location: stockvaluation.php'); // Redirect to stockvaluation.php on success
    } else {
        echo "Error deleting record: " . mysqli_error($connect); // Output error message if deletion fails
    }
} else {
    echo "Invalid request"; // Output message if Id parameter is not set in the GET request
}
?>
