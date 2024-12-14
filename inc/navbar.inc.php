<div class="navbar">
    <div class="navbar-logo">
        <span class="navbar-title">FRESHARA</span>
    </div>
    <div class="navbar-links">
        <a href="index.php" class="navbar-link">Home</a>
        <a href="products.php" class="navbar-link">Products</a>
        <a href="about.php" class="navbar-link">About Us</a>
        <a href="contact.php" class="navbar-link">Contact</a>
    </div>
    <div class="navbar-right">
        <div class="navbar-cart">
            <img src="img/shopping-cart-10.svg" alt="Cart" class="icon">
            <span class="cart-badge">2</span>
        </div>
        <div class="navbar-notification">
            <img src="img/bell-icon.svg" alt="Notifications" class="icon">
        </div>
        <div class="navbar-user">
            <img src="img/user-icon.svg" alt="User" class="icon">
            <span class="user-action">
                <?php
                if (isset($_SESSION['first_name'])) {
                    echo htmlspecialchars($_SESSION['first_name']);
                } else {
                    echo '<a href="login.php">Sign In</a>';
                }
                ?>
            </span>
        </div>
    </div>
</div>