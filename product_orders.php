<?php
session_start();
require 'config.php';

// Fetch orders from the database
$order_query = "SELECT * FROM orders ORDER BY created_at DESC";
$order_result = $conn->query($order_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status
    $update_query = "UPDATE orders SET payment_status = ? WHERE id = ?";
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param("si", $status, $order_id);
        if ($stmt->execute()) {
            echo "<script>alert('Order status updated successfully.'); window.location.href='product_orders.php';</script>";
        } else {
            echo "<script>alert('Failed to update order status.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="admin_style.css">
    <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /* Body and font settings */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }

            /* Header */
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

            /* Container */
            .delete-btn:hover {
                background-color: #c0392b;
            }

            /* Success and error messages */
            .success {
                color: #27ae60;
                background-color: #d4edda;
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 5px;
            }

            .error {
                color: #c0392b;
                background-color: #f8d7da;
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 5px;
            }

            /* Footer */
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


            footer p {
                margin: 0;
            }

.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
}

table th, table td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

table td {
    color: #333;
}

/* Form Styles */
form {
    display: inline-block;
    margin-top: 10px;
}

select {
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ddd;
    margin-right: 10px;
    width: 120px;
}

button {
    padding: 8px 15px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

button:active {
    background-color: #388e3c;
}

    </style>
</head>
<body>
    <nav>
        <div class="header">
            <a href="admin_page.php" class="logo">Admin Panel</a>
            <a href="admin_products.php">Products</a>
            <a href="product_orders.php" class="active">Orders</a>
            <a href="admin_contacts.php">Messages</a>
            <a href="admin_user.php">Users</a>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
    </nav>

    <div class="container">
    <h1>Admin - Order Management</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Grand Total</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($order_result->num_rows > 0) {
                while ($order = $order_result->fetch_assoc()) {
                    $order_id = $order['id'];
                    $user_name = $order['name'];
                    $user_email = $order['email'];
                    $grand_total = number_format($order['grand_total'], 2);
                    $payment_method = $order['payment_method'];
                    $payment_status = $order['payment_status'];
            ?>
            <tr>
                <td><?= $order_id; ?></td>
                <td><?= htmlspecialchars($user_name); ?></td>
                <td><?= htmlspecialchars($user_email); ?></td>
                <td>Rs. <?= $grand_total; ?>/-</td>
                <td><?= htmlspecialchars($payment_method); ?></td>
                <td><?= htmlspecialchars($payment_status); ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order_id; ?>">
                        <select name="status" required>
                            <option value="Pending" <?= ($payment_status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Completed" <?= ($payment_status == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            <option value="Shipped" <?= ($payment_status == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                        </select>
                        <button type="submit" name="update_status" class="btn">Update Status</button>
                    </form>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>



    <footer>
            <p>&copy; 2025 EarGearHub. All Rights Reserved.</p>
    </footer>

</body>
</html>
