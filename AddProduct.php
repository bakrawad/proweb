<?php
include 'dbconfig.in.php';

if (isset($_POST["addPro"])) {

    if($_FILES["photo"]["error"] != 0) {
        echo "error with the photo uploaded";
    } else {
        $stmt = $pdo->prepare("INSERT INTO product (`name`, `description`, `category`, `price`, `quantity`, `remark`, `photo`) VALUES (:name, :description, :category, :price, :quantity, :remark, :photo)");
        $stmt->bindParam(':name', $_POST["name"]);
        $stmt->bindParam(':description', $_POST["description"]);
        $stmt->bindParam(':category', $_POST["category"]);
        $stmt->bindParam(':price', $_POST["price"]);
        $stmt->bindParam(':quantity', $_POST["quantity"]);
        $stmt->bindParam(':remark', $_POST["remark"]);
        $stmt->bindParam(':photo', $_POST["photo"]);

        $stmt->execute();

        $stmt = $pdo->prepare("SELECT MAX(id) AS maxId FROM product");

        $stmt->execute();

        $res = $stmt->fetch();

        $maxId = $res['maxId'];

        function moveFile($fileToMove, $destination, $maxId, $pdo)
        {
            $newFile = "images/" . $maxId . $destination;
            move_uploaded_file($fileToMove, $newFile);

            $stmt = $pdo->prepare("UPDATE product set photo	= ' $newFile ' where id = " . $maxId);
            $stmt->execute();
        }

        $clientName = $_FILES["photo"]["name"];
        $serverName = $_FILES["photo"]["tmp_name"];

        moveFile($serverName, $clientName, $maxId, $pdo);;

        header("Location: Home.php");
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
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
<body >
<form action="AddProduct.php" method="post" class="form" enctype="multipart/form-data">
    <h2>Add Product</h2>

    <h3>Product Info</h3>
    <label for="name">Name Of Order:</label>
    <input type="text" id="name" class="input" name="name" value="" required><br>

    <label for="description">Description:</label>
    <input type="text" id="description" class="input" name="description" placeholder="This Product is good ..." value="" required><br>

    <label for="category">Category:</label>
    <input type="text" id="category" name="category" class="input" required value=""><br>

    <label for="price">Price:</label>
    <input type="text" id="price" class="input" name="price" required value=""><br>

    <label for="quantity">Quantity:</label>
    <input type="text" id="quantity" name="quantity" class="input" required value=""><br>

    <label for="remark">Remark:</label>
    <input type="text" id="remark" name="remark" class="input" required value=""><br>

    <label for="Photo">Choose Photo:</label>
    <input type="file" id="photo" name="photo" class="input">


    <input type="submit" class="button" value="Next Step" name="addPro">
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
