<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/globals.css" />
    <link rel="stylesheet" href="css/styleguide.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>

<?php
session_start()

?>

<body>
    <!-- Navbar -->
    <?php include('inc/navbar.inc.php'); ?>
    <div class="products">
        <div class="home-page">
            <div class="div">

                <div class="overlap">
                    <button class="label-wrapper">
                        <div class="label-2">SHOP
                            NOW!</div>
                    </button>
                    <div class="div-wrapper">
                        <div class="frame-4">
                            <p class="p">Connecting Farmers,
                                Feeding the Future.</p>
                        </div>
                    </div>
                </div>
                <div class="overlap-2">
                    <div class="promotion-tab">
                        <div class="overlap-3">
                            <div class="text-wrapper-3">PROMOTION! 11.11</div>
                            <div class="scroll-tab">
                                <div class="ellipse"></div>
                                <div class="ellipse-2"></div>
                                <div class="ellipse-3"></div>
                                <div class="ellipse-4"></div>
                            </div>
                            <img class="vector" src="img/vector-1.svg" />
                        </div>
                    </div>
                    <button class="button-2">
                        <div class="label-2">SHOP
                            NOW!</div>
                    </button>
                </div>
                <div class="frame-6">
                    <div class="frame-7">
                        <div class="text-wrapper-5">Our Supplier</div>
                        <div class="text-wrapper-6">Sustainable Farms</div>
                    </div>
                    <div class="frame-8">
                        <div class="sunwayxfarms-logo-wrapper">
                            <img class="sunwayxfarms-logo"
                                src="img/sunwayxfarms-logo-small-300x149-1.png" />
                        </div>
                        <img class="untitled" src="img/untitled-1.png" />
                        <img class="untitled-2" src="img/untitled-2.png" />
                    </div>
                </div>
                <div class="picture-big">
                    <div class="icon-play">
                        <div class="mask-wrapper"><img class="mask"
                                src="img/mask.svg" /></div>
                    </div>
                </div>
                <div class="frame-9">
                    <div class="text-wrapper-5">The reasons</div>
                    <div class="text-wrapper-6">Why Choose Us?</div>
                </div>
            </div>
        </div>
</body>

<!-- Footer -->
<?php include('inc/footer.inc.php'); ?>

</html>