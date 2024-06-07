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
        $pid = $_POST['pid'][$i];
        $type = $_POST['stock'][$i];
        $date = $_POST['date'][$i];
        $reference = $_POST['query'][$i];
        $quantity = $_POST['quantity'][$i];
        $cost = $_POST['cost'][$i];
        $amount = $_POST['amount'][$i];

        // Validate input values
        if (($pid) &&($type) && ($date) && ($reference) && ($quantity) &&($cost) && ($amount)) {
            $insertProduct = "INSERT INTO `stock` (`P_id`, `Type`, `Date`,`Reference`, `Cost`, `Quantity`, `Amount`) VALUES ('$pid', '$type', '$date','$reference' ,'$cost', '$quantity', '$amount')";
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
    <script src="script.js"></script>
</head>
<!-- jb user add row kre tw adjustment type or date wohi jae database me jo phle fill -->
<body>
    <section class="container">
        <header>Add Stock</header>
        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" id="stockForm" method="post">
        
        <div class="input-box">
            <!-- <label>S no</label> -->
            <input readonly name="si[]" type="hidden" id="si" value="1"  required /> 
        </div>
        
        <div class="column">       
            <div class="input-box">
                <label>Stock SKU Code</label>
                <input readonly name="number" class="border border-dark" value="<?php echo $newCode ;?>" required /> 
            </div>
            
            <div class="input-box mt-3 me-5">
                <label for="text">Adjustment Stock</label>
                <select class="form-select form-select-sm border border-dark" name="stock[]">
                    <option value="Opening Stock">Opening Stock</option>
                    <option value="Inward Stock">Inward Stock</option>
                    <option value="Lost of Theft">Lost of Theft</option>
                </select>
            </div>
            <div class="input-box">
                <label>Current Date</label>
                <input type="date" name="date[]" class="border border-dark" required/>
            </div>
            </div>
            <br>
            
            <div class="column">
                
                <div class="input-box">
                    <label>Product Name</label>
                    <input type="text" name="query[]" class="product-search border border-dark" id="country">
                    <ul id="countryList" class="list-unstyled "><!-- element to display search results --></ul>
                </div>
                
                <div class="input-box">
                    <label for="costInput">Cost of Stock</label>
                    <input type="number" name="cost[]" id="costInput" required class="costInput border border-dark"/>
                </div>
                <div class="input-box">
                    <label>Stock Quantity</label>
                    <input type="text" name="quantity[]" id="quantity" required class="quantityInput border border-dark">
                </div>
                <div class="input-box">
                    <label>Net Amount</label>
                    <input type="number" name="amount[]" id="netAmount" required class="amountInput border border-dark"/>
                </div>
                <div class="input-box">
                    <input type="hidden" name="pid[]" id="costInput" required class="pid"/>
                </div>
                <i class="fa-solid fa-arrow-down mt-5" name="addrow" id="addrow"></i>
</div>
</div>
        
                <div id="next"></div>

            <input type="submit" name="submit" value="Submit" class="mt-4 btn btn-danger ">
                    
                </form>
            </section>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- updated jQuery CDN link -->

            <script>
            $(document).ready(function () {
    // Event delegation for product search functionality
    $(document).on('keyup', '.product-search', function () {
        var query = $(this).val();
        var currentInput = $(this);
        var resultList = currentInput.siblings('.list-unstyled');
        
        if (query !== '') {
            $.ajax({
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                method: "post",
                data: { query: query },
                dataType: 'json',
                success: function (data) {
                    resultList.empty();
                    if (data.hasOwnProperty('error')) {
                        resultList.append('<li class="list-item">' + data.error + '</li>');
                    } else {
                        $.each(data, function (index, value) {
                            resultList.append('<li class="list-item">' + value.Name + '</li>');
                        });
                    }
                },
                error: function (xhr, status, error) {
                    resultList.empty();
                    resultList.append('<li class="list-item">Error: ' + xhr.responseJSON.error + '</li>');
                }
            });
        } else {
            resultList.empty();
        }
    });

    // Event delegation for selecting product from search results
    $(document).on('click', '.list-item', function () {
        var selectedProduct = $(this).text();
        var parent = $(this).closest('.input-box');
        parent.find('.product-search').val(selectedProduct);
        $(this).parent().empty();

        // Fetch product details
        $.ajax({
            url: "<?php echo $_SERVER['PHP_SELF']; ?>",
            method: "post",
            data: { query: selectedProduct },
            dataType: 'json',
            success: function (data) {
                // parent.find('.product-search').val(data[0].Id);
                parent.siblings('.input-box').find('.costInput').val(data[0].Purchase_Price);
                parent.siblings('.input-box').find('.pid').val(data[0].Id);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Calculate amount on quantity input
    $(document).on('input', '.quantityInput, .costInput', function () {
        var row = $(this).closest('.column');
        var quantity = row.find('.quantityInput').val();
        var cost = row.find('.costInput').val();
        var netAmount = quantity * cost;
        row.find('.amountInput').val(netAmount);
    });

// Add new row
$('#addrow').click(function () {
    var newrow = `<div class="column">
                <div class="input-box">
                    <input type="text" name="query[]" class="product-search border border-dark" id="country">
                    <ul id="countryList" class="list-unstyled "><!-- element to display search results --></ul>
                </div>
                
                <div class="input-box">
                    <input type="number" name="cost[]" id="costInput" required class="costInput border border-dark"/>
                </div>
                <div class="input-box">
                    <input type="text" name="quantity[]" id="quantity" required class="quantityInput border border-dark">
                </div>
                <div class="input-box">
                    <input type="number" name="amount[]" id="netAmount" required class="amountInput border border-dark"/>
                </div>
                
            <div class="input-box">
                    <input type="hidden" name="pid[]" id="costInput" required class="pid border border-dark"/>
                </div>                
                    <i class="fa-solid fa-xmark btnremove"></i></div> 

`;

    // Get adjustment type and date from the first row
    var adjustmentType = $('select[name="stock[]"]:first').val();
    var adjustmentDate = $('input[name="date[]"]:first').val();

    // Add adjustment type and date to the new row
    newrow += `
        <input type="hidden" name="stock[]" value="${adjustmentType}">
        <input type="hidden" name="date[]" value="${adjustmentDate}">`;

    $('#next').append(newrow);
});

$('body').on('click' , '.btnremove' , function(){
    $(this).closest('div').remove()
})
});


    </script>
</body>
</html>