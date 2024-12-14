<!-- navbar.inc.php -->

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