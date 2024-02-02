<?php
session_start();
include 'dbconfig.in.php';
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
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="Profile.php">Porfile</a></li>
                <li><a href="#About">About US</a></li>
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
<div class="container">
    <div class="sidebar">
        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="Home.php" class="search">Main Page</a>';
            echo '<a href="search.php" class="search">Search</a>';
            echo '<a href="order.php" class="view-order">View Order</a>';
            if (isset($_SESSION['if_employee']) && $_SESSION['if_employee'] == 1) {
                echo '<a href="UpdateOrder.php" class="view-order">Update Product</a>';
                echo '<a href="AddProduct.php" class="view-order">Add Product</a>';
                }
        }

            $baseSQL = 'SELECT * FROM product';

            if (isset($_GET['sortBy'])) {
                switch ($_GET['sortBy']) {
                    case 'name':
                        $sql = $baseSQL . ' ORDER BY name';
                        break;
                    case 'id':
                        $sql = $baseSQL . ' ORDER BY id';
                        break;
                    case 'quantity':
                        $sql = $baseSQL . ' ORDER BY quantity';
                        break;
                    default:
                        $sql = $baseSQL;
                }
            } else {
                $sql = $baseSQL;
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll();

        ?>

    </div>

    <main class="content">
      <h1>Bakr</h1>
        <table class="table">
            <tr>
                <td><a href="Home.php?sortBy=name"> Name </a></td>
                <td><a href="Home.php?sortBy=ID"> Reference ID </a></td>
                <td><a href="Home.php?sortBy=quantity"> Quantity </a></td>
                <td>Image </td>
            </tr>
            <?php  foreach ($products as $product) {?>
            <tr>
                <th><?php echo $product['name']; ?></th>
                <th><?php echo $product['id']; ?></th>
                <th><?php echo $product['quantity']; ?></th>
                <th><?php echo $product['photo']; ?></th>
            </tr>
            <?php } ?>
        </table>
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
