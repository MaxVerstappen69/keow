<?php
include '../include/navbar_main.php';

// Check if any product data is sent
if (isset($_POST['selected_products'])) {
  // Connect to the database
  require_once "../../config/db.php";

  // Create an array to store selected product IDs
  $selectedProducts = $_POST['selected_products'];

  // Check if there are any products in the list
  if (count($selectedProducts) > 0) {
    // You can fetch additional data from the database or process as needed here
    // For example:

    // Create SQL query to retrieve selected products
    $selectedProductsString = implode(",", $selectedProducts); // Convert array to string for SQL query
    $sql = "SELECT * FROM product WHERE product_id IN ($selectedProductsString)";

    // Execute the query
    $result = $conn->query($sql);

  } else {
    echo "No products selected.";
  }
} else {
  echo "No data received.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .product-card {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .product-image {
      max-width: 100px;
      max-height: 100px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">รายการสั่งซื้อ</h2>

    <?php
    if ($result->num_rows > 0) {
      // Loop through and display selected product data
      while ($row = $result->fetch_assoc()) {
        ?>
        <div class="product-card d-flex align-items-center">
          <img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" class="product-image me-3">
          <div>
            <h3>
              <?php echo $row['product_name'] ?>
            </h3>
            <p>ราคา:
              <?php echo $row['price'] ?> บาท
            </p>
            <p>จำนวน:
              <?php echo $row['quantity'] ?>
            </p>
          </div>
        </div>
        <?php
      }
    } else {
      echo "No selected products found.";
    }
    ?>

    <!-- Add more HTML elements for order summary, payment form, etc. -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>