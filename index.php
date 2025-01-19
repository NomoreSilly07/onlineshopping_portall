<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EarGearHUb</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <!--nav bar-->
    <nav>
        <div class="header">
            <a href="index.php" class="logo">EarGearHub</a>
            <a class="active" href="index.php">Home</a>
            <a href="#">Shop</a>
            <a href="#">Cart</a>
            <a href ="#"> About Us</a>
            <a href="#">Contact Us</a>
            <a href="login_form">Login</a>
        </div>
    </nav>

    <!--conetent of the website-->
    <div class="container">
      <h4>The-Perfect-Series-Experience</h4>
      <h2>Get Super value deals</h2>
      <h1>On all Laptops</h1>
      <p>Save more with coupons & up to 30% off!</p>
      <button>Order Now</button>
    
    </div>


    <!--Product-->
    <div id="laptop" class="section-p1">
        <h2>Top 6 Best Laptops</h2>
        <p>Unlock Your Creativity</p>
        <div class="pro-container">

            <!-- Acer -->
            <div class="pro">
                <img src="img/acer.jpg" alt="">
                <div class="des">
                    <span>Acer</span>
                    <h5>Acer 7 pro</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 780000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- MacBooK -->
            <div class="pro">
                <img src="img/mac.jpg" alt="">
                <div class="des">
                    <span>Apple</span>
                    <h5>MacBook 2 pro</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 150000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- Dell -->
            <div class="pro">
                <img src="img/dell.jpg" alt="">
                <div class="des">
                    <span>Dell</span>
                    <h5>Dell Latitude 4600</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 590000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- Asus -->
            <div class="pro">
                <img src="img/asus.jpg" alt="">
                <div class="des">
                    <span>Asus</span>
                    <h5>Asus 8 pro</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 990000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- Lenovo -->
            <div class="pro">
                <img src="img/lenovo.jpg" alt="">
                <div class="des">
                    <span>Lenovo</span>
                    <h5>Lenovo 12th Generation</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 680000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- Samsung-->
            <div class="pro">
                <img src="img/samsung.jpg" alt="">
                <div class="des">
                    <span>Samsung</span>
                    <h5>Samsung 11th Generation</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 880000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            
            <!-- MacBook -->
            <div class="pro">
                <img src="img/mac1.jpg" alt="">
                <div class="des">
                    <span>Apple</span>
                    <h5>MacBook M2 pro</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 2250000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- Asus -->
            <div class="pro">
                <img src="img/asus2.jpg" alt="">
                <div class="des">
                    <span>Asus</span>
                    <h5>Asus 9 pro</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 110000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
        </div>
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