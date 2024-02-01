<?php
session_start();
include 'dbconfig.in.php';

if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['if_employee'] = $user['if_employee'];
        header("Location: Home.php");
        exit();
    } else {

        echo "Login failed. Please check your credentials.";
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
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
    <img src="Palistine.jpg" alt="logo" class="loginLogo" width="70" height="70">

    <form method="post" action="login.php" class="form">
        <h2>Login Form</h2>
        <div class="form-group">
            <label for="uname"><b>Username</b></label>
            <input type="text" class="input" placeholder="Enter Username" name="uname" required>
        </div>

        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="input" placeholder="Enter Password" name="password" required>
        </div>


        <div class="form-group">
            <label><a href="signup.php">If you don't have an account?</a></label>
        </div>

        <div class="form-group">
            <input type="submit" name="login" class="button" value="Login">
        </div>
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
