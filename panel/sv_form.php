<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

// Fetch the maximum SKU code
$query = "SELECT MAX(SUBSTRING(`VCode`, 4)) AS max_code FROM `svaluation`";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$maxCode = $row['max_code'];
$newCode = 'SD-' . str_pad($maxCode + 1, 5, '0', STR_PAD_LEFT);


if (isset($_POST['submit'])) {
    // Gather form data
    $customerId = $_POST['cid'];
    $date = $_POST['date'];
    $reference = $_POST['reference'];
    $address = $_POST['address'];
    $comment = $_POST['comment'];
    $cost = $_POST['cost'];
    $quantity = $_POST['tquantity'];
    $amount = $_POST['AmountInput'];

    // Insert data into the `svaluation` table
    $query = "INSERT INTO `svaluation` (`VCode`, `Cid`, `Date`, `Vreference`, `Vquantity`, `vamount`, `Address`, `Comment`) VALUES ('$newCode', '$customerId','$date', '$reference', '$quantity','$amount', '$address', '$comment')";
    mysqli_query($connect, $query);

    // Get the ID of the inserted row in `svaluation` table
    $sid = mysqli_insert_id($connect);

    // Insert data into the `pro` table
    for ($i = 0; $i < count($_POST['query']); $i++) {
        $name = $_POST['pid'][$i];
        $price = $_POST['cost'][$i];
        $quantitys = $_POST['quantity'][$i];
        $amounts = $_POST['amount'][$i];

        // Use the same $sid for each product being added
        $query = "INSERT INTO `pro` (`sid`, `cod`, `Name`, `price`, `quantity`, `amount`) VALUES ('$sid', '$newCode', '$name', '$price', '$quantitys', '$amounts')";
        mysqli_query($connect, $query); // Execute the query to insert data into `pro` table
    }

    // Redirect to svaluation.php after data insertion
    header("Location: stockvaluation.php");
    exit();
}


if (isset($_POST["query"])) {
    $output = array();
    $query = "SELECT * FROM products WHERE Name LIKE '%" . $_POST["query"] . "%'";
    $res = mysqli_query($connect, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {
        echo json_encode([]);
    }
    exit;
}

if (isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];
    $query = "SELECT * FROM products WHERE Id = $product_id";
    $res = mysqli_query($connect, $query);
    if (mysqli_num_rows($res) > 0) {
        $product = mysqli_fetch_assoc($res);
        echo json_encode($product);
    } else {
        echo json_encode([]);
    }
    exit;
}

require('index.php'); // Assuming this file contains necessary dashboard functions
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
        <header>Stock Valuation</header>
        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" id="stockForm" method="post">
            <div class="column">
                <div class="input-box mt-4">
                    <?php 
                    $product = "SELECT * from `customer`  where`status` ='1'";
                    $result1 = mysqli_query($connect, $product);
                    if(mysqli_num_rows($result1) > 0) {
                        ?>
                        <select class="form-select border-dark" name="cid" aria-label="Default select example" id="sname">
            <option selected>Select Customer</option>
            <?php
            while($row = mysqli_fetch_assoc($result1)){
            ?>
            <option value="<?php echo $row['Id']?>" ><?php echo  $row['Customer']?> </option>
            <?php
            }
            }
            ?>
        </select>
    </div>
     
                <div class="input-box">
                    <label>Number</label><br>
                    <input readonly name="number" class="border border-dark text-dark" value="<?php echo $newCode; ?>" required />
                </div>
                <div class="input-box">
                    <label>Current Date</label><br>
                    <input type="date" name="date" class="border border-dark text-dark" required />
                    </div>
                    <div class="input-box">
                        <label>Reference</label><br>
                        <input type="text" name="reference" class="border border-dark text-dark" required />
                        </div>
                        </div>
            <br>
            <div class="column">
                <div class="input-box mt-3">
                    <label>Product Name</label><br>
                    <select name="query[]" class="product-dropdown border border-dark" required>
                        <option>Select a product</option>
                    </select>
                </div>
                <input type="hidden" name="pid[]" class="pname" required />
                <div class="input-box">
                    <label for="costInput">Cost</label><br>
                    <input type="number" name="cost[]" id="costInput" required class="costInput text-dark border border-dark" />
                    </div>
                    <div class="input-box">
                    <label>Stock Quantity</label><br>
                    <input type="number" name="quantity[]" id="quantity" required class="quantityInput text-dark border border-dark" />
                </div>
             
                <div class="input-box">
                    <label>Net Amount</label><br>
                    <input type="number" name="amount[]" id="netAmount" required class="amountInput text-dark border border-dark" />
                </div>
                <i class="fa-solid fa-arrow-down mt-5" name="addrow" id="addrow"></i>
            </div>
            <div id="next"></div>

            <div class="column mt-2">
                <div class="input-box">
                    <label>Total Quantity</label><br>
                <input type="text" name="tquantity" id="totalQuantity" class="text-dark border border-dark" readonly />
            </div>        
        <div class="input-box">
            <label>Total Amount</label><br>
        <input type="text" name="AmountInput" id="AmountInput" class="text-dark border border-dark" readonly />
    </div>
</div>
            <div class="column mt-2">
                <div class="input-box">
                    <label for="text">Shipping Address</label><br>
                    <textarea class="form-control border border-dark text-dark" name="address" rows="4"></textarea>
                </div>
                <div class="input-box">
                    <label>Comments</label><br>
                    <textarea class="form-control border border-dark text-dark" name="comment" rows="4"></textarea>
                </div>
            </div>
            <input type="submit" name="submit" value="Submit" class="mt-4 btn btn-danger">
        </form>
    </section>
    <script>
                $(document).ready(function() {
            // Function to calculate and update total quantity
            function updateTotalQuantity() {
                var totalQuantity = 0;
                $('.quantityInput').each(function() {
                    var quantity = parseInt($(this).val());
                    if (!isNaN(quantity)) {
                        totalQuantity += quantity;
                    }
                });
                $('#totalQuantity').val(totalQuantity);
            }

            // Event handler for quantity input change
            $(document).on('input', '.quantityInput', function() {
                updateTotalQuantity();
            });

            // Add new row
            $('#addrow').click(function() {
                // Your code to add a new row
                // Remember to call updateTotalQuantity() after adding the row
            });
        });
            

        $(document).ready(function() {
            // Initialize Select2
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
                            if(data) {
                                parent.find('.costInput').val(data.Sales_Price);
                                parent.find('.pid').val(data.Id);
                            } else {
                                parent.find('.costInput').val('');
                                parent.find('.pid').val('');
                            }
                        }
                    });
                } else {
                    parent.find('.costInput').val('');
                    parent.find('.pid').val('');
                }
            });

            // Calculate amount on quantity or cost input
            $(document).on('input', '.quantityInput, .costInput', function() {
                var row = $(this).closest('.column');
                var quantity = row.find('.quantityInput').val();
                var cost = row.find('.costInput').val();
                var amount = (quantity * cost);
                row.find('.amountInput').val(amount);
            });

            // Add new row
            $('#addrow').click(function() {
                var newrow = `<div class="column">
                    <div class="input-box mt-3">
                        <select name="query[]" class="product-dropdown border border-dark text-dark" required>
                            <option>Select a product</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <input type="number" name="cost[]" class="costInput text-dark border border-dark" required />
                    </div>
                    <div class="input-box">
                        <input type="number" name="quantity[]" class="quantityInput text-dark border border-dark" required />
                    </div>
                    <div class="input-box">
                        <input type="number" name="amount[]" class="amountInput text-dark border border-dark" required />
                    </div>
                    <input type="hidden" name="pid[]" class="pid" required />
                    <i class="fa-solid fa-xmark btnremove mt-4"></i>
                </div>`;

                // Get adjustment type and date from the first row

                $('#next').append(newrow);

                // Initialize Select2 on the new dropdown
                $('#next').find('.product-dropdown:last').select2({
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

            $('body').on('click', '.btnremove', function() {
                $(this).closest('div.column').remove();
            });
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
                    parent.find('.pname').val(data.Name); // Update the product name field
                } else {
                    parent.find('.costInput').val('');
                    parent.find('.pid').val('');
                    parent.find('.pname').val(''); // Clear the product name field if no product is selected
                }
            }
        });
    } else {
        parent.find('.costInput').val('');
        parent.find('.pid').val('');
        parent.find('.pname').val(''); // Clear the product name field if no product is selected
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
$(document).ready(function() {
    // Function to calculate and update total amount
    function updateTotalAmount() {
        var totalAmount = 0;
        $('.amountInput').each(function() {
            var amount = parseFloat($(this).val());
            if (!isNaN(amount)) {
                totalAmount += amount;
            }
        });
        $('#AmountInput').val(totalAmount); 
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
        // Your code to add a new row
        // Remember to call updateTotalAmount() after adding the row
    });

    // Other JavaScript code
});

    </script>
</body>
</html>