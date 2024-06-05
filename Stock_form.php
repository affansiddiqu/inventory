<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

// Fetch the maximum SKU code
$query = "SELECT MAX(SUBSTRING(`SCode`, 4)) AS max_code FROM `Stock`";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$maxCode = $row['max_code'];
$newCode = 'SA-' . str_pad($maxCode + 1, 5, '0', STR_PAD_LEFT);


if (isset($_POST['submit'])) {
    for ($i = 0; $i < count($_POST['query']); $i++) {
        $pid = $_POST['query'][$i];
        $type = $_POST['stock'][$i];
        $date = $_POST['date'][$i];
        $quantity = $_POST['quantity'][$i];
        $cost = $_POST['cost'][$i];
        $amount = $_POST['amount'][$i];

        if ($type !== '' && $date !== '' && $quantity !== '' && $cost !== '' && $amount !== '') {
            $insertProduct = "INSERT INTO `stock` (`P_id`, `Type`, `Date`, `Cost`, `Quantity`, `Amount`) VALUES ('$pid', '$type', '$date', '$cost', '$quantity', '$amount')";
            $resultProduct = mysqli_query($connect, $insertProduct);
            if ($resultProduct) {
                echo "<script>alert('Add Stock successful');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
            }
        } else {
            echo "<script>alert('All fields are required');</script>";
        }
    }
}

if(isset($_POST["query"])){
    $output = array();
    $query = "SELECT * FROM products WHERE Name LIKE '%".$_POST["query"]."%'";
    $res = mysqli_query($connect, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {
        header("location:stock.php");
    }
    exit;
}

require('dashboard.php'); // Assuming this file contains necessary dashboard functions
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
        <header>Add Stock</header>
        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
        
        <div class="input-box">
            <!-- <label>S no</label> -->
            <input readonly name="si[]" type="hidden" id="si" value="1"  required /> 
        </div>
        
        <div class="column">       
            <div class="input-box">
                <label>Stock SKU Code</label>
                <input readonly name="number" value="<?php echo $newCode ;?>" required /> 
            </div>
            
            <div class="input-box mt-3">
                <label for="text">Adjustment Stock</label>
                <select class="form-select form-select-sm" name="stock[]">
                    <option value="Opening Stock">Opening Stock</option>
                    <option value="Inward Stock">Inward Stock</option>
                    <option value="Lost of Theft">Lost of Theft</option>
                </select>
            </div>
            <div class="input-box">
                <label>Current Date</label>
                <input type="date" name="date[]" required/>
            </div>
            </div>
            <!-- pcode pname net quantity net amount  -->
            <br>
            
            <div class="column">
                <div class="input-box">
                    <label>Product Name</label>
                    <input type="text" id="country" name="query[]" class="product-search" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <ul id="countryList" class="list-unstyled "><!-- element to display search results --></ul>
                </div>
                
                <div class="input-box">
                    <label for="costInput">Cost of Stock</label>
                    <input type="number" name="cost[]" id="costInput" required class="costInput"/>
                </div>
                <div class="input-box">
                    <label>Stock Quantity</label>
                    <input type="text" name="quantity[]" id="quantity" required class="quantityInput">
                </div>
                <div class="input-box">
                    <label>Net Amount</label>
                    <input type="number" name="amount[]" id="netAmount" required class="amountInput"/>
                </div>
                <button type="button" name="addrow" id="addrow" ><font-awesome-icon icon="check" /> add row</button>
                <!-- <input name="addrow" id="addrow" value="add Row"  class="btn btn-danger" > -->
            </div>
        </div>
                <div id="next"></div>

            <input type="submit" name="submit" value="Submit" class="mt-4 btn btn-danger ">
            <!-- <input value="Addrow" name="addrow" id="addrow"> -->
            <!-- <div class="form-group submitButtonFooter">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button> -->
                    
                </form>
            </section>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- updated jQuery CDN link -->
            
            <script>
                $(document).ready(function() {
                    // Product search functionality
                    $(document).on('keyup', '.product-search', function() {
                        var query = $(this).val();
                        var currentInput = $(this);
                        var resultList = currentInput.parent().siblings('.list-item');
                        
                        if (query !== '') {
                            $.ajax({
                        url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                        method: "post",
                        data: {
                            query: query
                        },
                        dataType: 'json',
                        success: function(data) {
                            resultList.empty();
                            if (data.hasOwnProperty('error')) {
                                resultList.append('<li class="list-item">' + data.error + '</li>');
                            } else {
                                $.each(data, function(index, value) {
                                    resultList.append('<li class="list-item">' + value.Name + '</li>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            resultList.empty();
                            resultList.append('<li class="list-item">Error: ' + xhr.responseJSON.error + '</li>');
                        }
                    });
                } else {
                    resultList.empty();
                }
            });

            // Select product from search result
            $(document).on('click', '.list-item', function() {
                var selectedProduct = $(this).text();
                $(this).closest('.input-group').find('.product-search').val(selectedProduct);
                $(this).parent().empty();
            });
        });
    
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
                $('#country').val(data[0].Id);
                $('#costInput').val(data[0].Purchase_Price);
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
$('#addrow').click(function (){
    var length = $('.si').length; // Corrected spelling of 'length'
    var i = parseInt(length) + 1;
    var newrow = `
    <div class="column">
        <div class="input-box">
            <input type="text" name="query[]" class="form-control product-search" aria-describedby="emailHelp">
            <ul class="list-unstyled countryList"><!-- element to display search results --></ul>
        </div>

        <div class="input-box">
            <input type="number" name="cost[]" class="costInput" required/>
        </div>
        <div class="input-box">
            <input type="text" name="quantity[]" class="quantityInput" required class="form-control">
        </div>
        <div class="input-box">
            <input type="number" name="amount[]" class="amountInput" required readonly/>
        </div>
    </div>`;

    $('#next').append(newrow);
});

$(document).on('keyup', '.quantityInput', function (){
    var quantity = $(this).val();
    var cost = $(this).closest('.column').find('.costInput').val();
    var netAmount = quantity * cost;
    $(this).closest('.column').find('.amountInput').val(netAmount);
});

$(document).ready(function (){
    // Product search functionality
    $(document).on('keyup', '.product-search', function() {
        var query = $(this).val();
        var resultList = $(this).parent().siblings('.countryList');

        if (query !== '') {
            $.ajax({
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                method: "post",
                data: {query: query},
                dataType: 'json',
                success: function(data) {
                    resultList.empty();
                    if (data.hasOwnProperty('error')) {
                        resultList.append('<li class="list-item">' + data.error + '</li>');
                    } else {
                        $.each(data, function(index, value) {
                            resultList.append('<li class="list-item">' + value.Name + '</li>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    resultList.empty();
                    resultList.append('<li class="list-item">Error: ' + xhr.responseJSON.error + '</li>');
                }
            });
        } else {
            resultList.empty();
        }
    });

    // Select product from search result
    $(document).on('click', '.list-item', function() {
        var selectedProduct = $(this).text();
        $(this).closest('.input-box').find('.product-search').val(selectedProduct);
        $(this).parent().empty();
    });
});
$.ajax({
    url: "<?php echo $_SERVER['PHP_SELF']; ?>",
    method: "post",
    data: {query: query},
    dataType: 'json',
    success: function(data) {
        console.log(data); // Add this line to check the response data in the browser console
        resultList.empty();
        if (data.hasOwnProperty('error')) {
            resultList.append('<li class="list-item">' + data.error + '</li>');
        } else {
            $.each(data, function(index, value) {
                resultList.append('<li class="list-item">' + value.Name + '</li>');
            });
        }
    },
    error: function(xhr, status, error) {
        console.log(error); // Add this line to check for any errors in the AJAX request
        resultList.empty();
        resultList.append('<li class="list-item">Error: ' + xhr.responseJSON.error + '</li>');
    }
});

            </script>


</body>
</html>