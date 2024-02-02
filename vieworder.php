<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$productsDetails = [];

if (isset($_GET['idorder']) && !empty($_GET['idorder'])) {
    $idorder = $_GET['idorder'];


    $productOrdersStmt = $pdo->prepare("SELECT idproduct, quantity FROM `productord` WHERE idorder = :idorder");
    $productOrdersStmt->execute(['idorder' => $idorder]);
    $productOrders = $productOrdersStmt->fetchAll();


    foreach ($productOrders as $productOrder) {
        $productStmt = $pdo->prepare("SELECT id, name, price FROM `product` WHERE id = :idproduct");
        $productStmt->execute(['idproduct' => $productOrder['idproduct']]);
        $productDetails = $productStmt->fetch();

        if ($productDetails) {
            $productDetails['quantity'] = $productOrder['quantity'];
            $productsDetails[] = $productDetails;
        }
    }
} else {
    echo "Order ID is required.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <div class="header-content">
        <a href="Home.php">
            <img src="Palistine.jpg" alt="Store Logo" width="64" height="64" class="store-logo">
        </a>
        <div class="store-name">B-Store</div>
        <nav class="menu">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="Profile.php">Porfile</a></li>
                <li><a href="aboutus.php">About US</a></li>
                <li><a href="basket.php">Shopping basket</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li><a href="logout.php">Log Out</a></li>';
                } else {
                    echo '<li><a href="login.php">Log In</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
<main class="content">
    <h1>Order Details for Order ID: <?php echo ($idorder); ?></h1>
    <table class="table">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($productsDetails as $product): ?>
            <tr>
                <td><?php echo ($product['id']); ?></td>
                <td><?php echo ($product['name']); ?></td>
                <td><?php echo ($product['price']); ?></td>
                <td><?php echo ($product['quantity']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
<footer>
    <div class="footer-content">
        <img src="Palistine.jpg" alt="Store Logo" width="64" height="64" class="footer-logo">
        <div class="footer-address">
            <h3>Our Address</h3>
            <p> Al-tira, Ramallah, Palestine</p>
        </div>
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>Email: 1203295@student.birzeit.edu</p>
            <p>Phone: 0598082278</p>
        </div>
    </div>
</footer>
</html>
