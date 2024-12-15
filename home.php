<?php
session_start();
require('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <!-- Navbar -->
    <?php include('inc/navbar.inc.php'); ?>

    <div class="home-page">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1>Connecting Farmers, Feeding the Future.</h1>
            <a href="products.php" class="shop-now-button">Shop Now!</a>
        </div>

        <!-- Promotion Section -->
        <div class="promotion-section">
            <h2>PROMOTION! 11.11</h2>
            <a href="products.php" class="shop-now-button">Shop Now!</a>
        </div>

        <!-- Why Choose Us Section -->
        <div class="why-choose-us-section">
            <h2>The reasons</h2>
            <h3>Why Choose Us?</h3>
            <div class="video-wrapper">
                <div class="play-button">
                    <img src="img/play-icon.svg" alt="Play Video">
                </div>
            </div>
        </div>

        <!-- Supplier Section -->
        <div class="supplier-section">
            <h2>Our Supplier</h2>
            <h3>Sustainable Farms</h3>
            <div class="supplier-logos">
                <img src="img/sunwayxfarms-logo-small-300x149-1.png" alt="Sunway Farms Logo">
                <img src="img/untitled-1.png" alt="Urban Hijau Logo">
                <img src="img/untitled-2.png" alt="Cultiveat Logo">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('inc/footer.inc.php'); ?>
</body>

</html>