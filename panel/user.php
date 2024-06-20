<?php
require('config.php');
require('index.php');

$fetch = "SELECT * FROM `users`";
$query = mysqli_query($connect , $fetch);

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
    <div>
        <header>User Info</header>
        <button type="button" onclick="location.href='user_form.php'" class="add_knittingcard_button" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add User</button>
    </div>

<br>
<br>
<br>    
    <div>
    <div>
    <form action="import.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file" accept=".csv">
        <button type="submit" class="btn btn-danger">Import CSV</button>
    </form>
</div>
    </div>
</section>
    
<section class="container">
              
                <!-- table -->
                <div class="row justify-content-right">
                    
                    <h2>User Details</h2>
                <hr>
            <table class="table table-warning mt-4" id="example">
                <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) {
                     ?>
                    <tr>

                    <td><?php echo $row ['Uid']?></td>
                    <td><?php echo $row ['Uname']?></td>
                    <td><?php echo $row ['lname']?></td>
                    <td><?php echo $row ['email']?></td>
                    <td><?php echo $row ['role']?></td>
                    <td ><a href=""class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>  
                    <td ><a href="" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i></a></td>  
                </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </section>


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

</body>
</html>