<?php
session_start();

include 'dbconfig.in.php';


if (isset($_POST["submitAccount"])) {


    $stmt = $pdo->prepare("INSERT INTO users (`name`, `address`, `dob`, `id_Number`, `email`, `phone`, `credit_card`, `exp_date`, `name_card`, `bank`, `username`, `password`, `if_employee`) VALUES (:name, :address, :dob, :id_Number, :email, :phone, :credit_card, :exp_date, :name_card, :bank, :username, :password, :if_employee)");


    $stmt->bindParam(':name', $_POST["name"]);
    $stmt->bindParam(':address', $_POST["address"]);
    $stmt->bindParam(':dob', $_POST["dob"]);
    $stmt->bindParam(':id_Number', $_POST["id_Number"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':phone', $_POST["phone"]);
    $stmt->bindParam(':credit_card', $_POST["credit_card"]);
    $stmt->bindParam(':exp_date', $_POST["exp_date"]);
    $stmt->bindParam(':name_card', $_POST["name_card"]);
    $stmt->bindParam(':bank', $_POST["bank"]);
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->bindParam(':password', $_POST["password"]);

    $if_employee = 0;
    $stmt->bindParam(':if_employee', $if_employee);

    $stmt->execute();

    header("Location: login.php");
    exit;
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Customer Registration</title>
    <link rel="stylesheet" href="style.css">
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
    <h2>Customer Registration</h2>
    <form action="confirm.php" method="post" class="form">

        <h3>Customer Info</h3>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="input" value="<?php if (isset($_SESSION['name'])) {
            echo $_SESSION['address'];
        } ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" class="input" placeholder="Flat/House No, Street"
            value="<?php if (isset($_SESSION['address'])) {
                echo $_SESSION['address'];
            } ?>" required><br>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" class="input" required
            value="<?php if (isset($_SESSION['dob'])) {
                echo $_SESSION['dob'];
            } ?>"><br>

        <label for="id_Number">ID Number:</label>
        <input type="text" id="id_Number" name="id_Number" class="input" required
            value="<?php if (isset($_SESSION['id_Number'])) {
                echo $_SESSION['id_Number'];
            } ?>"><br>

        <label for="email">E-mail Address:</label>
        <input type="email" id="email" name="email" class="input" required
            value="<?php if (isset($_SESSION['email'])) {
                echo $_SESSION['email'];
            } ?>"><br>

        <label for="phone">phone:</label>
        <input type="tel" id="phone" name="phone" class="input" required
            value="<?php if (isset($_SESSION['phone'])) {
                echo $_SESSION['phone'];
            } ?>"><br>

        <h3>Credit Card Details</h3>
        <label for="credit_card">Card Number:</label>
        <input type="text" id="credit_card" name="credit_card" class="input" required  value="
        <?php if (isset($_SESSION['credit_card'])) {
                echo $_SESSION['credit_card'];
            } ?>"><br>

        <label for="exp_date">Expiration Date:</label>
        <input type="month" id="exp_date" name="exp_date" class="input" required value="
        <?php if (isset($_SESSION['exp_date'])) {
                echo $_SESSION['exp_date'];
            } ?>"><br>

        <label for="name_card">Name on Card:</label>
        <input type="text" id="name_card" name="name_card" class="input" required value="
        <?php if (isset($_SESSION['name_card'])) {
                echo $_SESSION['name_card'];
            } ?>"><br>

        <label for="bank">Bank Issued:</label>
        <input type="text" id="bank" name="bank" class="input" required value="
        <?php if (isset($_SESSION['bank'])) {
                echo $_SESSION['bank'];
            } ?>"><br>

        <h3>Create E-account</h3>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="input" required value="
        <?php if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
            } ?>"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="input" required value="
        <?php if (isset($_SESSION['password'])) {
                echo $_SESSION['password'];
            } ?>"><br>

        <input type="submit" value="Next Step" class="button" name="submitAccount">
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