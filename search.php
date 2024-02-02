<?php
global $pdo;
session_start();
include 'dbconfig.in.php';
$prods = [];
if (isset($_POST["search"])) {
    $name = $_POST["name"];
    $id = $_POST["id"];

    $min = $_POST["min"];
    $max = $_POST["max"];

    if (!empty($name)) {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE name = $name");
        $stmt->execute();
    } elseif (!empty($id)) {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = $id");
        $stmt->execute();
    }elseif (!empty($min)) {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE price > $min");
        $stmt->execute();
        if (!empty($max)) {
            $stmt = $pdo->prepare("SELECT * FROM product WHERE price < $max AND price > $min");
            $stmt->execute();
        }
    }elseif (!empty($max)) {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE price < $max");
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
    <title>Search Product</title>
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
<form action="search.php" method="post" class="form">
    <h2>Search Product</h2>

    <h3>Product Info</h3>
    <label for="name">Name Of Product:</label>
    <input type="text" id="name" class="search-update" name="name" value="" >

    <label for="id">Product ID:</label>
    <input type="text" id="id" class="search-update" name="id" value="" ><br>

    <label for="min">Min Price:</label>
    <input type="number" id="min" class="search-update" name="min" value="" >

    <label for="max">MIX Price:</label>
    <input type="number" id="max" class="search-update" name="max" value="" >

    <table class="table">
        <tr>
            <th>Product Photo</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($prods as $prodData) {?>
            <tr>
                <td><img src="<?php echo ($prodData['photo']); ?>" alt="Product Image" width="64" height="64"/></td>
                <td><a href="placeOrder.php/?id=<?php echo ($prodData['id']); ?>"> <?php echo ($prodData['id']); ?></a></td>
                <td><?php echo ($prodData['name']); ?></td>
                <td><?php echo ($prodData['price']); ?></td>
                <td><?php echo ($prodData['quantity']); ?></td>
            </tr>
        <?php } ?>
    </table>

    <input type="submit" class="button" value="Search" name="search">
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

