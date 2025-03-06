<?php
@include 'config.php';

if (isset($_POST['add_product'])) {
    // Sanitize input
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . basename($product_image);
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    // Get file extension
    $file_extension = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));

    if (empty($product_name) || empty($product_price) || empty($product_image)) {
        $message = 'Please fill out all fields!';
    } elseif (!in_array($file_extension, $allowed_extensions)) {
        $message = 'Invalid image format. Only JPG, JPEG, and PNG are allowed!';
    } elseif ($_FILES['product_image']['size'] > 2097152) { // 2MB limit
        $message = 'Image size must be less than 2MB!';
    } else {
        // Prepare the insert query
        $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $product_name, $product_price, $product_image);

        if ($stmt->execute()) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message = 'New product added successfully!';
        } else {
            $message = 'Could not add the product. Please try again!';
        }
        $stmt->close();
    }
}

// Delete product logic
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Ensure ID is an integer

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: admin_products.php');
        exit();
    } else {
        $message = 'Could not delete the product. Try again later!';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Products</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Styles for admin panel */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
        nav .header {
    background-color: #333;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav .header .logo {
    color: #fff;
    font-size: 24px;
    text-decoration: none;
}

nav .header a {
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    margin: 0 10px;
    font-size: 18px;
}

nav .header a:hover,
nav .header .active {
    background-color: #f4a261;
    border-radius: 5px;
}
        .admin-product-form-container { background: #f9f9f9; padding: 20px; border-radius: 5px; }
        .admin-product-form-container form { display: flex; flex-direction: column; gap: 15px; }
        .box { padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px; }
        .btn { background: #28a745; color: white; padding: 10px; border-radius: 5px; cursor: pointer; transition: 0.3s; }
        .btn:hover { background: #218838; }
        .product-display { margin-top: 20px; overflow-x: auto; }
        .product-display-table { width: 100%; border-collapse: collapse; }
        .product-display-table th, .product-display-table td { padding: 15px; text-align: center; border: 1px solid #ddd; }
        .product-display-table th { background: #f2f2f2; }
        .product-display-table td img { width: 100px; height: 100px; object-fit: cover; }
        .product-display-table tr:hover { background: #f1f1f1; }
        .product-display-table td a { padding: 8px 15px; margin: 5px; border-radius: 5px; text-decoration: none; color: white; font-size: 14px; }
        .product-display-table td a.btn { background: #007bff; }
        .product-display-table td a.btn:hover { background: #0056b3; }
        .product-display-table td a.btn.delete { background: #dc3545; }
        .product-display-table td a.btn.delete:hover { background: #c82333; }
        footer {
    text-align: center;
    margin-top: 30px;
    padding: 10px;
    background-color: #333;
    color: #fff;
    font-size: 14px;
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
}
    </style>
</head>
<body>
    <nav>
        <div class="header">
            <a href="admin_page.php" class="logo">Admin Panel</a>
            <a href="admin_products.php" class="active">Products</a>
            <a href="product_orders.php">Orders</a>
            <a href="admin_contacts.php">Messages</a>
            <a href="admin_user.php">Users</a>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($message)) { echo '<p style="color:red;text-align:center;">' . $message . '</p>'; } ?>

        <div class="admin-product-form-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h3>Add a New Product</h3>
                <input type="text" placeholder="Enter product name" name="product_name" class="box" required>
                <input type="number" placeholder="Enter product price" name="product_price" class="box" required>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box" required>
                <input type="submit" class="btn" name="add_product" value="Add Product">
            </form>
        </div>

        <?php
        $select = mysqli_query($conn, "SELECT * FROM products");
        ?>
        <div class="product-display">
            <table class="product-display-table">
                <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>RS.<?php echo $row['price']; ?>/-</td>
                        <td>
                            <a href="product_update.php?edit=<?php echo $row['id']; ?>" class="btn">Edit</a>
                            <a href="admin_products.php?delete=<?php echo $row['id']; ?>" class="btn delete">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 EarGearHub - Admin Panel</p>
    </footer>
</body>
</html>
