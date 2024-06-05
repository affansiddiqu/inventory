<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
</head>
<body>
    <section class="container">
        <header>Add Stock</header>
        <!-- Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" id="stockForm" method="post">
            <!-- ... -->
            <div class="column">
                <!-- ... -->
                <div class="input-box">
                    <label for="text">Adjustment Stock</label>
                    <select class="form-select form-select-sm" name="stock[]">
                        <option value="Opening Stock">Opening Stock</option>
                        <option value="Inward Stock">Inward Stock</option>
                        <option value="Lost of Theft">Lost of Theft</option>
                    </select>
                </div>
                <div class="input-box">
                    <label>Current Date</label>
                    <input type="date" name="date[]" required/>
                </div>
                <input type="hidden" name="type[]" value="">
                <input type="hidden" name="date_hidden[]" value="">
            </div>
            <!-- ... -->
            <div id="next"></div>
            <!-- ... -->
        </form>
    </section>
    <!-- ... -->
    <script>
        $(document).ready(function () {
            // ...
            $(document).on('change', 'select[name="stock[]"], input[name="date[]"]', function() {
                var type = $(this).val();
                var date = $(this).closest('.column').find('input[name="date[]"]').val();
                $(this).closest('.column').find('input[name="type[]"]').val(type);
                $(this).closest('.column').find('input[name="date_hidden[]"]').val(date);
            });
        });
    </script>
</body>
</html>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- updated jQuery CDN link -->

            <!-- or jb data submit hu tw adjustment type or date wo hi jae jo gi database me chiye jitni bh row add krlo -->
            <script>
            $(document).ready(function () {
  // Event delegation for product search functionality
  $(document).on('keyup', '.product-search', function () {
    var query = $(this).val();
    var currentInput = $(this);
    var resultList = currentInput.siblings('.list-unstyled');
    
    if (query !== '') {
      $.ajax({
        url: 'search-products.php', // Use a separate PHP file for searching products
        method: 'post',
        data: { query: query },
        dataType: 'json',
        success: function (data) {
          resultList.empty();
          if (data.hasOwnProperty('error')) {
            resultList.append('<li class="list-item">' + data.error + '</li>');
          } else {
            $.each(data, function (index, value) {
              resultList.append('<li class="list-item">' + value.Name + '</li>');
            });
          }
        },
        error: function (xhr, status, error) {
          resultList.empty();
          resultList.append('<li class="list-item">Error: ' + xhr.responseJSON.error + '</li>');
        }
      });
    } else {
      resultList.empty();
    }
  });

  // Add new row
  $('#addrow').click(function () {
    var newRow = `
      <div class="input-box">
        <input readonly name="si[]" type="hidden" id="si" value="1" required />
      </div>
      <div class="column">
        <div class="input-box">
          <input type="text" name="query[]" class="product-search" id="country">
          <ul class="list-unstyled countryList"></ul>
        </div>
        <!-- ... -->
      </div>
    `;

    $('#next').append(newRow);
  });
  $(document).ready(function () {
  // Add new row
  $('#addrow').click(function () {
    var newRow = `
      <div class="input-box">
        <input readonly name="si[]" type="hidden" id="si" value="1" required />
      </div>
      <div class="column">
        <div class="input-box">
          <input type="text" name="query[]" class="product-search" id="country">
          <ul class="list-unstyled countryList"></ul>
        </div>
        <!-- ... -->
        <div class="input-box">
          <select name="stock[]" class="form-select form-select-sm">
            <option value="">Select Adjustment Type</option>
            <option value="Opening Stock">Opening Stock</option>
            <option value="Inward Stock">Inward Stock</option>
            <option value="Lost of Theft">Lost of Theft</option>
          </select>
        </div>
        <div class="input-box">
          <input type="date" name="date[]" required/>
        </div>
      </div>
    `;

    // Copy adjustment type and date from the first row
    var firstRowAdjustmentType = $('select[name="stock[]"]').first().val();
    var firstRowDate = $('input[name="date[]"]').first().val();

    newRow.find('select[name="stock[]"]').val(firstRowAdjustmentType);
    newRow.find('input[name="date[]"]').val(firstRowDate);

    $('#next').append(newRow);
  });
});
});
    
</script>