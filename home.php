<?php
include('inc/session.inc.php');
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
            <img src="img/landscape2.jpg" alt="Hero Landscape" class="background-image">
            <div class="overlay-content">
                <h1>Connecting Farmers, Feeding the Future.</h1>
                <a href="products.php" class="shop-now-button">Shop Now!</a>
            </div>
        </div>

        <!-- Promotion Section -->
        <div class="promotion-section">
            <img src="img/promotion2.jpg" alt="Promotion Background" class="background-image">
            <div class="overlay-content">
                <h2>PROMOTION! 11.11</h2>
                <a href="products.php" class="shop-now-button">Shop Now!</a>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="why-choose-us-section">
            <div class="overlay-content">
                <h2>The reasons</h2>
                <h3>Why Choose Us?</h3>
                <div class="slideshow-container">
                    <!-- Slide 1 -->
                    <div class="slide fade">
                        <img src="img/landscape1.webp" alt="Fresh Produce" class="slide-image">
                        <p class="caption">Fresh produce directly from farms.</p>
                    </div>
                    <!-- Slide 2 -->
                    <div class="slide fade">
                        <img src="img/landscape2.jpg" alt="Sustainable Farming" class="slide-image">
                        <p class="caption">Promoting sustainable farming practices.</p>
                    </div>
                    <!-- Slide 3 -->
                    <div class="slide fade">
                        <img src="img/landscape3.webp" alt="Community Support" class="slide-image">
                        <p class="caption">Supporting local communities and farmers.</p>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                <a class="next" onclick="changeSlide(1)">&#10095;</a>
            </div>
        </div>

        <!-- Supplier Section -->
        <div class="supplier-section">
            <h2>Our Suppliers</h2>
            <h3>Sustainable Farms</h3>
            <div class="supplier-logos">
                <div class="supplier-logo">
                    <img src="img/SunwayXFarmLogo.png" alt="Sunway Farms Logo">
                </div>
                <div class="supplier-logo">
                    <img src="img/urban_hijau_logo.jpeg" alt="Urban Hijau Logo">
                </div>
                <div class="supplier-logo">
                    <img src="img/cultiveat logo.webp" alt="Cultiveat Logo">
                </div>
            </div>
        </div>

    </div>

    <div class="impact-section">
        <h2>Our Impact</h2>
        <div class="metrics">
            <div class="metric">
                <h3>500+</h3>
                <p>Meals provided to families</p>
            </div>
            <div class="metric">
                <h3>20+</h3>
                <p>Local farms supported</p>
            </div>
            <div class="metric">
                <h3>2 Tons</h3>
                <p>Food waste reduced</p>
            </div>
        </div>
    </div>

    <!-- Impact of Buying Section -->
    <div class="impact-buying-section">
        <h2>Your Purchase Makes a Difference</h2>
        <p>For every vegetable or product you purchase, you're not just nourishing yourself, but also supporting:</p>
        <ul>
            <li>Farmers in sustainable and fair-trade practices</li>
            <li>Local food banks providing meals to families in need</li>
            <li>Efforts to reduce food waste and promote eco-friendly farming</li>
        </ul>
        <p class="thank-you-message">Thank you for being a part of the movement to create a hunger-free world!</p>
    </div>


    <!-- Footer -->
    <?php include('inc/footer.inc.php'); ?>
</body>

<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.getElementsByClassName("slide");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none"; // Hide all slides
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1; // Reset to the first slide
        }
        slides[slideIndex - 1].style.display = "block"; // Show current slide
        setTimeout(showSlides, 5000); // Change slide every 5 seconds
    }

    function changeSlide(n) {
        slideIndex += n - 1; // Adjust slideIndex for navigation
        const slides = document.getElementsByClassName("slide");
        if (slideIndex >= slides.length) slideIndex = 0;
        if (slideIndex < 0) slideIndex = slides.length - 1;
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none"; // Hide all slides
        }
        slides[slideIndex].style.display = "block"; // Show current slide
    }
</script>

</html>