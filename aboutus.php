<?php

@include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="aboutus.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="header">
            <a href="user_page.php" class="logo">EarGearHub</a>
            <a href="user_page.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="cart.php">Cart</a>
            <a class="active" href ="aboutus.php"> About Us</a>
            <a href="contactus.php">Contact Us</a>
            <a class="icons">
                <p id="menu-btn" class="fas fa-bars"></p>
                <p id="user-btn" class="fas fa-user"></p>
            </a>

            <div class="account-box">
                <p>Username: <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?></span></p>
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
<script>
    let accountBox = document.querySelector('.header .account-box');
   
    document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    accountBox.classList.remove('active');
    }

    document.querySelector('#user-btn').onclick = () =>{
    accountBox.classList.toggle('active');
    navbar.classList.remove('active');
    }

    window.onscroll = () =>{
    navbar.classList.remove('active');
    accountBox.classList.remove('active');
    }
</script>
        </div>
    </nav>
    <div class="about-us">
        <div class="container">
            <h1>About Us</h1>
            <section>
                <div>
                    <p>Welcome to <strong>Laptop World</strong>, your one-stop destination for the latest and greatest laptops. We are passionate about technology and committed to providing our customers with the best products and services.</p>
                    <p>Our mission is to make cutting-edge technology accessible to everyone. Whether you're a student, a professional, or a gaming enthusiast, we have the perfect laptop to meet your needs.</p>
                    <p>At Laptop World, we believe in quality, reliability, and customer satisfaction. Our team of experts carefully selects each product to ensure that you get the best value for your money.</p>
                    <p>Thank you for choosing Laptop World. We look forward to serving you and helping you find the perfect laptop for your lifestyle.</p>
                </div>
            </section> 
        </div>
    </div>
    <div id="feature" class="section-p1">
        <div class="fe-box">
            <img src="features/f2.png" alt="">
            <h6>Online Order </h6>
        </div>
        <div class="fe-box">
            <img src="features/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="features/f5.png" alt="">
            <h6>Happy Buyer</h6>
        </div>
        <div class="fe-box">
            <img src="features/f6.png" alt="">
            <h6>24/7 Support</h6>
        </div>
        
    </div>
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