
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
    for ($i = 0; $i < count($_POST['pid']); $i++) {
        $name = $_POST['pid'][$i];
        $price = $_POST['cost'][$i];
        $quantitys = $_POST['quantity'][$i];
        $amounts = $_POST['amount'][$i];

        // Use the same $sid for each product being added
        $query = "INSERT INTO `pro` (`sid`, `cod`, `Name`, `price`, `quantity`, `amount`) VALUES ('$sid', '$newCode', '$name', '$price', '$quantitys', '$amounts')";
        mysqli_query($connect, $query); // Execute the query to insert data into `pro` table
    }

    // Redirect to stockvaluation.php after data insertion
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
                            <option value="<?php echo $row['cusid']?>" ><?php echo  $row['Customer']?> </option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
                    }
                    ?>
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
            <input type="submit" class="btn btn-danger mt-3" name="submit" />
        </form>
    </section>

    <script>
        $(document).ready(function () {
            let productData = [];

            $(".product-dropdown").select2({
                ajax: {
                    url: "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>",
                    type: "POST",
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function (data) {
                        productData = data;
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.Id,
                                    text: item.Name,
                                    price: item.Price
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            $(document).on('change', '.product-dropdown', function () {
                let productId = $(this).val();
                let product = productData.find(item => item.Id == productId);

                let row = $(this).closest('.column');
                row.find('.pname').val(product.Name);
                row.find('.costInput').val(product.Price);
                row.find('.quantityInput').val('');
                row.find('.amountInput').val('');
                updateTotals();
            });
            $(document).on('input', '.quantityInput, .costInput', function() {
                var row = $(this).closest('.column');
                var quantity = row.find('.quantityInput').val();
                var cost = row.find('.costInput').val();
                var amount = (quantity * cost);
                row.find('.amountInput').val(amount);
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

            $(document).on('input', '.quantityInput, .costInput', function () {
                let row = $(this).closest('.column');
                let cost = parseFloat(row.find('.costInput').val());
                let quantity = parseFloat(row.find('.quantityInput').val());
                let amount = cost * quantity;
                row.find('.amountInput').val(amount.toFixed(2));
                updateTotals();
            });

            function updateTotals() {
                let totalQuantity = 0;
                let totalAmount = 0;
                $('.quantityInput').each(function () {
                    totalQuantity += parseFloat($(this).val()) || 0;
                });
                $('.amountInput').each(function () {
                    totalAmount += parseFloat($(this).val()) || 0;
                });
                $('#totalQuantity').val(totalQuantity.toFixed(2));
                $('#AmountInput').val(totalAmount.toFixed(2));
            }

            $("#addrow").click(function () {
                var newRow = `<div class="column">
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
                </div>`;
                $("#next").append(newRow);
                $(".product-dropdown").select2({
                    ajax: {
                        url: "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>",
                        type: "POST",
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                query: params.term
                            };
                        },
                        processResults: function (data) {
                            productData = data;
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.Id,
                                        text: item.Name,
                                        price: item.Price
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        });
    </script>
</body>
</html>
