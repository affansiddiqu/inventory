<?php
require('dashboard.php');
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

<!--Knittingcard_form-->

<section class="container">

    <header>Knitting Card</header>
    
    <form action="#" class="form">
<!--             
            <div class="job">
                <input type="radio" id="new" name="job" checked />
              <label for="new">New</label>
            </div>

            <div class="job">
              <input type="radio" id="existing" name="job" />
              <label for="existing">Existing</label>
            </div>

        </div> -->

        <div class="column">
   
            <div class="input-box">
                <label>Vendor</label>
                <input type="text" required />
            </div>

            <div class="input-box">
                <label>Number</label>
                <input type="number" placeholder="Pl-000087"  />
            </div>

            <div class="input-box">
                <label>Date</label>
                <input type="date" required />
            </div>
            </div>

        <br>

        <div class="column">

            <div class="input-box">
                <label>SKUS</label>
                <input type="text" placeholder="10001" required />
            </div>
            <div class="input-box">
                <label>Brand</label>
                <input type="text" required />
            </div>

            <div class="input-box">
                <label>Count</label>
                <input type="text" required />
            </div>  

    
            <div class="input-box">
                <label>Bags</label>
                <input type="number" />
            </div>
            
            <div class="input-box">
                <label>Weight</label>
                <input type="number" />
            </div>

            <div class="input-box">
                <label>Rate/Kg</label>
                <input type="number" />
            </div>

        </div>
     </div>
</div>
<input type="button" value="Submit" class="mt-5 btn btn-outline-danger ">
        <!-- <button class="text-center">Submit</button> -->
      </form>

</section>
</body>
</html>