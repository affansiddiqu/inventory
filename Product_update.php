<?php
require('config.php');
require('dashboard.php');

$Product_id = $_GET['Id']; 

$query = "select * from `Products` where Id = '{$Product_id}'";

$retl = mysqli_query($connect , $query);
if(!$retl){
    die("query fail");
}

if (mysqli_num_rows($retl) > 0 ) {
     while($row = mysqli_fetch_assoc($retl)) {
        
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
        
        <!-- Form -->
        
        <header>Update Product</header>
         
        <form action="product_updatadata.php" class="form" method="POST">
            <div class="form-group row">
                <div class="col-md-0">
                    <label for="" class="form-label"></label>
    <input type="hidden"  name="Id" class="form-control" value="<?php echo $row['Id']?>">
  </div>
            <div class="column">
                <div class="input-box">
                    <label>Product SKU Code</label>
                    <input readonly name="code" value="<?php echo $row['Code'] ?>" required />
                </div>
                <div class="input-box">
                    <label>Product Name</label>
                    <input type="text" name="Name" value="<?php echo $row['Name']?>" required/>
                </div>

                <div class="input-box mt-3">
                    <label for="text">Product Unit</label>
                    <select class="form-select form-select-sm" value="<?php echo $row['Measurement']?>" name ="Measure">
                    <option value="Pc">Pc</option>
                    <option value="Kg">Kg</option>
                </select>
                </div>
            </div>
            <br>
            
            <div class="column">
                <div class="input-box mt-3">
                    <label for="text">Product Category</label>
                    <select class="form-select form-select-sm"  name ="Category" value="<?php echo $row['Category']?>">
                    <option value="Tshirt">Tshirt</option>
                    <option value="Polo">Polo</option>
                    <option value="Hoodies">Hoodies</option>
                    <option value="Sweatshirt">Sweatshirt</option>
                    <option value="Raw Material">Raw Material</option>
                </select>
                </div> 

                <div class="input-box">
                    <label>Product Sale Price</label>
                    <input type="number" name="Sprice" required value="<?php echo $row['Sales_Price']?>"/>
                </div>
                
                <div class="input-box">
                    <label>Product Purchase Price</label>
                    <input type="number" name="Pprice" required value="<?php echo $row['Purchase_Price']?>" />
                </div>
            </div>
            <input type="submit" name="submit" value="Update Details" class="mt-4 btn btn-outline-danger ">
        </form>
      
      <?php
     }
    }
    ?>

</body>
</html>