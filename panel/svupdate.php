<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

$stock_Id = $_GET['Id']; 

$query = "select * from `svaluation` where Id = '{$stock_Id}'";

$results = mysqli_query($connect , $query);
if(!$results){
    die("query fail");
}

if (mysqli_num_rows($results) > 0 ) {
    while($row = mysqli_fetch_assoc($results)) {
     
        // if (isset($_POST["query"])) {
        //     $output = array();
        //     $query = "SELECT * FROM products WHERE Name LIKE '%" . $_POST["query"] . "%'";
        //     $res = mysqli_query($connect, $query);
        //     if (mysqli_num_rows($res) > 0) {
        //         while ($row = mysqli_fetch_assoc($res)) {
        //             $output[] = $row;
        //         }
        //         echo json_encode($output);
        //     } else {
        //         echo json_encode([]);
        //     }
        //     exit;
        // }
        // if (isset($_POST["product_id"])) {
        //     $product_id = $_POST["product_id"];
        //     $query = "SELECT * FROM products WHERE Id = $product_id";
        //     $res = mysqli_query($connect, $query);
        //     if (mysqli_num_rows($res) > 0) {
        //         $product = mysqli_fetch_assoc($res);
        //         echo json_encode($product);
        //     } else {
        //         echo json_encode([]);
        //     }
        //     exit;
        // }
                        
        require('index.php'); // Assuming this file contains database connection code
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
        <header>Updtae Stock Valuation</header>
        <!-- Form -->
        <form action="svupdatedata.php" class="form" id="stockForm" method="post">
            <div class="column">
            <div class="text-box">
                    <label for="" class="form-label"></label>
    <input type="hidden"  name="Id" class="form-control" value="<?php echo $row['Id']?>">
    </div>
    </div>
  <div class="column">
                <div class="input-box">
                    <label for="text">Customer</label><br>
                    <input type="text" name="customer" class="border border-dark text-dark" value=<?php echo $row['Customer'] ?> required />
                </div>
                <div class="input-box">
                    <label>Number</label><br>
                    <input readonly name="number" class="border border-dark text-dark"value=<?php echo $row['Vcode'] ?> required />
                </div>
                <div class="input-box">
                    <label>Current Date</label><br>
                    <input type="date" name="date" class="border border-dark text-dark" value=<?php echo $row['Date'] ?> required />
                </div>
                <div class="input-box">
                    <label>Reference</label><br>
                    <input type="text" name="reference" class="border border-dark text-dark" value=<?php echo $row['Vreference'] ?> required />
                </div>
            </div>
            <br>
            <div class="column">
                <div class="input-box">
                    <label>Product Name</label>
                    <input name="queryq" class="border border-dark text-dark" required value="<?php echo $row['Pname']; ?>">
                </div>
                <div class="input-box">
                    <label for="costInput">Cost</label><br>
                    <input type="number" name="cost" id="costInput" required class="costInput text-dark border border-dark" value=<?php echo $row['Vcost'] ?> />
                </div>
                <div class="input-box">
                    <label>Stock Quantity</label><br>
                    <input type="number" name="quantity" id="quantity" required class="quantityInput text-dark border border-dark" value=<?php echo $row['Vquantity'] ?> />
                </div>
                <div class="input-box">
                    <label>Net Amount</label><br>
                    <input type="number" name="amount" id="netAmount" required class="amountInput text-dark border border-dark" value="<?php echo $row['vamount'] ?>"/>
                </div>
                <div class="input-box">
                    <input type="hidden" name="pid" required class="pid" />
                </div>
                <!-- <i class="fa-solid fa-arrow-down mt-5" name="addrow" id="addrow"></i> -->
            </div>
            <div id="next"></div>
            <div class="column">
                <div class="input-box">
                    <label for="text">Shipping Address</label><br>
                    <input class="form-control border border-dark text-dark" name="address" rows="4" value=<?php echo $row['Address'] ?>></i>
                </div>
                <div class="input-box">
                    <label>Comments</label><br>
                    <input class="form-control border border-dark text-dark" name="comment" rows="4" value=<?php echo $row['Comment'] ?>></input>
                </div>
            </div>
            <input type="submit" name="submit" value="Update Details" class="mt-4 btn btn-danger">
        </form>
        <?php
    }
}
    ?>
    </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- updated jQuery CDN link -->

    <script>
    $(document).ready(function (){
        $('#country').keyup(function (){
            var query = $(this).val();

            if(query != ''){
                $.ajax({
                    url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                    method: "post",
                    data: {query: query},
                    dataType: 'json',
                    success: function(data){
                        $('#countryList').fadeIn();
                        $('#countryList').html('');
                        if(data.hasOwnProperty('error')) {
                            $('#countryList').append('<li>' + data.error + '</li>');
                        } else {
                            $.each(data, function(index, value) {
                                $('#countryList').append('<li class="list-item">' + value.Name + '</li>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#countryList').html('<li>' + xhr.responseJSON.error + '</li>');
                    }
                });
            }
            else{
                $('#countryList').fadeOut();
            }
        });

        $(document).on('click', '.list-item', function(){
            var selectedProduct = $(this).text();
            $('#country').val(selectedProduct);
            $('#countryList').fadeOut();

            // Fetch the product code of the selected product from the server
            $.ajax({
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                method: "post",
                data: {query: selectedProduct},
                dataType: 'json',
                success: function(data){
                    $('#country').val(data[0].Name);
                    $('#costInput').val(data[0].Sales_Price);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#quantity').keyup(function (){
            var quantity = $(this).val();
            var cost = $('#costInput').val();
            $('#netAmount').val(quantity * cost);
        });
    });

    </script>
        
    </body>
    </html>
    <!-- product name me product name pora nh arha  -->