<?php
@include 'config.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into contact_messages table
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Message sent successfully!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="contactus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="header">
            <a href="user_page.php" class="logo">EarGearHub</a>
            <a href="user_page.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="cart.php">Cart</a>
            <a href="aboutus.php"> About Us</a>
            <a class="active" href="contactus.php">Contact Us</a>
            <a class="icons">
                <p id="menu-btn" class="fas fa-bars"></p>
                <p id="user-btn" class="fas fa-user"></p>
            </a>

            <div class="account-box">
                <p>Username: <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?></span></p>
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <main class="row">
            <section class="col left">
                <div class="contactTitle">
                    <h2>Get In Touch</h2>
                    <p>You Can Contact Us via Social Media or Send Us a Message Below</p>
                </div>

                <div class="contactInfo">
                    <div class="iconGroup">
                        <div class="icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="details"><span>Phone</span><span>+977 9849434543</span></div>
                    </div>

                    <div class="iconGroup">
                        <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="details"><span>Email</span><span>eargearhub77@gmail.com</span></div>
                    </div>

                    <div class="iconGroup">
                        <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="details"><span>Location</span><span>Thimi, Bhaktapur</span></div>
                    </div>
                </div>

                <div class="c-socialMedia">
                    <a href="https://www.facebook.com/share/19LSYsUPht/"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="http://wa.me/9779749211185"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/eargear_hub"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </section>

            <section class="col right">
                <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>
                <?php if (!empty($error_message)) echo "<p class='error'>$error_message</p>"; ?>

                <form class="messageForm" method="POST" action="">
                    <div class="inputGroup halfWidth">
                        <input type="text" name="name" required>
                        <label>Your Name</label>
                    </div>

                    <div class="inputGroup halfWidth">
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>

                    <div class="inputGroup fullWidth">
                        <input type="text" name="subject" required>
                        <label>Subject</label>
                    </div>

                    <div class="inputGroup fullWidth">
                        <textarea name="message" required></textarea>
                        <label>Say Something</label>
                    </div>

                    <div class="inputGroup fullWidth">
                        <button type="submit">Send Message</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p>Email: eargearhub77@gmail.com</p>
                <p>Phone: +977 9849434541</p>
                <p>Address: Thimi, Bhaktapur</p>
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
                <ul class="socialMedia">
                    <li><a href="https://www.facebook.com/share/19LSYsUPht/"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="http://wa.me/9779749211185"><i class="fa-brands fa-whatsapp"></i></a></li>
                    <li><a href="https://www.instagram.com/eargear_hub"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2025 EarGearHub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
