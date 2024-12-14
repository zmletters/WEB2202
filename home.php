<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/globals.css" />
    <link rel="stylesheet" href="css/styleguide.css" />
    <link rel="stylesheet" href="css/home.css" />
</head>

<?php
session_start()

?>

<body>
    <div class="home-page">
        <div class="div">
            <div class="nav">
                <div class="nav-content">
                    <div class="navbar">
                        <button class="button">
                            <div
                                class="label">FRESHARA</div>
                        </button>
                        <div class="divider"></div>
                        <div class="text-wrapper">Home</div>
                        <div class="text-wrapper"><a href="products.php">Products</a></div>
                        <div class="text-wrapper">About Us</div>
                        <div class="text-wrapper">Contact</div>
                    </div>
                    <div class="frame">
                        <div class="frame-2">
                            <div class="group">
                                <div class="overlap-group">
                                    <div class="button-icon-only"><img
                                            class="shopping-cart"
                                            src="img/shopping-cart.svg" /></div>
                                    <div class="badge-primary">
                                        <div
                                            class="text-wrapper-2">2</div>
                                    </div>
                                </div>
                            </div>
                            <img class="icons-bell-line"
                                src="img/line.svg" />
                            <div class="frame-wrapper">
                                <div class="frame-3">
                                    <img class="img"
                                        src="img/frame-1027.svg" />
                                    <div class="text-wrapper">

                                        <?php
                                        if (isset($_SESSION['first_name'])) {
                                            echo htmlspecialchars($_SESSION['first_name']);
                                        } else {
                                            echo '<a href="login.php">Sign In</a>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider-2"></div>
            </div>
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
            <div class="overlap-wrapper">
                <div class="overlap-4">
                    <div class="overlap-group-wrapper">
                        <div class="overlap-group-2">
                            <div class="containers">Freshara</div>
                            <div class="group-2">
                                <div class="social-network"></div>
                                <div class="follow-us">Contact us</div>
                                <div class="frame-5">
                                    <div
                                        class="hello-forpeople-stud">admin@freshara.com</div>
                                    <div
                                        class="text-wrapper-4">+601-2345-6789</div>
                                    <p class="text-wrapper-4">52, Bandar
                                        Sunway, PJ, Malaysia</p>
                                </div>
                            </div>
                            <footer class="footer">
                                <p
                                    class="copyright-al">Copyright © 2024.
                                    All rights reserved.</p>
                            </footer>
                        </div>
                    </div>
                    <img class="instagram" src="img/instagram.svg" />
                    <img class="twitter" src="img/twitter.svg" />
                    <div class="ant-design-picture"><img class="images"
                            src="img/images-1.png" /></div>
                </div>
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

</html>


<?php
session_start()

?>