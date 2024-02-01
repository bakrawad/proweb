<?php
session_start();

include 'dbconfig.in.php';


if(!isset($_SESSION["name"]) && !isset($_SESSION["address"]) && !isset($_SESSION["dob"]) && !isset($_SESSION["id_Number"]) && !isset($_SESSION["email"])
    && !isset($_SESSION["phone"]) && !isset($_SESSION["credit_card"]) && !isset($_SESSION["exp_date"]) && !isset($_SESSION["card_name"]) && !isset($_SESSION["bank"])) {

    header("location: signup.php");
}

if(isset($_POST["e_button"])) {
        if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];
            if($password == $confirm_password) {

                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
            

                header("location: confirm.php");
            } else {
                $err = "Passwords do not match";
            }
        } else {
            $err = "Please fill all the fields";
        }
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
<form action="Admin.php" method="post" class="form">
        <h3>Create E-account</h3>
        <label for="username">Username:</label>
        <input type="text" class="input" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" class="input" id="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" class="input" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" class="button" value="Create Account" name="e_button">
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