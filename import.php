<?php
require('config.php');

if(isset($_FILES['file']['name'])){
    $filename = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 0) {
        $file = fopen($filename, "r");
        fgetcsv($file); // Skip header row
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            $sql = "INSERT INTO products (Code, Name, Measurement,Category, Sales_Price, Purchase_Price) 
                    VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."')";
            mysqli_query($connect, $sql);
        }
        fclose($file);
    }
    header("Location: product.php"); // Redirect back to dashboard
    if(mysqli_query($connect, $sql)){
        echo "<script> alert('Records inserted successfully')/script>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
    }
    
}
?>