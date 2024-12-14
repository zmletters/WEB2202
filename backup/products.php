<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/productglobals.css" />
    <link rel="stylesheet" href="css/productstyleguide.css" />
    <link rel="stylesheet" href="css/productstyle.css" />
</head>

<?php
session_start();
?>

<body>
    <div class="products">
        <div class="div">
            <div class="nav">
                <div class="nav-content">
                    <div class="navbar">
                        <button class="button">
                            <div
                                class="label">FRESHARA</div>
                        </button>
                        <div class="divider"></div>
                        <div class="text-wrapper-5">Home</div>
                        <div class="text-wrapper-5">Products</div>
                        <div class="text-wrapper-5">About Us</div>
                        <div class="text-wrapper-5">Contact</div>
                    </div>
                    <div class="frame-wrapper">
                        <div class="frame-9">
                            <div class="overlap-group-wrapper">
                                <div class="overlap-group-2">
                                    <div class="button-icon-only"><img
                                            class="shopping-cart-2"
                                            src="img/shopping-cart-10.svg" /></div>
                                    <div class="badge-primary">
                                        <div
                                            class="text-wrapper-6">2</div>
                                    </div>
                                </div>
                            </div>
                            <img class="icons-bell-line"
                                src="img/line.svg" />
                            <div class="div-wrapper">
                                <div class="frame-10">
                                    <img class="frame-11"
                                        src="img/frame-1027.svg" />
                                    <div class="text-wrapper-5">
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
            <div class="frame">
                <div class="frame-2">
                    <div class="location">
                        <div class="icons-options"><img class="icon"
                                src="img/image.png" /></div>
                        <div class="title">Subang Jaya, Malaysia</div>
                        <div class="icons-location"></div>
                    </div>
                    <div class="discount">
                        <div class="icons-px-options"><img class="icon"
                                src="img/icon.png" /></div>
                        <div class="title">Best deals</div>
                        <div class="icons-coupon"><img class="img"
                                src="img/icon-61.svg" /></div>
                    </div>
                    <div class="input-fields-icon">
                        <div class="placeholder">Search for anything…</div>
                        <div class="icons-search"></div>
                    </div>
                    <div class="buttons">
                        <div class="icons-icon-fill">
                            <div class="icons-filter"><img class="icon-2"
                                    src="img/icon-18.svg" /></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="frame-3">
                <div class="component">
                    <div class="overlap"><img class="img-2"
                            src="img/bunches-asparagus-market-italy-255440-756-1.png" /></div>
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-9.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Asparagus</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star"></div>
                                    <div class="icons-px-star"></div>
                                    <div class="icons-star-2"></div>
                                    <div class="icons-star-3"></div>
                                    <div class="icons-star-4"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2"
                        src="img/14da0218-53df-4c85-d244-181b5c6e0d3d.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-3.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Chinese
                                    Cabbage</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-5"></div>
                                    <div class="icons-star-6"></div>
                                    <div class="icons-star-7"></div>
                                    <div class="icons-star-8"></div>
                                    <div class="icons-star-9"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2" src="img/images-2.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-2.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Coriander</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-10"></div>
                                    <div class="icons-star-11"></div>
                                    <div class="icons-star-12"></div>
                                    <div class="icons-star-13"></div>
                                    <div class="icons-star-14"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2" src="img/images-1.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-5.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Brocoli</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-15"></div>
                                    <div class="icons-star-16"></div>
                                    <div class="icons-star-17"></div>
                                    <div class="icons-star-18"></div>
                                    <div class="icons-star-19"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="arrows" src="img/arrows-2.svg" />
            <div class="text-wrapper-2">Recommended</div>
            <div class="frame-7">
                <div class="component">
                    <img class="img-2" src="img/eggplant.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-13.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Aubergine</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-20"></div>
                                    <div class="icons-star-21"></div>
                                    <div class="icons-star-22"></div>
                                    <div class="icons-star-23"></div>
                                    <div class="icons-star-24"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2"
                        src="img/radish-3371103037-4ab07db0bf-o.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Radish</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-25"></div>
                                    <div class="icons-star-26"></div>
                                    <div class="icons-star-27"></div>
                                    <div class="icons-star-28"></div>
                                    <div class="icons-star-29"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2"
                        src="img/150-carrot-bs-150pp-98-sree-original-imagsrzuww9bgqff.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-7.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Carrot</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-30"></div>
                                    <div class="icons-star-31"></div>
                                    <div class="icons-star-32"></div>
                                    <div class="icons-star-33"></div>
                                    <div class="icons-star-34"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2" src="img/images.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-8.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Tomato</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-35"></div>
                                    <div class="icons-star-36"></div>
                                    <div class="icons-star-37"></div>
                                    <div class="icons-star-38"></div>
                                    <div class="icons-star-39"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="frame-8">
                <div class="component">
                    <img class="img-2" src="img/lettuce-iceberg.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-6.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Iceberg
                                    Lettuce</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-40"></div>
                                    <div class="icons-star-41"></div>
                                    <div class="icons-star-42"></div>
                                    <div class="icons-star-43"></div>
                                    <div class="icons-star-44"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2"
                        src="img/organic-vegetable-bitter-gourd.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-12.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Bitter
                                    gourd</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-45"></div>
                                    <div class="icons-star-46"></div>
                                    <div class="icons-star-47"></div>
                                    <div class="icons-star-48"></div>
                                    <div class="icons-star-49"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2" src="img/figure-1.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-11.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Sweet
                                    Potato</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-50"></div>
                                    <div class="icons-star-51"></div>
                                    <div class="icons-star-52"></div>
                                    <div class="icons-star-53"></div>
                                    <div class="icons-star-54"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="component">
                    <img class="img-2" src="img/serai.png" />
                    <div class="overlap-group">
                        <div class="group"><img class="shopping-cart"
                                src="img/shopping-cart-4.svg" /></div>
                        <div class="frame-4">
                            <div class="information">
                                <div
                                    class="text-wrapper">Lemongrass</div>
                            </div>
                            <div class="title-2">$20.99</div>
                            <div class="frame-5">
                                <div class="frame-6">
                                    <div class="icons-star-55"></div>
                                    <div class="icons-star-56"></div>
                                    <div class="icons-star-57"></div>
                                    <div class="icons-star-58"></div>
                                    <div class="icons-star-59"></div>
                                </div>
                                <div class="text">(120)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-wrapper-3">Best Seller</div>
            <img class="arrows-2" src="img/arrows.svg" />
            <div class="text-wrapper-4">All Product</div>

            <div class="overlap-wrapper">
                <div class="overlap-2">
                    <div class="group-2">
                        <div class="overlap-group-3">
                            <div class="containers">Freshara</div>
                            <div class="group-3">
                                <div class="social-network"></div>
                                <div class="follow-us">Contact us</div>
                                <div class="frame-12">
                                    <div
                                        class="hello-forpeople-stud">admin@freshara.com</div>
                                    <div
                                        class="text-wrapper-7">+601-2345-6789</div>
                                    <p class="text-wrapper-7">52, Bandar
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
                            src="img/images-1-2.png" /></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>