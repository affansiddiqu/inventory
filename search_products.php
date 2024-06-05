<?php
require('config.php');
?>
<div class="input-box">
    <label for="productSelect">Select Product</label>
    <select class="form-select" name="reference" id="productSelect" aria-label="Default select example" onchange="updateCost()">
        <option value="">Select Product</option>
        <?php
        foreach ($productData as $code => $price) {
            // Fetch product name and ID based on the code
            $productNameQuery = "SELECT `Name`, `Id` FROM `products` WHERE `Code`='$code'";
            $productNameResult = mysqli_query($connect, $productNameQuery);
            $productNameRow = mysqli_fetch_assoc($productNameResult);
            $productName = $productNameRow['Name'];
            $productId = $productNameRow['Id'];

            // Output option with code, name, and ID
            echo "<option value='$code' data-id='$productId'>$code - $productName</option>";
        }
        ?>
    </select>
    <input type="text" id="searchInput" oninput="searchProducts()" placeholder="Search products...">
</div>

<input type="text" id="searchInput" oninput="searchProducts()" placeholder="Search products...">
<script>
    function searchProducts() {
    var input, filter, select, options, option, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    select = document.getElementById("productSelect");
    options = select.getElementsByTagName("option");

    // Loop through all options and hide those that do not match the search query
    for (i = 0; i < options.length; i++) {
        option = options[i];
        txtValue = option.textContent || option.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            option.style.display = "";
        } else {
            option.style.display = "none";
        }
    }
}

</script>