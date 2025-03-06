<?php
session_start();
require 'config.php'; // Database connection

// Ensure cart session is set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to remove product from session cart
function removeFromCart($id) {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

// Function to clear all items from the cart
function clearCart() {
    $_SESSION['cart'] = [];
}

// Add to Cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['id'];
    $product_name = htmlspecialchars($_POST['name']);
    $product_image = htmlspecialchars($_POST['image']);
    $product_price = (float) $_POST['price'];
    $product_quantity = (int) $_POST['quantity'];

    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'name' => $product_name,
            'image' => $product_image,
            'price' => $product_price,
            'quantity' => $product_quantity
        ];
    } else {
        echo '<script>alert("Product is already in the cart.");</script>';
    }
    header('location: cart.php');
    exit;
}

// Update Cart Quantity
if (isset($_POST['update_update_btn'])) {
    $update_id = $_POST['update_quantity_id'];
    $update_value = (int) $_POST['update_quantity'];

    if (isset($_SESSION['cart'][$update_id])) {
        $_SESSION['cart'][$update_id]['quantity'] = max(1, $update_value);
    }
    header('location: cart.php');
    exit;
}

// Remove Item
if (isset($_GET['remove'])) {
    removeFromCart($_GET['remove']);
    header('location: cart.php');
    exit;
}

// Clear Cart
if (isset($_GET['delete_all'])) {
    clearCart();
    header('location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
</head>
<body>

<nav>
    <div class="header">
        <a href="user_page.php" class="logo">EarGearHub</a>
        <a href="user_page.php">Home</a>
        <a href="shop.php">Shop</a>
        <a class="active" href="cart.php">Cart</a>
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a class="icons">
            <p id="menu-btn" class="fas fa-bars"></p>
            <p id="user-btn" class="fas fa-user"></p>
        </a>
        <div class="account-box">
                <p>Username: <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?></span></p>
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
    </div>
</nav>

<div class="container">
    <section class="shopping-cart">
        <h1 class="h1">Shopping Cart</h1>
        <table>
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach ($_SESSION['cart'] as $cart_item) {
                    $sub_total = $cart_item['price'] * $cart_item['quantity'];
                    $grand_total += $sub_total;
                ?>
                <tr>
                    <td><img src="uploaded_img/<?php echo htmlspecialchars($cart_item['image']); ?>" height="100" alt=""></td>
                    <td><?php echo htmlspecialchars($cart_item['name']); ?></td>
                    <td>Rs.<?php echo number_format($cart_item['price']); ?>/-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="update_quantity_id" value="<?php echo $cart_item['id']; ?>">
                            <input type="number" name="update_quantity" min="1" value="<?php echo $cart_item['quantity']; ?>">
                            <input type="submit" value="Update" name="update_update_btn">
                        </form>
                    </td>
                    <td>Rs.<?php echo number_format($sub_total); ?>/-</td>
                    <td><a href="cart.php?remove=<?php echo $cart_item['id']; ?>" onclick="return confirm('Remove item?')" class="delete-btn"><i class="fas fa-trash"></i> Remove</a></td>
                </tr>
                <?php } ?>
                <tr class="table-bottom">
                    <td><a href="shop.php" class="option-btn">Continue Shopping</a></td>
                    <td colspan="3">Grand Total</td>
                    <td>Rs.<?php echo number_format($grand_total); ?>/-</td>
                    <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure?');" class="delete-btn"><i class="fas fa-trash"></i> Delete All</a></td>
                </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
        </div>
    </section>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-content">
            <h3>Contact Us</h3>
            <p>Email: eargearhub77@gmail.com</p>
            <p>Phone: +977 9849434541</p>
            <p>Address: Thimi, Bhaktapur</p>
        </div>
    </div>
    <div class="bottom-bar">
        <p>&copy; 2025 EarGearHub. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
