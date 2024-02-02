<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$ordersInfo = [];

if (isset($_POST['check']) && $_SESSION['if_employee'] == 1) {
    foreach ($_POST['status'] as $idorder => $status) {
        $updateStmt = $pdo->prepare("UPDATE `order` SET status = :status WHERE idorder = :idorder");
        $updateStmt->execute(['status' => $status, 'idorder' => $idorder]);
    }
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $isEmployee = isset($_SESSION['if_employee']) && $_SESSION['if_employee'] == 1;

    $orderQuery = $isEmployee ? "SELECT * FROM `order`" : "SELECT * FROM `order` WHERE iduser = :userId";
    $ordersStmt = $pdo->prepare($orderQuery);
    if (!$isEmployee) {
        $ordersStmt->bindValue(':userId', $userId);
    }
    $ordersStmt->execute();
    $orders = $ordersStmt->fetchAll();

    foreach ($orders as $order) {
        $totalPrice = 0;
        $totalQuantity = 0;


        $productOrdersStmt = $pdo->prepare("SELECT idproduct, quantity FROM `productord` WHERE idorder = :idorder");
        $productOrdersStmt->execute(['idorder' => $order['idorder']]);
        $productOrders = $productOrdersStmt->fetchAll();

        foreach ($productOrders as $productOrder) {

            $productStmt = $pdo->prepare("SELECT price FROM `product` WHERE id = :idproduct");
            $productStmt->execute(['idproduct' => $productOrder['idproduct']]);
            $product = $productStmt->fetch();

            $totalPrice += $productOrder['quantity'] * $product['price'];
            $totalQuantity += $productOrder['quantity'];
        }

        if ($isEmployee) {
            $userStmt = $pdo->prepare("SELECT username FROM users WHERE id = :iduser");
            $userStmt->execute(['iduser' => $order['iduser']]);
            $userResult = $userStmt->fetch();
            $userName = $userResult['username'] ;
        }

        $ordersInfo[] = [
            'idorder' => $order['idorder'],
            'userName' => $userName,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
            'status' => $order['status']
        ];
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
    <h1>Orders</h1>
    <form method="post" action="">
        <table class="table">
            <tr>
                <?php if ($isEmployee): ?>
                    <th>Name Of Customer</th>
                <?php endif; ?>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Total Quantity</th>
                <th>Status</th>
            </tr>
            <?php foreach ($ordersInfo as $order): ?>
                <tr>
                    <?php if ($isEmployee): ?>
                        <td><?php echo ($order['userName']); ?></td>
                    <?php endif; ?>
                    <td><a href="vieworder.php?idorder=<?php echo $order['idorder']; ?>"><?php echo ($order['idorder']); ?></a></td>
                    <td><?php echo ($order['totalPrice']); ?></td>
                    <td><?php echo ($order['totalQuantity']); ?></td>
                    <td>

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($isEmployee): ?>
            <input type="submit" class="search-update" value="Update Status" name="check">
        <?php endif; ?>
    </form>
</main>
</div>
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
