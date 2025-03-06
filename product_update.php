<?php

@include 'config.php';

if(isset($_GET['edit'])){
   $id = $_GET['edit'];
} else {
   die('No product selected for editing!');
}

if(isset($_POST['update_product'])){

   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price)){
      $message[] = 'Please fill out all fields!';    
   } else {
      if(!empty($product_image)) {
         // Update with new image
         $update_data = "UPDATE products SET name='$product_name', price='$product_price', image='$product_image' WHERE id = '$id'";
         $upload = mysqli_query($conn, $update_data);
         
         if($upload){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
         }
      } else {
         // Update without changing the image
         $update_data = "UPDATE products SET name='$product_name', price='$product_price' WHERE id = '$id'";
         $upload = mysqli_query($conn, $update_data);
      }

      if($upload){
        echo"<script>alert('Order status updated successfully.');</scrip>";
         header('location:admin_products.php');
         exit;
      } else {
         $message[] = 'Failed to update product!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        nav {
            top: 0;
            position: fixed;
            width: 100%;
        }

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

        
        .container {
            width: 90%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        /* Admin Product Form Styles */
        .admin-product-form-container {
            margin-bottom: 40px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .admin-product-form-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .box {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .box:focus {
            outline: none;
            border-color: #007bff;
        }

        input[type="file"] {
            font-size: 14px;
            padding: 5px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }

        input[type="submit"] {
            background-color: #007bff;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Product Display Table Styles */
        .product-display {
            margin-top: 20px;
            overflow-x: auto;
        }

        .product-display-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
        }

        .product-display-table th, .product-display-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .product-display-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .product-display-table td img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .product-display-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-display-table tr:hover {
            background-color: #f1f1f1;
        }

        .product-display-table td a {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .product-display-table td a.btn {
            background-color: #007bff;
        }

        .product-display-table td a.btn:hover {
            background-color: #0056b3;
        }

        .product-display-table td a.btn.fa-trash {
            background-color: #dc3545;
        }

        .product-display-table td a.btn.fa-trash:hover {
            background-color: #c82333;
        }

        .product-display-table td a.btn.fa-edit {
            background-color: #ffc107;
        }

        .product-display-table td a.btn.fa-edit:hover {
            background-color: #e0a800;
        }


        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $msg){
         echo '<span class="message">'.$msg.'</span>';
      }
   }
?>

<div class="container">
   <div class="admin-product-form-container centered">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
      if(mysqli_num_rows($select) > 0){
         $row = mysqli_fetch_assoc($select);
   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update the Product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Enter the product name">
      <input type="number" min="0" class="box" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>" placeholder="Enter the product price">
      <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Update Product" name="update_product" class="btn">
      <a href="admin_page.php" class="btn">Go Back</a>
   </form>

   <?php 
      } else {
         echo "<p>Product not found!</p>";
      } 
   ?>

   </div>
</div>

</body>
</html>
