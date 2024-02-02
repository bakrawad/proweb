<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$prodid = isset($_GET['id']) ? $_GET['id'] : null;
$data = [];

if ($prodid) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = $prodid");
    $stmt->execute();
    $data = $stmt->fetch();
}

if (isset($_POST["updateProd"])) {
    $prodid = $_POST['id'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("UPDATE product SET quantity = $quantity WHERE id = $prodid");
    $stmt->execute();

    header("Location: ../UpdateOrder.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="../style.css" type="text/css">
    <header>
        <div class="header-content">
            <a href="../Home.php">
                <img src="../Palistine.jpg" alt="Store Logo" width="64" height="64" class="store-logo">
            </a>
            <div class="store-name">B-Store</div>
            <nav class="menu">
            </nav>
        </div>
    </header>
</head>
<body>
<form action="update.php?id=<?php echo ($prodid); ?>" method="post" class="form">
    <h2>Update Product</h2>

    <h3>Product Info</h3>
    <label for="name">Name Of Product:</label>
    <input type="text" id="name" class="input" name="name" value=
    "<?php echo ($data['name']); ?>" readonly><br>

    <label for="id">Product ID:</label>
    <input type="text" id="id" class="input" name="id" value=
    "<?php echo ($data['id']); ?>" readonly><br>


    <label for="quantity">Quantity</label>
    <input type="text" id="quantity" class="input" name="quantity" value=
    "<?php echo ($data['quantity']); ?>"><br>

    <input type="submit" class="button" value="Update" name="updateProd">
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
