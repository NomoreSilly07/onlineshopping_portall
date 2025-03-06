<?php
session_start();
require 'config.php'; // Include database connection



if (isset($_POST['order_btn'])) {
    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $flat = mysqli_real_escape_string($conn, $_POST['flat']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pin_code = mysqli_real_escape_string($conn, $_POST['pin_code']);

    // Check if the cart is empty
    if (empty($_SESSION['cart'])) {
        echo "<script>alert('Your cart is empty! Please add items before checkout.'); window.location.href='cart.php';</script>";
        exit;
    }

    // Calculate grand total
    $grand_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $product_price = floatval($item['price']);
        $quantity = intval($item['quantity']);
        $total_price = $product_price * $quantity;
        $grand_total += $total_price;
    }

    // Insert the order details into the orders table
    $order_query = "INSERT INTO orders (user_id, name, email, phone_number, payment_method, address_flat, address_street, city, state, country, pin_code, grand_total, payment_status)
                    VALUES ('$user_id', '$name', '$email', '$number', '$method', '$flat', '$street', '$city', '$state', '$country', '$pin_code', '$grand_total', 'Pending')";

    if (mysqli_query($conn, $order_query)) {
        $order_id = mysqli_insert_id($conn); // Get the last inserted order ID

        // Insert order items into the order_items table
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $product_name = mysqli_real_escape_string($conn, $item['name']);
            $product_image = mysqli_real_escape_string($conn, $item['image']);
            $product_price = floatval($item['price']);
            $quantity = intval($item['quantity']);
            $total_price = $product_price * $quantity;

            $order_item_query = "INSERT INTO order_items (order_id, product_id, product_name, product_image, price, quantity, total_price)
                                 VALUES ('$order_id', '$product_id', '$product_name', '$product_image', '$product_price', '$quantity', '$total_price')";

            if (!mysqli_query($conn, $order_item_query)) {
                echo "<script>alert('Error inserting order items.'); window.location.href='checkout.php';</script>";
                exit;
            }
        }

        // Clear the cart session after successful order
        unset($_SESSION['cart']);

        echo "<script>alert('Order placed successfully!'); window.location.href='shop.php';</script>";
        exit;
    } else {
        echo "<script>alert('Order placement failed. Please try again.'); window.location.href='checkout.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="checkout.css">
</head>
<body>

<div class="container">
   <section class="checkout-form">
      <h1 class="h1">Complete Your Order</h1>
      <form action="" method="post">
         <div class="display-order">
            <?php
               $grand_total = 0;
               if (!empty($_SESSION['cart'])) {
                  foreach ($_SESSION['cart'] as $item) {
                     $total_price = floatval($item['price']) * intval($item['quantity']);
                     $grand_total += $total_price;
            ?>
            <span><?= htmlspecialchars($item['name']); ?> (<?= intval($item['quantity']); ?>)</span>
            <?php
                  }
               } else {
                  echo "<span>Your cart is empty!</span>";
               }
            ?>
            <span class="grand-total">Grand Total: Rs. <?= number_format($grand_total, 2); ?>/-</span>
         </div>

         <div class="flex">
            <div class="inputBox">
               <label>Your Name</label>
               <input type="text" name="name" required>
            </div>
            <div class="inputBox">
               <label>Your Number</label>
               <input type="number" name="number" required>
            </div>
            <div class="inputBox">
               <label>Your Email</label>
               <input type="email" name="email" required>
            </div>
            <div class="inputBox">
               <label>Payment Method</label>
               <select name="method">
                  <option value="Cash on Delivery" selected>Cash on Delivery</option>
                  <option value="Credit Card">Credit Card</option>
                  <option value="PayPal">PayPal</option>
               </select>
            </div>
            <div class="inputBox">
               <label>Address Line 1</label>
               <input type="text" name="flat" required>
            </div>
            <div class="inputBox">
               <label>Address Line 2</label>
               <input type="text" name="street" required>
            </div>
            <div class="inputBox">
               <label>City</label>
               <input type="text" name="city" required>
            </div>
            <div class="inputBox">
               <label>State</label>
               <input type="text" name="state" required>
            </div>
            <div class="inputBox">
               <label>Country</label>
               <input type="text" name="country" required>
            </div>
            <div class="inputBox">
               <label>Pin Code</label>
               <input type="text" name="pin_code" required>
            </div>
         </div>
         <input type="submit" value="Order Now" name="order_btn" class="btn">
      </form>
   </section>
</div>

<footer>
   <div class="bottom-bar">
      <p>&copy; 2025 EarGearHub. All Rights Reserved.</p>
   </div>
</footer>

</body>
</html>
