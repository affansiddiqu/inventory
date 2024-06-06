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
    <div>
        <header>Knitting</header>
        <button type="button" onclick="location.href='knittingcard_form.php'" class="add_knittingcard_button" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add Knitting Card</button>
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