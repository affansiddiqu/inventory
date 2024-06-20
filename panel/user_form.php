<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code
require('index.php'); // Assuming this file contains necessary dashboard functions

if (isset($_POST['submit'])) {
    // Gather form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $upass = $_POST['pass'];
    $role = $_POST['role'];

    // Insert data into the `svaluation` table
    $query = "INSERT INTO `users` (`Uname`,`lname`,`email`,`Upass`, `role`) VALUES ('$fname', '$lname' ,'$email','$upass','$role')";
    $final = mysqli_query($connect, $query);

    if ($final) {
        echo "<script>alert('Add User successful');</script>";
        exit(); // Ensure that script stops here to prevent further execution
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
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
        <header>Add User</header>
        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" id="stockForm" method="post">
            <div class="column">
                <div class="input-box">
                    <label>First Name</label><br>
                    <input name="fname" class="border border-dark text-dark" required />
                </div>
                <div class="input-box">
                    <label>Last Name</label><br>
                    <input name="lname" class="border border-dark text-dark" required />
                </div>
                <div class="input-box">
                    <label>Email</label><br>
                    <input type="email" name="email" class="border border-dark text-dark" required />
                </div>
                <div class="input-box">
                    <label>Password</label><br>
                    <input type="password" name="pass" class="border border-dark text-dark" required />
                </div>
                </div>
                <div class="input-box">
                    <?php require('per.php') ?>
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
            // row add kre tw jase add krne ka arrow arha wase hi close krne ke liye cut ka

            $("#addrow").click(function () {
                var newRow = `<div class="column product-row">
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
                                <div class="col-auto mt-5">
                <i class="fa-solid fa-cut remove-row mt-1"></i>
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
            $(document).on('click', '.remove-row', function () {
        $(this).closest('.product-row').remove();
    });

        });
    </script>
</body>
</html>
