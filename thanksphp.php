<?php
session_start();
include 'dbconfig.in.php';

if (!isset($_GET['orderId'])) {
    echo "Order ID not provided.";
    exit;
}

$orderId = $_GET['orderId'];
$userId = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Thank You For Your Order</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <header>
        <div class="header-content">
            <a href="Home.php">
                <img src="Palistine.jpg" alt="Store Logo" width="64" height="64" class="store-logo">
            </a>
            <div class="store-name">B-Store</div>
            <nav class="menu">
            </nav>
        </div>
    </header>
</head>
<body>
<form method="post" class="form">
    <div class="form-group">

    <h1>Thank You for Your Order!</h1>
    <p>Your order ID is: <?php echo ($orderId); ?></p>
    <p><a href="Home.php">Return to Home Page</a></p>
    </div>
</form>

</body>
<footer>
    <div class="footer-content">
        <img src="Palistine.jpg" alt="Store Logo" width="64" height="64" class="footer-logo">
        <div class="footer-address">
            <h3>Our Address</h3>
            <p>Al-tira, Ramallah, Palestine</p>
        </div>
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>Email: 1203295@student.birzeit.edu</p>
            <p>Phone: 0598082278</p>
        </div>
    </div>
</footer>
</html>

