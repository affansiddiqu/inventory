<?php
require('config.php');
require('dashboard.php');

// Fetch product data with total quantity and amount from stock
$query = "SELECT p.*, 
                 SUM(CASE WHEN s.Type = 'Lost of Theft' THEN -s.Quantity ELSE s.Quantity END) AS TotalQuantity,
                 SUM(CASE WHEN s.Type = 'Lost of Theft' THEN -s.Amount ELSE s.Amount END) AS TotalAmount
          FROM Products p
          LEFT JOIN Stock s ON p.Id = s.P_id
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
                        <th scope="col">Amount</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr>
                        <td><?php echo $row['Code']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['TotalQuantity']; ?></td>
                        <td><?php echo $row['TotalAmount']; ?></td>
                        <td><a href="Product_delete.php?Id=<?php echo $row['Id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>  
                        <!-- <td><a href="Product_update.php -->
                        <td><a href="Product_update.php?Id=<?php echo $row['Id']; ?>" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i></a></td>  
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
