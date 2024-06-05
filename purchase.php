<?php
// include('admin/includes/header.php');
// include('admin/includes/sidebar.php');
// include('admin/includes/topbar.php');
include('dashboard.php');
include('config.php');

$limit = 3;
if(isset($_GET['page'])){
  
  $getpgno = $_GET['page'];
}else{
  $getpgno = 1;
}
$offset = ($getpgno - 1) * $limit;

$fetch = "SELECT * FROM `add` where astatus = '1' order by aid desc limit {$offset}, {$limit}";

$data = mysqli_query($connect, $fetch);
?><!DOCTYPE html>
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
        <header>Inventory</header>
        <button type="button" onclick="location.href='invent_form.php'" class="add_knittingcard_button" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add Inventory</button>
    </div>

<br>
<br>
<br>   
    <div>
        <button type="button" class="filter_button"><i class="fa fa-filter" aria-hidden="true"></i>Filter</button>
    </div>
</section>
    
</body>
</html>
 <div class="container mt-4">

        <!-- Outer Row -->
        <!-- <div class="row justify-content-right">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>Registerd Agent</h2>
                <hr>
            <table class="table table-warning">
                <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Company</th>
                    <th scope="col">Agent Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">City</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($data)) {
                     ?>
                    <tr>
                    <td><?php echo $row ['aid']?></td>
                    <td><?php echo $row ['company']?></td>
                    <td><?php echo $row ['name']?></td>
                    <td><?php echo $row ['email']?></td>
                    <td><?php echo $row ['phone']?></td>
                    <td><?php echo $row ['city']?></td>
                    <td ><a href="aupdatedata.php?aid=<?php echo $row ['aid'];?>" class="btn btn-success">Update</a></td>
                    <td ><a href="adelete.php?aid=<?php echo $row ['aid'];?>" class="btn btn-danger">Delete</a></td>  
                </tr>
                <?php
                    }
                ?>
                </tbody>
            </table> -->

<?php
// $fetchpage = "SELECT * from `add`";
// $query = mysqli_query($connect, $fetchpage);

//   if(mysqli_num_rows($query) > 0){
//     $totalRecords = mysqli_num_rows($query);
//     $totalpages = ceil($totalRecords / $limit);
//     echo '<ul class="pagination">';
//     if($getpgno > 1){
//       echo '<li class="page-item"><a class="page-link" href="viewagent.php?page='.($getpgno - 1).'">prev</a></li>';
//     }
//     for($i = 1; $i <= $totalpages; $i++){
//       $active = $i == $getpgno? "active" : "";
//       echo '<li class="'.$active.' page-item"><a class="page-link" href="viewagent.php?page='.$i.'">'.$i.'</a></li>';
//     }
//     if($getpgno < $totalpages){
//       echo '<li class="page-item"><a class="page-link" href="viewagent.php?page='.($getpgno + 1).'">next</a></li>';
//     }

//   }
//   ?>
            </div>

        </div>

    </div>


</body>

</html>

