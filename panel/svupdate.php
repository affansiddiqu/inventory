<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code
require('index.php'); // Assuming this file contains database connection code

if(isset($_GET['Id'])) {
    $id = $_GET['Id'];
    
    // Fetch data from the svaluation table based on the ID
    $query = "SELECT * FROM `svaluation` WHERE `Id` = '$id'";
    $result = mysqli_query($connect, $query);
    $svaluation_row = mysqli_fetch_assoc($result);
    
    // Fetch data from the pro table based on the ID
    $pro_query = "SELECT * FROM `pro` WHERE `sid` = '$id'";
    $pro_result = mysqli_query($connect, $pro_query);
    $pro_rows = mysqli_fetch_all($pro_result, MYSQLI_ASSOC);
    
    // Check if data exists for the given ID in the svaluation table
    if($svaluation_row) {
        // Data found, pre-fill form fields with fetched data
        $cod = $svaluation_row['Vcode'];
        $customerId = $svaluation_row['Cid'];
        $date = $svaluation_row['Date'];
        $reference = $svaluation_row['Vreference'];
        $address = $svaluation_row['Address'];
        $comment = $svaluation_row['Comment'];
        $quantity = $svaluation_row['Vquantity'];
        $amount = $svaluation_row['vamount'];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <section class="container">
        <header>Update Stock Valuation</header>

        <!-- Form -->
        <form action="svupdatedata.php" class="form" id="stockForm" method="post">
            <input type="hidden" name="Id" value="<?php echo $id; ?>">
            
            <div class="row">
                <div class="col-md-3 mt-3">
                    <?php 
                    $customerQuery = "SELECT * FROM `customer` WHERE `status` ='1'";
                    $customerResult = mysqli_query($connect, $customerQuery);
                    if(mysqli_num_rows($customerResult) > 0) {
                    ?>
                    <select class="form-select border-dark" name="cid" aria-label="Default select example" id="customerId">
                        <option>Select Customer</option>
                        <?php
                        while($row = mysqli_fetch_assoc($customerResult)){
                            $cusId = $row['cusid'];
                            $cusName = $row['Customer'];
                        ?>
                        <option value="<?php echo $cusId; ?>" <?php if($cusId == $customerId) echo "selected"; ?>><?php echo $cusName; ?> </option>
                        <?php
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Number</label><br>
                    <input readonly name="number" class="border border-dark text-dark" value="<?php echo $cod; ?>" required />
                </div>
                <div class="col-md-3">
                    <label>Current Date</label><br>
                    <input type="date" name="date" class="border border-dark text-dark" value="<?php echo $date;?>" required />
                </div>
                <div class="col-md-3">
                    <label>Reference</label><br>
                    <input type="text" name="reference" class="border border-dark text-dark" value="<?php echo $reference; ?>" required />
                </div>
            </div>

            <?php foreach($pro_rows as $pro_row): ?>
            <div class="row mt-4">
                <div class="col-md-3 mt-3">
                    <select class="form-select border-dark product-select" name="productName[]" aria-label="Default select example">
                        <option>Select Product</option>
                        <?php
                        $productQuery = "SELECT * FROM `products` WHERE `status` ='1'";
                        $productResult = mysqli_query($connect, $productQuery);
                        if(mysqli_num_rows($productResult) > 0) {
                            while($row = mysqli_fetch_assoc($productResult)){
                                $pId = $row['Id'];
                                $pName = $row['Name'];
                        ?>
                        <option value="<?php echo $pId; ?>" <?php if($pName == $pro_row['Name']) echo "selected"; ?>><?php echo $pName; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Price</label><br>
                    <input type="text" name="price[]" value="<?php echo $pro_row['price']; ?>" class="border border-dark text-dark" required />
                </div>
                <div class="col-md-3">
                    <label>Quantity</label><br>
                    <input type="text" name="pro_quantity[]" value="<?php echo $pro_row['quantity']; ?>" class="border border-dark text-dark" required />
                </div>
                <div class="col-md-3">
                    <label>Amount</label><br>
                    <input type="text" name="pro_amount[]" value="<?php echo $pro_row['amount']; ?>" class="border border-dark text-dark" required />
                </div>
            </div>
            <?php endforeach; ?>

            <div id="next"></div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <label>Total Quantity</label><br>
                    <input type="text" name="tquantity" value="<?php echo $quantity; ?>" id="totalQuantity" class="border border-dark text-dark" />
                </div>        
                <div class="col-md-6">
                    <label>Total Amount</label><br>
                    <input type="text" name="AmountInput" id="AmountInput" value="<?php echo $amount; ?>" class="border border-dark text-dark" />
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <label>Shipping Address</label><br>
                    <textarea class="form-control border border-dark text-dark" name="address" rows="4"><?php echo $address; ?></textarea>
                </div>
                <div class="col-md-6">
                    <label>Comments</label><br>
                    <textarea class="form-control border border-dark text-dark" name="comment" rows="4"><?php echo $comment; ?></textarea>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <input type="submit" name="update" value="Update Details" class="btn btn-danger">
                </div>
            </div>
        </form>
    </section>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.form-select').select2();

            // Change event for Customer select to update Product select
            $('#customerId').change(function() {
                var customerId = $(this).val();
                $.ajax({
                    url: 'getProducts.php', // PHP script to fetch products based on customer ID
                    method: 'POST',
                    data: { customerId: customerId },
                    dataType: 'json',
                    success: function(response) {
                        // Clear existing options
                        $('.product-select').html('<option>Select Product</option>');
                        // Append fetched products
                        response.forEach(function(product) {
                            $('.product-select').append('<option value="' + product.productId + '">' + product.productName + ' (' + product.productId + ')</option>');
                        });
                        // Trigger change to initialize Select2 again
                        $('.product-select').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching products:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
    } else {
        // Data not found for the given ID
        echo "No data found.";
    }
}
?>
    