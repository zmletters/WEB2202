<?php
session_start();
require('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Freshara</title>
    <link rel="stylesheet" href="css/about.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>

<body>
    <!-- Navbar -->
    <?php include('inc/navbar.inc.php'); ?>

    <!-- About Us Section -->
    <div class="container">
        <!-- Section Title -->
        <h1 class="section-title">About Us</h1>

        <!-- Our Story Section -->
        <div class="our-story">
            <img src="img/vector.svg" alt="Illustration of discussion">
            <div class="content">
                <h2>Our Story</h2>
                <p>
                    Freshara was founded in 2024 by a few enthusiastic teenagers who had a burning desire
                    to make a difference in the world. It came into existence with the vision to create
                    a sustainable food marketplace in order to tackle one of the major challenges the world
                    is facing: hunger.
                </p>
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="our-mission">
            <div class="content">
                <h2>Our Mission</h2>
                <p>
                    At Freshara, our mission is to drive meaningful change by contributing to the achievement
                    of United Nations’ Sustainable Development Goal 2: Zero Hunger. We are committed to:
                </p>
                <ul>
                    <li>Ensuring access to affordable and nutritious food for all, especially for underserved communities.</li>
                    <li>Empowering local farmers and food producers through fair trade practices, helping them grow sustainably and improve food availability.</li>
                    <li>Minimizing food waste by redistributing surplus and imperfect produce, ensuring that every harvest feeds people, not landfills.</li>
                    <li>Promoting sustainable agricultural practices that protect the environment and improve long-term food security.</li>
                    <li>Supporting communities in need by allocating a portion of our revenue to food aid programs and donations for families facing food insecurity.</li>
                </ul>
            </div>
            <img src="img/image.png" alt="Sustainable farming">
        </div>
    </div>
</body>

<!-- Footer -->
<?php include('inc/footer.inc.php'); ?>

</html>