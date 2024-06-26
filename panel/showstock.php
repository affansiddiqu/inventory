<?php
require('config.php');
require('index.php');

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    // Fetch product details
    $fetchProduct = "SELECT * FROM products WHERE Id = '$productId'";
    $productResult = mysqli_query($connect, $fetchProduct);
    $product = mysqli_fetch_assoc($productResult);

    // Fetch stock details
    $fetchStock = "SELECT * FROM stock WHERE P_id = '$productId'";
    $stockResult = mysqli_query($connect, $fetchStock);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/ccb21b5b72.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <section class="container">
        <h2>Product Details</h2>
        <hr>
        <?php if ($product) { ?>
            <h3>Product Information</h3>
            <p><strong>Code:</strong> <?php echo $product['Code']; ?></p>
            <p><strong>Name:</strong> <?php echo $product['Name']; ?></p>

            <h3>Stock Adjustments</h3>
            <table class="table table-warning mt-4">
                <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                        <th scope="col">SKU Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Adjustment Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($stock = mysqli_fetch_assoc($stockResult)) { ?>
                        <tr>
                            <td><?php echo $stock['SCode']; ?></td>
                            <td><?php echo $product['Name']; ?></td>
                            <td><?php echo $stock['Type']; ?></td>
                            <td><?php echo $stock['Date']; ?></td>
                            <td><?php echo $stock['Quantity']; ?></td>
                            <td><?php echo $stock['Cost']; ?></td>
                            <td><?php echo $stock['Amount']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No product details found.</p>
        <?php } ?>
    </section>
</body>
</html>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
$('.dt-buttons').addClass('float-end');
    });

    </script>
