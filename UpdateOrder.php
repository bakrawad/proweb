<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$prods = [];
if (isset($_POST["searchOr"])) {
    $pname = $_POST["name"];
    $id = $_POST["id"];

    if ($pname != "")  {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE name = '$pname'");
        $stmt->execute();
    } elseif ($id != "") {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = $id");
        $stmt->execute();
    } else {
        $stmt = $pdo->query("SELECT * FROM product");
    }
    $prods = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM product");
    $prods = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
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
<form action="UpdateOrder.php" method="post" class="form">
    <h2>Update Product</h2>

    <h3>Product Info</h3>
    <label for="name">Name Of Product:</label>
    <input type="text" id="name" class="search-update" name="name" value="" >

    <label for="id">Product ID:</label>
    <input type="text" id="id" class="search-update" name="id" value="" >

    <table class="table">
        <tr>
            <th>Product Photo</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($prods as $prodData): ?>
            <tr>
                <td><img src="<?php echo ($prodData['photo']); ?>" alt="Product Image" width="64" height="64"/></td>
                <td><a href="update.php/?id=<?php echo ($prodData['id']); ?>"> <?php echo ($prodData['id']); ?></a></td>
                <td><?php echo ($prodData['name']); ?></td>
                <td><?php echo ($prodData['price']); ?></td>
                <td><?php echo ($prodData['quantity']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <input type="submit" class="button" value="Search" name="searchOr">
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
