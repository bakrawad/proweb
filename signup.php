<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'hello';
    if(isset($_POST["signup_b"])) {

            if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["dob"]) && isset($_POST["id_Number"]) && isset($_POST["email"])
                && isset($_POST["phone"]) && isset($_POST["credit_card"]) && isset($_POST["exp_date"]) && isset($_POST["name_card"]) && isset($_POST["bank"])) {
                $name = $_POST["name"];
                $address = $_POST["address"];
                $dob = $_POST["dob"];
                $id_Number = $_POST["id_Number"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $credit_card = $_POST["credit_card"];
                $exp_date = $_POST["exp_date"];
                $name_card = $_POST["name_card"];
                $bank = $_POST["bank"];
                
                $_SESSION["name"] = $name;
                $_SESSION["address"] = $address;
                $_SESSION["dob"] = $dob;
                $_SESSION["id_Number"] = $id_Number;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
                $_SESSION["credit_card"] = $credit_card;
                $_SESSION["exp_date"] = $exp_date;
                $_SESSION["name_card"] = $name_card;
                $_SESSION["bank"] = $bank;
                
                
                header("Location: Admin.php");
                
            } else {
                echo'Please fill all the fields';
            }
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
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
    <form action="signup.php" method="post" class="form">
        <h2>Customer Registration</h2>

        <h3>Customer Info</h3>
        <label for="name">Name:</label>
        <input type="text" id="name" class="input" name="name" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" class="input" name="address" placeholder="Flat/House No, Street" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" class="input" required value="<?php if(isset($_POST['dob'])) { echo $_POST['dob']; } ?>"><br>

        <label for="id_Number">ID Number:</label>
        <input type="text" id="id_Number" class="input" name="id_Number" required value="<?php if(isset($_POST['id_Number'])) { echo $_POST['id_Number']; } ?>"><br>

        <label for="email">E-mail Address:</label>
        <input type="email" id="email" name="email" class="input" required value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"><br>

        <label for="phone">phone:</label>
        <input type="tel" id="phone" name="phone" class="input" required value="<?php if(isset($_POST['phone'])) { echo $_POST['phone']; } ?>"><br>

        <h3>Credit Card Details</h3>
        <label for="credit_card">Card Number:</label>
        <input type="text" id="credit_card" name="credit_card" class="input" required><br>

        <label for="exp_date">Expiration Date:</label>
        <input type="month" id="exp_date" name="exp_date" class="input" required><br>

        <label for="name_card">Name on Card:</label>
        <input type="text" id="name_card" name="name_card" class="input" required><br>

        <label for="bank">Bank Issued:</label>
        <input type="text" id="bank" name="bank" class="input" required><br>

        <input type="submit" class="button" value="Next Step" name="signup_b">
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
