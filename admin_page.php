<?php
@include 'config.php';
session_start();

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Prepared statement to prevent SQL Injection
   $stmt = $conn->prepare("SELECT * FROM user_form WHERE email = ?");
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if($result->num_rows > 0){
      $row = $result->fetch_assoc();

      // Verify password securely
      if(password_verify($password, $row['password'])){
         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('Location: admin_page.php');
            exit;
         } else {
            $_SESSION['user_name'] = $row['name'];
            header('Location: user_page.php');
            exit;
         }
      } else {
         $error = "Incorrect email or password!";
      }
   } else {
      $error = "Incorrect email or password!";
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
   <title>EarGearHub - Admin Panel</title>

   <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom Admin CSS -->
   <link rel="stylesheet" href="admin_style.css">
</head>
<body>

   <nav>
      <div class="header">
         <a href="admin_page.php" class="active">Admin Panel</a>
         <a href="admin_products.php">Products</a>
         <a href="product_orders.php">Orders</a>
         <a href="admin_contacts.php">Messages</a>
         <a href="admin_user.php">Users</a>
         <a href="logout.php" class="delete-btn">Logout</a>
      </div>
   </nav>

   <!-- Admin Dashboard -->
   <section class="dashboard">
      <h1 class="title">Dashboard</h1>
      <div class="box-container">
         <div class="box">
            <?php 
               $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query Failed');
               $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products; ?></h3>
            <p>Products Added</p>
         </div>

         <div class="box">
            <?php 
               $select_accounts = mysqli_query($conn, "SELECT * FROM `user_form`") or die('Query Failed');
               $number_of_accounts = mysqli_num_rows($select_accounts);
            ?>
            <h3><?php echo $number_of_accounts; ?></h3>
            <p>Total Accounts</p>
         </div>
      </div>
   </section>

   <script src="admin_script.js"></script>
   <footer>
      <p>&copy; 2025 EarGearHub - Admin Panel</p>
   </footer>

</body>
</html>
