<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    
</head>
<body>
    <nav>
        <div class="header">
            <a href="user_page.php" class="logo">EarGearHub</a>
            <a href="user_page.php">Home</a>
            <a class="active" href="shop.php">Shop</a>
            <a href="cart.php">Cart</a>
            <a href ="aboutus.php"> About Us</a>
            <a href="contactus.php">Contact Us</a>
            <a class="icons">
                <p id="menu-btn" class="fas fa-bars"></p>
                <p id="user-btn" class="fas fa-user"></p>
            </a>

            <div class="account-box">
                <a href="logout.php" class="delete-btn">logout</a>
                <div>new <a href="login_form.php">login</a> | <a href="register_form.php">register</a></div>
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



    <div id="laptop" class="section-p1">
        <!-- <input type="text" name="text" class="inputsearch" placeholder="Search here..."> -->
        <!-- <button class="search">search</button> -->
        <h2>New Product</h2>
        <p>Unlock Your Creativity</p>

        <div class="pro-container">

            <?php 
            require 'config.php';

            $query = "SELECT * FROM products";
            $query_run = mysqli_query($conn,$query);
            $check_products = mysqli_num_rows($query_run) > 0;

            if($check_products){
                while($row = mysqli_fetch_assoc($query_run))
                {
                    ?>
                    <div class="pro">
                        <img src="uploaded_img/<?php echo $row['image']; ?>" alt="product images">
                        <div class="des">
                            <h5> <?php echo $row['name']; ?> </h5>
                            <div class="star">
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                                <li class="fas fa-star"></li>
                            </div>
                            <h4><?php echo $row['price']; ?></h4>
                        </div>
                        <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                    </div>
                    <?php
                }
            }
            else{
                echo "No Product Found";
            }
            ?>

        </div>
    </div>


     <!--Product-->
     <div id="laptop" class="section-p1">
        <h2>Top Selling Product</h2>
        <p>Buy & Save Time</p>

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

            <!-- MacBook -->
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
                    <h4>Rs 165000</h4>
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

            <!-- MacBook -->
            <div class="pro">
                <img src="img/mac2.jpg" alt="">
                <div class="des">
                    <span>Apple</span>
                    <h5>MacBook pro</h5>
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

            <!-- Samsung -->
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

             <!-- Acer -->
             <div class="pro">
                <img src="img/acer2.jpg" alt="">
                <div class="des">
                    <span>Acer</span>
                    <h5>Acer Gaming 8gb GraphicsCard</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 1250000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>

            <!-- Dell -->
            <div class="pro">
                <img src="img/dell2.jpg" alt="">
                <div class="des">
                    <span>Dell</span>
                    <h5>Dell i7 pro</h5>
                    <div class="star">
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                        <li class="fas fa-star"></li>
                    </div>
                    <h4>Rs 790000</h4>
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
            <!-- MacBook -->
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
                    <h4>Rs 165000</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
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