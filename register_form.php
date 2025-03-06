<?php
session_start(); // Start the session

@include 'config.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Handle database connection error
}

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists!';
   }else{
      if($pass != $cpass){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         
         if (mysqli_query($conn, $insert)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn); // Store user ID in session
            $_SESSION['user_type'] = $user_type; // Store user type in session
            header('location:login_form.php');
            exit();
         } else {
            $error[] = 'Registration failed. Please try again.';
         }
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
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="register.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,800;1,900&display=swap" rel="stylesheet">

</head>
<body>


   <nav>
        <div class="header">
            <a href="index.php" class="logo">EarGearHub</a>
            <a class="active" href="index.php">Home</a>
            <a href="#">Shop</a>
            <a href="#">Cart</a>
            <a href ="#"> About Us</a>
            <a href="#">Contact Us</a>
            <a class="active" href="login_form.php">Login</a>
        </div>
   </nav>
   
   <div class="form-container">

      <form action="" method="post">
         <h3>register now</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
         ?>
         <input type="text" name="name" required placeholder="enter your name">
         <input type="email" name="email" required placeholder="enter your email">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="password" name="cpassword" required placeholder="confirm your password">
         <select name="user_type">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>already have an account? <a href="login_form.php">login now</a></p>
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