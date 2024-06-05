<form id="stockForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
    <!-- Existing form fields -->

    <div id="rowContainer">
        <!-- Initial row -->
        <div class="row">
            <div class="input-box">
                <input type="text" name="productName[]" class="product-search" placeholder="Product Name">
                <ul class="list-unstyled search-results"></ul>
            </div>
            <!-- Other input fields for cost, quantity, net amount -->
        </div>
    </div>

    <button type="button" id="addRowBtn">Add Row</button>
    <input type="submit" name="submit" value="Submit">
</form>


<script>
$(document).ready(function() {
    // Add new row
    $('#addRowBtn').click(function() {
        var newRow = '<div class="row">' +
            '<div class="input-box">' +
            '<input type="text" name="productName[]" class="product-search" placeholder="Product Name">' +
            '<ul class="list-unstyled search-results"></ul>' +
            '</div>' +
            '<!-- Other input fields for cost, quantity, net amount -->' +
            '</div>';

        $('#rowContainer').append(newRow);
    });

    // Product search functionality
    $(document).on('keyup', '.product-search', function() {
        var query = $(this).val();
        var resultList = $(this).siblings('.search-results');

        if (query !== '') {
            $.ajax({
                url: 'pff.php', // Replace with your search endpoint
                method: 'POST',
                data: { query: query },
                dataType: 'html',
                success: function(response) {
                    resultList.empty();
                    resultList.append(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        } else {
            resultList.empty();
        }
    });

    // Select product from search results
    $(document).on('click', '.search-results li', function() {
        var selectedProduct = $(this).text();
        $(this).closest('.input-box').find('.product-search').val(selectedProduct);
        $(this).parent().empty();
    });
});
</script>