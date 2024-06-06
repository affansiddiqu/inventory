<?php
require('config.php');
require('index.php');

// Fetch product data with total quantity, amount, and average amount where quantity is greater than zero or equal to zero but not empty

$fetch = "SELECT * FROM `stock` as s inner join products as p on s.P_id=p.Id";
$query1 = mysqli_query($connect, $fetch);

$query = "SELECT p.*, 
                 SUM(CASE WHEN s.Type = 'Lost of Theft' THEN -s.Quantity ELSE s.Quantity END) AS TotalQuantity,
                 SUM(CASE WHEN s.Type = 'Lost of Theft' THEN -s.Amount ELSE s.Amount END) AS TotalAmount,
                 AVG(CASE WHEN s.Type IN ('Lost of Theft', 'Opening Stock', 'Inward Stock') THEN s.Amount ELSE 0 END) AS AvgAmount
          FROM Products p
          LEFT JOIN Stock s ON p.Id = s.P_id
          WHERE (s.Quantity > 0 OR s.Quantity = 0) AND s.Quantity IS NOT NULL
          GROUP BY p.Id";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
</head>
<body>
    <section class="container">
        <div class="row justify-content-right">
            <h2>Reports</h2>
            <hr>
            <table class="table table-warning mt-4" id="example">
                <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                        <th scope="col">Sku Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Amount</th>
                        <!-- <th scope="col">Avg Amount</th> -->
                        <!-- <th scope="col">Delete</th> -->
                        <!-- <th scope="col">Update</th> -->
                    </tr>
                </thead>
                <tbody class="text-dark">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td><a href="showstock.php?productId=<?php echo $row['Id']; ?>"><?php echo $row['Code']; ?></a></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['TotalQuantity']; ?></td>
                        <td><?php echo $row['TotalAmount']; ?></td>
                        <!-- <td><?php echo round($row['AvgAmount'], 2); ?></td> -->
                        <!-- <td><a href="Product_delete.php?Id=<?php echo $row['Id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>   -->
                        <!-- <td><a href="Product_update.php -->
                        <!-- <td><a href="Product_update.php?Id=<?php echo $row['Id']; ?>" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i></a></td>   -->
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
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

