<?php

include '../include/navbar_main.php';

// Check if any product data is sent
if (isset($_POST['selected_products'])) {
  // Connect to the database
  require_once "../../config/db.php";
  $id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

  // Create an array to store selected product IDs
  $selectedProducts = $_POST['selected_products'];

  // Check if there are any products in the list
  if (count($selectedProducts) > 0) {
    // Create SQL query to retrieve selected products
    $selectedProductsString = implode(",", $selectedProducts); // Convert array to string for SQL query
    $sql = "SELECT
            product.product_id,
            cart_item.customer_id,
            cart_item.quantity as cart_quantity,
            product.image,
            product.product_name, 
            product.price,
            cart_item.cart_item_id
        FROM
            product
        INNER JOIN 
            cart_item ON product.product_id = cart_item.product_id
        INNER JOIN 
            customer ON customer.customer_id = cart_item.customer_id
        WHERE 
            cart_item.product_id IN ($selectedProductsString) AND customer.email = '$id';";

    $result = $conn->query($sql);

    if (!$result) {
      die("Error retrieving selected products: " . $conn->error);
    }
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
      max-width: 130px;
      max-height: 130px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">รายการสั่งซื้อ</h2>
    <form method="post" action="add_to_cart.php"> <!-- ย้ายการกำหนด method และ action ไปที่ form รวม -->
      <?php
      if (isset($result) && $result->num_rows > 0) {

        $totalPrice = 0;
        while ($row = $result->fetch_assoc()) {

          $product_id = $row['product_id'];
          $product_name = $row['product_name'];
          $quantity = $row['cart_quantity'];
          $customer_id = $row['customer_id'];
          $price = $row['price'];
          $cart_item_id = $row['cart_item_id'];
          $subtotal = $price * $quantity;
          // Add subtotal to total price
          $totalPrice += $subtotal;
          // echo $quantity;
          ?>
          <div class="container d-flex justify-content-center">
          <div class="product-card d-flex align-items-center w-75">
    <input type='hidden' name="selected_products[]" value="<?php echo $product_id; ?>">
    <!-- Add hidden input field for cart_item_id -->
    <img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" class="product-image me-3">
    <div>
        <h3><?php echo $product_name ?></h3>
        <p>ราคา:<?php echo $price ?> บาท</p>
        <p>จำนวน:<?php echo $quantity ?></p>
    </div>
</div>
</div>
          <?php
        }
      } else {
        echo "No selected products found.";
      }
      ?>
      <div class="container d-flex justify-content-center">
      <div class="product-card text-center w-25">
        <h5><input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
        ราคารวมทั้งหมด:
        <?php echo number_format($totalPrice, 2); ?> บาท</h5>
        <button type="submit" class="btn btn-primary mt-2">สั่งสินค้า</button>
      </div>
        
      </div>
      </div>
    </form>

    <!-- Add more HTML elements for order summary, payment form, etc. -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>