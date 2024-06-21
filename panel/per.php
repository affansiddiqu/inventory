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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<style>
    
#permission {
    background-attachment: #fff;
    padding: 10px;
    border-radius: 8px;
}

#permission .moduleName {
    font-weight: bold;
    text-transform: uppercase;
}

.modulefun {
    text-align: center;
    border: 1px solid #000;
    cursor: pointer;
    background-color: #fff; /* Set default background color to white */
    transition: background-color 0.3s ease; /* Smooth transition for color change */
}

.modulefun.permissionactive {
    background-color: lightcoral; /* Pink background color when active */
    color: #fff;
    border: 1px solid #000;
}
</style>
<body>

<div id="permission">
    <h5 class="mt-4">Permissions</h5>
    <hr>
    <div class="permissionContainer">
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Dashboard
                </div>
                <div class="col-md-2">
                <p class="modulefun" data-value="dashboard_view">View</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Reports
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="report_view">View</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Products
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="product_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="product_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="product_update">Update</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="product_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Stock Adjustment
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="stock_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="stock_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="stock_update">Update</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="stock_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-2 moduleName">
                    Stock Valuation
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="sv_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="sv_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="sv_update">Update</p>
                </div>
                <div class="col-md-2">
                    <p class="modulefun" data-value="sv_delete">Delete</p>
                </div>
            </div>
        </div>
    </div>
</div>

    
</body>
</html>
