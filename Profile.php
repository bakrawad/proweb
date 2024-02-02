<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$userid = $_SESSION['user_id'];
$data = [];

if ($userid) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = $userid");
    $stmt->execute();
    $data = $stmt->fetch();
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Personal profile</title>
    <link rel="stylesheet" href="style.css" type="text/css">
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
<form action="Home.php" class="form">
    <h2>Update Product</h2>

    <h3>Product Info</h3>
    <label for="name">Name:</label>
    <input type="text" id="name" class="input" name="name" value="<?php echo ($data['username']); ?>" readonly><br>

    <label for="id">Address:</label>
    <input type="text" id="id" class="input" name="id" value="<?php echo ($data['address']); ?>" readonly><br>

    <label for="quantity">email</label>
    <input type="text" id="quantity" class="input" name="quantity" value="<?php echo ($data['email']); ?>" readonly><br>

    <label for="phone">email</label>
    <input type="text" id="phone" class="input" name="phone" value="<?php echo ($data['phone']); ?>" readonly><br>

    <input type="submit" class="button" value="Return to the home page" name="updateProd">
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
