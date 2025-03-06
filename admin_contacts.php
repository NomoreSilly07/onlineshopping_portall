<?php
@include 'config.php';
session_start();


// Handle message deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Message deleted successfully!";
    } else {
        $error_message = "Failed to delete message: " . mysqli_error($conn);
    }
}

// Fetch all messages from the contact_messages table
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Messages</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        /* Basic reset */
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

.container {
    width: 80%;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
}

/* Success and Error Message */
.success, .error {
    padding: 10px;
    margin-bottom: 20px;
    text-align: center;
    font-size: 16px;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
}

table th, table td {
    padding: 15px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #f2f2f2;
    font-weight: bold;
    font-size: 16px;
}

table td {
    font-size: 14px;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

table td a.delete-btn {
    color: #d9534f;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    padding: 5px;
    border-radius: 3px;
    transition: background-color 0.3s;
}

table td a.delete-btn:hover {
    background-color: #f2dede;
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

    </style>
</head>
<body>
<nav>
        <div class="header">
            <a href="admin_page.php"" class="logo">Admin Panel</a>
            <a href="admin_products.php">products</a>
            <a href="product_orders.php">orders</a>
            <a href="admin_contacts.php" class="active">Messages</a>
            <a href="admin_user.php">Users</a>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Contact Messages</h2>

        <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (!empty($error_message)) echo "<p class='error'>$error_message</p>"; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?')" class="delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2025 EarGearHub - Admin Panel</p>
    </footer>
</body>
</html>
