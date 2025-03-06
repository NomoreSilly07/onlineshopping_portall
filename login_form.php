<?php

@include 'config.php';

session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Handle database connection error
}

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['password'] === $pass) { // Check password after selecting the user
         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
            exit();
         } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
            exit();
         }
      } else {
         $error[] = 'Incorrect email or password!';
      }

   } else {
      $error[] = 'Incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="login.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

   <nav>
        <div class="header">
        <a href="index.php" class="logo">EarGearHub</a>
            <a class="active" href="index.php">Home</a>
            <a class="Link" href="#">Shop</a>
            <a class="Link" href="#">Cart</a>
            <a class="Link" href ="#"> About Us</a>
            <a class="Link" href="#">Contact Us</a>
            <a class="active" href="login_form.php">Login</a>
        </div>
        <script>
            let link =document.querySelector("Link");
            link.addEventListener("click", function(event){
               alert("Please Login First");
               event.preventDefault();
            });
        </script>
   </nav>
   <div class="form-container">

      <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
      </form>

   </div>
   <!--footer-->
   <footer>
        <div class="footer-container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p>Email:eargearhub77@gmail.com</p>
                <p>Phone:+977 9849434541</p>
                <p>Address:Thimi,Bhaktapur</p>
            </div>
            <div class="footer-content">
                <h3>Quick Links</h3>
                 <ul class="list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                 </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul type="none" class="socialMedia">
					<li><a href="https://www.facebook.com/share/19LSYsUPht/?mibextid=wwXIfr"><i class="fa-brands fa-facebook-f"></i></a></li>
					<li><a href="http://wa.me/9779749211185"><i class="fa-brands fa-whatsapp"></i></a></li>
					<li><a href="https://www.instagram.com/eargear_hub?igsh=MXFydXl0c2wwMHhoMg=="><i class="fa-brands fa-instagram"></i></a></li>
				</ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2025 eargearhub . All rights reserved</p>
        </div>
    </footer>
</body>
</html>