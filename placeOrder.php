<?php
global $pdo;
session_start();
include 'dbconfig.in.php';

$prodid = isset($_GET['id']) ? $_GET['id'] : null;
$userid = $_SESSION['user_id'];
$data = [];
if ($prodid) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = $prodid");
    $stmt->execute();
    $data = $stmt->fetch();
}
if (isset($_POST["AddToBasket"])) {
    $enteredQuantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    if ($enteredQuantity <= $data['quantity']) {
        $stmt = $pdo->prepare("INSERT INTO basket(iduser,idproduct,quantity)VALUES (:iduser,:idproduct,:quantity)");
        $stmt->bindParam(':iduser', $userid);
        $stmt->bindParam(':idproduct', $prodid);
        $stmt->bindParam(':quantity', $enteredQuantity);
        $stmt->execute();

        header("Location: ../search.php");
        exit;
    } else {

        echo "Entered quantity exceeds available quantity.";
    }
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Profile</title>
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
<body id="home">
<form action="placeOrder.php?id=<?php echo ($prodid); ?>" method="post" class="form">
    <fieldset class="field" ">
    <?php

    echo '<img src="' .'http://localhost/Ass3/'. $data["photo"]. '" alt="Student img" width="128" height="128"/>';
    echo '<h2> Product ID: ' .$data["id"]. ' ,'.'Name: '.$data["name"].'</h2>';
    echo '<ul>';
    echo '<li><b>Price: </b>'.$data["price"].'</li>';
    echo '<li><b>Quantity: </b>'.$data["quantity"].'</li>';
    echo '<li><b>Category: </b>'.$data["category"].'</li>';
    echo '<li><b>Remark: </b>'.$data["remark"].'</li>';
    echo '<li><b>Description: </b>'.$data["description"].'</li>';
    echo '</ul>';
    echo '<br>';
    echo '<label for="quantity">Quantity:</label>';
    echo '<input type="number" name="quantity" id="quantity" class="search-update" value="1" required>
'
    ?>
    <input type="submit" class="button" value="Add To Basket" name="AddToBasket">
    </fieldset>
    </form >
</body>
<footer>
    <div class="footer-content">
        <img src="..//Palistine.jpg" alt="Store Logo" width="64" height="64" class="footer-logo">
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