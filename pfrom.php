<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

// Fetch the maximum SKU code
$query = "SELECT MAX(SUBSTRING(`SCode`, 4)) AS max_code FROM `Stock`";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$maxCode = $row['max_code'];
$newCode = 'SA-' . str_pad($maxCode + 1, 5, '0', STR_PAD_LEFT);

// Increment the SKU code

if(isset($_POST['submit'])){ 
    // Retrieve form data for the   
    $type = $_POST['stock'];
    $date = $_POST['date'];
    $reference = $_POST['query'];
    $quantity = $_POST['quantity'];
    $cost = $_POST['cost'];
    $amount = $_POST['amount'];
    
    // Adjust quantity if stock adjustment is "Lost of Theft"
    // if($type == "Lost of Theft") {
    //     // Subtract quantity from the database
    //     $subtractQuantityQuery = "UPDATE stock SET Quantity = Quantity - '$quantity' WHERE Reference = '$reference'";
        //     $subtractResult = mysqli_query($connect, $subtractQuantityQuery);
    //     if(!$subtractResult) {
    //         echo "<script>alert('Error in subtracting quantity: " . mysqli_error($connect) . "');</script>";
    //     }
    // }
    
    // Insert the product data into the database
    $insertProduct = "INSERT INTO `stock` (`Type`, `Date`,`Reference`, `Cost`, `Quantity`, `Amount`) VALUES ('$type','$date ', '$reference', '$cost', '$quantity', '$amount')";
    $resultProduct = mysqli_query($connect, $insertProduct);
    if ($resultProduct) {
        echo "<script>alert('Add Stock successful');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}


if(isset($_POST["query"])){
    $output = array(); // Initialize an empty array
    $query = "SELECT * FROM products WHERE Name LIKE '%".$_POST["query"]."%'";
    $res = mysqli_query($connect, $query); // corrected variable name
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $output[] = $row; // Append each row to the output array
        }
        echo json_encode($output); // echo the result as JSON array
        
    } else {
        header("location:Stock_form.php");
    }
    exit; // stop further execution
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
            <div class="column">
                <div class="input-box">
                    <label>Stock SKU Code</label>
                        <input readonly name="number" value="<?php echo $newCode ;?>" required /> 
                </div>
                
                <div class="input-box mt-3">
                    <label for="text">Adjustment Stock</label>
                    <select class="form-select form-select-sm" name="stock">
                        <option value="Opening Stock">Opening Stock</option>
                        <option value="Inward Stock">Inward Stock</option>
                        <option value="Lost of Theft">Lost of Theft</option>
                    </select>
                </div>
                <div class="input-box">
                    <label>Current Date</label>
                    <input type="date" name="date" required/>
                </div>
            </div>
            
            <br>
            
            <div class="column">
                <div class="input-box">
                    <label>Product Name</label>
                    <input type="text" id="country" name="query" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <ul id="countryList" class="list-unstyled"><!-- element to display search results --></ul>
                </div>

                <div class="input-box">
                    <label for="costInput">Cost of Stock</label>
                    <input type="number" name="cost" id="costInput" required/>
                </div>
                <div class="input-box">
                    <label>Stock Quantity</label>
                    <input type="text" name="quantity" id="quantity" required class="form-control">
                </div>
                <div class="input-box">
                    <label>Net Amount</label>
                    <input type="number" name="amount" id="netAmount" required readonly/>
                </div>
                <table>
                <table>
                <thead>
                    <tr>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="pfrom.php">Tick<i class="fa-sharp fa-light fa-location-check"></i></td>
                </tr>
                
                </tbody>
                </table>
            </div>

            <div class="column">
                <div class="input-box">
                    <!-- <label>Product Name</label> -->
                    <input type="text" id="country" name="query" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <ul id="countryList" class="list-unstyled"><!-- element to display search results --></ul>
                </div>

                <div class="input-box">
                    <!-- <label for="costInput">Cost of Stock</label> -->
                    <input type="number" name="cost" id="costInput" required/>
                </div>
                <div class="input-box">
                    <!-- <label>Stock Quantity</label> -->
                    <input type="text" name="quantity" id="quantity" required class="form-control">
                </div>
                <div class="input-box">
                    <!-- <label>Net Amount</label> -->
                    <input type="number" name="amount" id="netAmount" required readonly/>
                </div>
                <table>
                <table>
                <thead>
                    <tr>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="pf.php">Tick<i class="fa-sharp fa-light fa-location-check"></i></td>
                </tr>
                
                </tbody>
                </table>
            </div>


            <input type="submit" name="submit" value="Submit" class="mt-4 btn btn-danger ">
       
        </form>
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
                $('#country').val(data[0].Code);
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


</script>
    
</body>
</html>