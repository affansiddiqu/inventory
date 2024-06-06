<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- bootstrap link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <!-- js link  -->
    <script src="https://use.fontawesome.com/ccb21b5b72.js"></script>
    <script src="script.js"></script>
    
    <!-- icons link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!--Navigation Menu-->
    
    <div class="menu">
        <div class="logo">
            <img src="../images/logo.png" alt="Noorani & Co">
        </div>
        
        <div class="dropdown">
            <button onclick="toggleDropdown('dropdown2')" class="dropbtn"><i class="fa fa-cogs" aria-hidden="true"> SetUp</i></button>
            <div id="dropdown2" class="dropdown-content">
                <a href=""><i class="fa-solid fa-person-military-pointing"></i> Customer</a>
                <a href=""><i class="fa-sharp fa-regular fa-shirt"></i> Vendor</a>
                <a href="Product.php"><i class="fa-brands fa-product-hunt"></i> Products</a>
                <a href=""><i class="fa-solid fa-child"></i> Employee</a>
                <a href=""><i class="fa-regular fa-user"></i> User</a>
            </div>
            <div class="dropdown ms-4">
                <button onclick="toggleDropdown('dropdown1')" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <div id="dropdown1" class="dropdown-content">
                <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i>Settings</a>
                <a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
            </div>
            
        </div>
</div>
</div>

<div class="sidenav">
    <ol><button class="dropdown-btn dashboard">Dashboard<i class="fa fa-caret-down"></i>
    <ol><button class="dropdown-btn">Knitting<i class="fa fa-caret-down"></i>
</button>
<div class="dropdown-container">
    <li><a href="knittingcard.php">Knitting Card</a></li>
    <li><a href="yarnreturned.php">Yarn Returned</a></li>
    <li><a href="#">Fabric Details</a></li>
    <li><a href="#">Knitting QC</a></li>
</div>
</ol>
<ol><button class="dropdown-btn">Dyeing<i class="fa fa-caret-down"></i>
</button>
<div class="dropdown-container">
    <li><a href="#">Dyeing Card</a></li>
    <li><a href="#">Dye Fabric Details</a></li>
            <li><a href="#">Dyeing QC</a></li>
        </div>
    </ol>
    <ol><button class="dropdown-btn">Production<i class="fa fa-caret-down"></i></button>
    <div class="dropdown-container">
        <li><a href="#">Cutting Unit</a></li>
        <li><a href="#">Stitching Unit</a></li>
        <li><a href="#">Finishing Unit</a></li>
    </div>
</ol>
<ol><button class="dropdown-btn">Inventory<i class="fa fa-caret-down"></i></button>
<div class="dropdown-container">
    <li><a href="#">Inflow</a></li>
    <li><a href="stock.php">Stock Adjustment</a></li>
    <li><a href="stockvaluation.php">Stock Valuation</a></li>
</div>
</ol>
<ol><button class="dropdown-btn">HR<i class="fa fa-caret-down"></i></button>
<div class="dropdown-container">
    <li><a href="#">Employee Details</a></li>
    <li><a href="#">Attendance Report</a></li>
    <li><a href="#">Payroll</a></li>
        </div>
    </ol>
    <ol><a href="report.php">Reports</a>
    </ol>
</div> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- updated jQuery CDN link -->
<script>
    var acc = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }

    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("show");
    }

    function redirectTo(url) {
        window.location.href = url;
    }

    document.addEventListener('click', function(event) {
        var isClickInsideDropdown = event.target.closest('.dropdown');
        var dropdowns = document.getElementsByClassName('dropdown-content');
        for (var i = 0; i < dropdowns.length; i++) {
            if (!isClickInsideDropdown || !isClickInsideDropdown.contains(dropdowns[i])) {
                dropdowns[i].classList.remove('show');
            }
        }

        var isClickInsideSidenavDropdown = event.target.closest('.sidenav');
        var sidenavDropdowns = document.getElementsByClassName('dropdown-container');
        for (var j = 0; j < sidenavDropdowns.length; j++) {
            if (!isClickInsideSidenavDropdown || !isClickInsideSidenavDropdown.contains(sidenavDropdowns[j].previousElementSibling)) {
                sidenavDropdowns[j].style.display = 'none';
            }
        }
    });

    // Redirect to index.php when dashboard is clicked
    $(document).on('click', '.dashboard', function() {
        redirectTo('index.php');
    });
</script>
</body>
</html>

<!-- <div class="column mt-4">
    <label>Shipping Address</label> <br>
<input class="form-control text-dark border border-dark input-lg"  type="text">

<label for="inputlg">Comments Here!</label> <br>
<input class="form-control  text-dark border border-dark input-lg" id="inputlg" type="text">
</div> -->