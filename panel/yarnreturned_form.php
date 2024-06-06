<?php
require('index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/ccb21b5b72.js"></script>
    <script src="script.js"></script>

</head>
<body>

<!--Knittingcard_form-->

<section class="container">

    <header>Yarn Returned</header>
    
    <form action="#" class="form">
        
        <div class="column">
   
            <div class="input-box">
                <label>Vendor Name</label>
                <input type="text" required />
            </div>

            <div class="input-box">
                <label>Transaction Number</label>
                <input type="number" readonly />
            </div>

            <div class="input-box">
                <label>Transaction Date</label>
                <input type="date" required />
            </div>
            
            <div class="input-box">
                <label>VDC Number</label>
                <input type="text" />
            </div>

            <div class="input-box">
                <label>Job Number</label>
                <input type="number" required />
            </div>

        </div>

        <br>

        <div class="column">

            <div class="input-box">
                <label>SKU</label>
                <input list="sku-yarn" name="sku-yarn" required>
                  <datalist id="sku-yarn">
                    <option value="#"></option>
                  </datalist>
                  <input list="sku-yarn" name="sku-yarn" required>
                  <datalist id="sku-yarn">
                    <option value="#"></option>
                  </datalist>
                  <input list="sku-yarn" name="sku-yarn" required>
                  <datalist id="sku-yarn">
                    <option value="#"></option>
                  </datalist>
                  <input list="sku-yarn" name="sku-yarn" required>
                  <datalist id="sku-yarn">
                    <option value="#"></option>
                  </datalist>
            </div>
            
            <div class="input-box">
                <label>Brand</label>
                <input type="text" readonly />
                <input type="text" readonly />
                <input type="text" readonly />
                <input type="text" readonly />
            </div>

            <div class="input-box">
                <label>Count</label>
                <input type="text" readonly />
                <input type="text" readonly />
                <input type="text" readonly />
                <input type="text" readonly />
            </div>

            <div class="input-box">
                <label>Ratio %</label>
                <input type="number" />
                <input type="number" />
                <input type="number" />
                <input type="number" />
            </div>
            
            <div class="input-box">
                <label>Bag/s</label>
                <input type="number" />
                <input type="number" />
                <input type="number" />
                <input type="number" />
            </div>

            <div class="input-box">
                <label>Weight</label>
                <input type="number" />
                <input type="number" />
                <input type="number" />
                <input type="number" />
            </div>

        </div>

        <br>
        
        <div class="column">
    
            <div class="input-box">
                <label>Comments</label>
                <br>
                <input type="text" />
            </div>

        </div>

        <br>
        
        <div class="column">
    
            <div class="input-box">
                <label>By Hand</label>
                <input type="text" />
            </div>
            
            <div class="input-box">
                <label>Vehicle #</label>
                <input type="text" />
            </div>

            <div class="input-box">
                <label>Entry By</label>
                <input type="text" />
            </div>

        </div>


        <button>Submit</button>
      </form>

</section>
</body>
</html>