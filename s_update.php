<?php
// Include database connection
require('config.php'); // Assuming this file contains database connection code

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
        header("location:Stock.php");
    }
    exit; // stop further execution
}


$Product_id = $_GET['Id']; 

$query = "select * from `Stock` where Id = '{$Product_id}'";

$retl = mysqli_query($connect , $query);
if(!$retl){
    die("query fail");
}

if (mysqli_num_rows($retl) > 0 ) {
    while($row = mysqli_fetch_assoc($retl)) {
     
        
        require('dashboard.php'); // Assuming this file contains database connection code
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
        <header>Updtae Adjustment Stock</header>
        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
            <div class="column">
                <div class="input-box">
                    <label>Stock SKU Code</label>
                    <input readonly name="number" value="<?php echo $row['SCode'] ;?>" required /> 
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
                    <input type="date" name="date"  value="<?php echo $row['Date'] ?>" required/>
                </div>
            </div>
            
            <br>
            
            <div class="column">
                <div class="input-box">
                    <label>Product Name</label>
                    <input type="text" id="country" name="query" class="form-control    ">
                    <ul id="countryList"  value="<?php echo $row['P_id'] ?>" class="list-unstyled"><!-- element to display search results --></ul>
                </div>

                <div class="input-box">
                    <label for="costInput">Cost of Stock</label>
                    <input type="number"  value="<?php echo $row['Cost'] ?>" name="cost" id="costInput" required/>
                </div>
                <div class="input-box">
                    <label>Stock Quantity</label>
                    <input type="text" name="quantity" value="<?php echo $row['Quantity'] ?>" id="quantity" required class="form-control">
                </div>
                <div class="input-box">
                    <label>Net Amount</label>
                    <input type="number" name="amount" value="<?php echo $row['Amount'] ?>" id="netAmount" required readonly/>
                </div>
<!--                 
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
                </table> -->
</div>
            <input type="submit" name="submit" value="Submit" class="mt-4 btn btn-danger ">
            <!-- <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button> -->

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

</script>
    
</body>
</html>