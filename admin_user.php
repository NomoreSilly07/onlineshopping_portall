<?php
@include 'config.php'; 

session_start();

// Check if the delete action is requested
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Prepare the delete query to avoid SQL injection
    if ($stmt = $conn->prepare("DELETE FROM `user_form` WHERE user_id = ?")) {
        $stmt->bind_param("i", $delete_id); // "i" means integer type
        $stmt->execute();

        // Check if deletion was successful
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "User deleted successfully!";
        } else {
            $_SESSION['message'] = "Error: Unable to delete user or user not found.";
        }

        $stmt->close(); // Close the statement
    } else {
        $_SESSION['message'] = "Error preparing the query.";
    }

    header('Location: admin_user.php'); // Redirect to the users page
    exit(); // Ensure the script stops after the redirect
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom admin CSS file link -->
    <link rel="stylesheet" href="css/admin_style.css">
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

/* Container */
.container {
    max-width: 1000px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #333;
    color: #fff;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Table Actions (Delete button) */
.delete-btn {
    background-color: #e74c3c;
    color: white;
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

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
/* Section Container */
.users {
   max-width: 1200px;
   margin: 0 auto;
   padding: 20px;
   background-color: #fff;
   border-radius: 8px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.title {
   font-size: 28px;
   font-weight: bold;
   margin-bottom: 20px;
   text-align: center;
   color: #444;
}

/* Box Container */
.box-container {
   display: grid;
   grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
   gap: 20px;
   justify-items: center;
}

.box {
   background-color: #f9f9f9;
   padding: 20px;
   border-radius: 8px;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
   width: 100%;
   text-align: center;
}

.box p {
   margin: 10px 0;
   font-size: 16px;
}

.box p span {
   font-weight: bold;
   color: #555;
}

.box .delete-btn {
   display: inline-block;
   background-color: #e74c3c;
   color: #fff;
   padding: 8px 15px;
   margin-top: 10px;
   text-decoration: none;
   border-radius: 4px;
   font-size: 14px;
   transition: background-color 0.3s ease;
}

.box .delete-btn:hover {
   background-color: #c0392b;
}

/* User Type Styling */
.box p span[style*="color: var(--orange)"] {
   color: #e67e22;
}
    </style>
</head>
<body>
    <nav>
        <div class="header">
            <a href="admin_page.php" class="logo">Admin Panel</a>
            <a href="admin_products.php">Products</a>
            <a href="product_orders.php">Orders</a>
            <a href="admin_contacts.php">Messages</a>
            <a href="admin_user.php" class="active">Users</a>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
    </nav>

    <section class="users">
        <h1 class="title">User Accounts</h1>

        <div class="box-container">
            <?php
                // Fetch all users from the database
                $select_users = mysqli_query($conn, "SELECT * FROM `user_form`") or die('Query failed');
                while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?>
            <div class="box">
                <p> User ID : <span><?php echo $fetch_users['user_id']; ?></span> </p>
                <p> Username : <span><?php echo $fetch_users['name']; ?></span> </p>
                <p> Email : <span><?php echo $fetch_users['email']; ?></span> </p>
                <p> User Type : <span style="color:<?php if ($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
                <a href="admin_user.php?delete=<?php echo $fetch_users['user_id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete User</a>
            </div>
            <?php } ?>
        </div>

    </section>

    <!-- Success/Error Message Display -->
    <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="message">';
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            echo '</div>';
        }
    ?>

    <footer>
        <p>&copy; 2025 EarGearHub - Admin Panel</p>
    </footer>
</body>
</html>