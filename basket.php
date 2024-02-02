<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$userId = $_SESSION['user_id'];

if (isset($_POST["search"])) {
    if (!empty($_POST['selectedIds'])) {

        $order = $pdo->prepare("INSERT INTO `order` (iduser, status) VALUES (:iduser, 'Waiting For Processing')");
        $order->execute(['iduser' => $userId]);

        $stmt = $pdo->prepare("SELECT MAX(idorder) AS maxId FROM `order`");

        $stmt->execute();


        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        $orderId = $result['maxId'];


        foreach ($_POST['selectedIds'] as $id) {

            $basketStmt = $pdo->prepare("SELECT quantity FROM basket WHERE iduser = $userId AND idproduct = $id");
            $basketStmt->execute();
            $basketItem = $basketStmt->fetch();
            $quantity = $basketItem ? $basketItem['quantity'] : 1;

            $productOrder = $pdo->prepare("INSERT INTO `productord` (idorder, idproduct, quantity) VALUES (:idorder, :idproduct, :quantity)");
            $productOrder->execute(['idorder' => $orderId, 'idproduct' => $id, 'quantity' => $quantity]);

            $stmt = $pdo->prepare("DELETE FROM basket WHERE iduser = $userId AND idproduct = $id");
            $stmt->execute();
        }

        header("Location: thanksphp.php?orderId=$orderId");
        exit;
    }
} else {
    $prods = [];

    $basketStmt = $pdo->prepare("SELECT idproduct, quantity FROM basket WHERE iduser = $userId");
    $basketStmt->execute();
    $basketItems = $basketStmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($basketItems as $item) {
        $productStmt = $pdo->prepare("SELECT * FROM product WHERE id = :productId");
        $productStmt->execute(['productId' => $item['idproduct']]);
        $productDetails = $productStmt->fetch(PDO::FETCH_ASSOC);
        if ($productDetails) {
            $productDetails['quantity'] = $item['quantity'];
            $prods[] = $productDetails;
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
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

        </nav>
    </div>
</header>
    <main class="content">
        <h1>Bakr</h1>
        <form method="post" action="basket.php">
            <table class="table">
                <tr>
                    <th>Check box</th>
                    <th>Product Photo</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php foreach ($prods as $prodData): ?>
                    <tr>
                        <td><input type="checkbox" name="selectedIds[]" value="<?php echo ($prodData['id']); ?>"></td>
                        <td>
                            <img src="<?php echo ($prodData['photo']); ?>" alt="Product Photo" width="64" height="64"/>
                        </td>
                        <td><?php echo ($prodData['id']); ?></td>
                        <td><?php echo ($prodData['name']); ?></td>
                        <td><?php echo ($prodData['price']); ?></td>
                        <td>
                            <input type="number" name="quantity[<?php echo ($prodData['id']); ?>]" value="<?php echo ($prodData['quantity']); ?>" min="1" style="width: 60px;">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" class="search-update" value="Check Out" name="search">
        </form>


    </main>
</div>
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

