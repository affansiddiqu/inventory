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
                    <!-- <i class="fa-solid fa-arrow-down mt-5" name="addrow" id="addrow"></i> -->
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
<script>
    $(document).ready(function() {
        // Initialize Select2 for product dropdowns
        $('.product-dropdown').select2({
            placeholder: "Select a product",
            ajax: {
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        query: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.Id,
                                text: item.Name
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Handle product selection
        $(document).on('change', '.product-dropdown', function() {
            var selectedProductId = $(this).val();
            var parent = $(this).closest('.column');

            if (selectedProductId) {
                $.ajax({
                    url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                    method: "post",
                    data: { product_id: selectedProductId },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            parent.find('.costInput').val(data.Sales_Price);
                            parent.find('.pid').val(data.Id);
                            parent.find('.pname').val(data.Name); // Update the hidden pname field
                            parent.find('.pname_display').val(data.Name); // Update the pname_display field
                        } else {
                            parent.find('.costInput').val('');
                            parent.find('.pid').val('');
                            parent.find('.pname').val(''); // Clear the hidden pname field if no product is selected
                            parent.find('.pname_display').val(''); // Clear the pname_display field if no product is selected
                        }
                    }
                });
            } else {
                parent.find('.costInput').val('');
                parent.find('.pid').val('');
                parent.find('.pname').val(''); // Clear the hidden pname field if no product is selected
                parent.find('.pname_display').val(''); // Clear the pname_display field if no product is selected
            }
        });

        // Function to calculate and update total amount
        function updateTotalAmount() {
            var totalAmount = 0;
            $('.amountInput').each(function() {
                var amount = parseFloat($(this).val());
                if (!isNaN(amount)) {
                    totalAmount += amount;
                }
            });
            $('#AmountInput').val(totalAmount); // Update the total amount input
        }

        // Event handler for amount input change
        $(document).on('input', '.amountInput', function() {
            updateTotalAmount();
        });

        // Event handler for quantity or cost input change
        $(document).on('input', '.quantityInput, .costInput', function() {
            var row = $(this).closest('.column');
            var quantity = parseFloat(row.find('.quantityInput').val());
            var cost = parseFloat(row.find('.costInput').val());
            if (!isNaN(quantity) && !isNaN(cost)) {
                var amount = quantity * cost;
                row.find('.amountInput').val(amount);
                updateTotalAmount();
            }
        });

        // Add new row
        $('#addrow').click(function() {
            var newrow = `<div class="row mb-3">
                <div class="column">
                    <select class="form-control product-dropdown" name="products[]" required>
                        <option></option>
                    </select>
                    <input type="hidden" class="pid" name="pid[]" />
                    <input type="hidden" class="pname" name="pname[]" />
                </div>
                <div class="column">
                    <input type="number" step="0.01" class="form-control quantityInput" name="quantity[]" required />
                </div>
                <div class="column">
                    <input type="number" step="0.01" class="form-control costInput" name="cost[]" required />
                </div>
                <div class="column">
                    <input type="number" step="0.01" class="form-control amountInput" name="amount[]" readonly />
                </div>
                <div class="column">
                    <button type="button" class="btn btn-danger removerow">Remove</button>
                </div>
            </div>`;

            $('#productrows').append(newrow);

            // Initialize Select2 for the newly added product dropdown
            $('#productrows .product-dropdown:last').select2({
                placeholder: "Select a product",
                ajax: {
                    url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                    type: "POST",
                    dataType: "json",
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.Id,
                                    text: item.Name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        // Remove row
        $(document).on('click', '.removerow', function() {
            $(this).closest('.row').remove();
            updateTotalAmount();
        });

    });
</script>
