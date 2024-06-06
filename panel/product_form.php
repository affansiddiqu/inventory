<?php

require('config.php');
require('index.php');

$query = "SELECT MAX(SUBSTRING(`Code`, 3)) AS max_code FROM `products`";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$maxCode = $row['max_code'];

// Increment the SKU code
$newCode = 'P-' . str_pad($maxCode + 1, 5, '0', STR_PAD_LEFT);


if(isset($_POST['submit'])){ 
    // Retrieve form data for the product
    
    $Name = $_POST['Name'];
    $Measure = $_POST['Measure'];
    $Category = $_POST['Category'];
    $Sprice = $_POST['Sprice'];
    $Pprice = $_POST['Pprice'];

    // // Insert the product data into the database
    $insertProduct = "INSERT INTO `products` (`Name`, `Measurement`, `Category`, `Sales_Price`, `Purchase_Price`)VALUES ('$Name', '$Measure', '$Category', '$Sprice', '$Pprice')";

    // $data = mysqli_query($connect , $insertProduct);
    $resultProduct = mysqli_query($connect, $insertProduct);
    if (!$resultProduct) {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    } else {
        echo "<script>alert('Add Product successful');</script>";
        
        // if ($data) {
            //     echo "<script> alert('Add Product successfully')/script>";
            // }else{
                //     echo "<script> alert('Add Product Failed')/script>";        
            }
        }
        // header('location: Product.php');
        ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/ccb21b5b72.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <section class="container">
        <header>Add Products</header>

        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
            <div class="column">
                <div class="input-box">
                    <label>Product SKU Code</label>
                    <input readonly name="code" value="<?php echo $newCode ?>" required />
                </div>

                <div class="input-box">
                    <label>Product Name</label>
                    <input type="text" name="Name" required/>
                </div>

                <div class="input-box mt-3">
                    <label for="text">Product Unit</label>
                    <select class="form-select form-select-sm"  name ="Measure">
                    <option value="Pc">Pc</option>
                    <option value="Kg">Kg</option>
                </select>
                </div>
            </div>
            <br>
            
            <div class="column">
                <div class="input-box mt-3">
                    <label for="text">Product Category</label>
                    <select class="form-select form-select-sm"  name ="Category">
                    <option value="Tshirt">Tshirt</option>
                    <option value="Polo">Polo</option>
                    <option value="Hoodies">Hoodies</option>
                    <option value="Sweatshirt">Sweatshirt</option>
                    <option value="Raw Material">Raw Material</option>
                </select>
                </div> 

                <div class="input-box">
                    <label>Product Sale Price</label>
                    <input type="number" name="Sprice" required/>
                </div>
                
                <div class="input-box">
                    <label>Product Purchase Price</label>
                    <input type="number" name="Pprice" required />
                </div>
            </div>
            <input type="submit" name="submit" value="Submit" class="mt-4 btn btn-outline-danger ">
        </form>

</body>
</html>
