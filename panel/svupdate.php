<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

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

        require('index.php');
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

<h4>Update Stock Valuation</h4>


    <form action="svupdatedata.php" method="post">
        <!-- Input fields with pre-filled data -->
        <input type="hidden" name="Id" value="<?php echo $id; ?>">
        <div class="row">
    <div class="col-md-3 mt-3">
        <?php 
            $product = "SELECT * FROM `customer` WHERE `status` ='1'";
            $result1 = mysqli_query($connect, $product);
            if(mysqli_num_rows($result1) > 0) {
        ?>
        <select class="form-select border-dark" name="cid" aria-label="Default select example" id="sname">
            <option>Select Customer</option>
            <?php
                while($row = mysqli_fetch_assoc($result1)){
                    $customerId = $row['Id'];
                    $customerName = $row['Customer'];
            ?>
            <option value="<?php echo $customerId; ?>"><?php echo $customerName; ?> (<?php echo $customerId; ?>)</option>
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
                        </d>
            <br>
            <?php foreach($pro_rows as $pro_row): ?>
                <div class="row mt-4">
                    <div class="col-3">
                        <label for="">name</label>
                    <input type="text" name="productName[]" value="<?php echo $pro_row['Name']; ?>"><br>
                    </div>
                    <div class="col-3">
                        <label for="">price</label>
                    <input type="text" name="price[]" value="<?php echo $pro_row['price']; ?>"><br>
                    </div>
                    <div class="col-3">
                        <label for="">quantity</label>
                    <input type="text" name="pro_quantity[]" value="<?php echo $pro_row['quantity']; ?>"><br>
                    </div>
                    <div class="col-3">
                        
                        <label for="">amount</label>
                    <input type="text" name="pro_amount[]" value="<?php echo $pro_row['amount']; ?>"><br><br>
                    </div>
</div>
<?php endforeach; ?>
            <div id="next"></div>

            <div class="row">
                <div class="col-6">
                    <label>Total Quantity</label><br>
                <input type="text" name="tquantity" value="<?php echo $quantity;?>" id="totalQuantity" class="text-dark border border-dark" />
            </div>        
        <div class="col-6">
            <label>Total Amount</label><br>
        <input type="text" name="AmountInput" id="AmountInput" value="<?php echo $amount; ?>"class="text-dark border border-dark" />
    </div>
</div>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <label for="text">Shipping Address</label><br>
                    <textarea class="form-control border border-dark text-dark" value="<?php echo $address;?>" name="address" rows="4"></textarea>
                </div>
                <div class="col-lg-6">
                    <label>Comments</label><br>
                    <textarea class="form-control border border-dark text-dark" value="<?php echo $comment;?>" name="comment" rows="4"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <input type="submit" name="update" value="Update Details" class="mt-4 btn btn-danger">

                </div>
            </div>
        </form>

        </section>
</body>
</html>
<?php
    } else {
        // Data not found for the given ID in the svaluation table
        echo "Data not found!";
    }
}
?>
