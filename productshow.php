<?php
require('config.php');
require('dashboard.php');

$fetch = "SELECT * FROM `products` WHERE status = 1";
$query = mysqli_query($connect , $fetch);
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

<!--Inventory_form-->
<!-- 
<section class="container">
    <div>
        <header>Products</header>
        <button type="button" onclick="location.href='product_form.php'" class="add_knittingcard_button" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add Product</button>
    </div>

<br>
<br>
<br>   
    <div>
        <button type="button" class="filter_button"><i class="fa fa-filter" aria-hidden="true"></i>Filter</button>
    </div>
</section> -->
    
<section class="container">
              
                <h5>Variants</h5>
                <!-- table -->
                <div class="row justify-content-right">

                <hr>
            <table class="table table-warning">
                <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                    <!-- <th scope="col"></th> -->
                    <th scope="col">Products_Code</th>
                    <th scope="col">Products_Variants</th>
                    <th scope="col">Products_Name</th>
                    <th scope="col">Units</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sales_price </th>
                    <th scope="col">Description </th>
                    <th scope="col">Products_Update</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) {
                     ?>
                    <tr>
                    <td><?php echo $row ['Product_Id']?></td>
                    <td><?php echo $row ['Variants']?></td>
                    <td><?php echo $row ['Name']?></td>
                    <td><?php echo $row ['Measurement']?></td>
                    <td><?php echo $row ['Category']?></td>
                    <td><?php echo $row ['Sales_Price']?></td>
                    <td><?php echo $row ['Description']?></td>
                    <td ><a href="adelete.php?Id=<?php echo $row ['Id'];?>" class="btn btn-dark">Update</a></td>  
                </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </section>
</body>
</html>